<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

/**
 * A deterministic, rule-based assistant — not a generative LLM. No external
 * API, no API key, nothing to run out of quota or leak a key for. It
 * answers from two grounded sources: a small hand-written knowledge base of
 * real company facts (see KNOWLEDGE below) and a live keyword search over
 * the actual product catalogue, so it never invents a product or a fact
 * that isn't really in the database.
 *
 * Trade-off, stated plainly: it can't hold an open-ended conversation the
 * way a hosted LLM would — it matches intent by keyword and falls back
 * gracefully when nothing matches. For "does Mega Pharma carry X" /
 * "what are your standards" / "how do I contact you" style questions, that
 * grounding is arguably safer for a healthcare company anyway: it can't
 * hallucinate a dosage or a claim that was never on the site.
 */
class ChatbotService
{
    /** Company facts — kept in one place so answers stay consistent with the site's own copy. */
    private const KNOWLEDGE = [
        'about' => "Mega Pharma Group was incorporated in June 1995 as a specialised pharmaceutical company in Colombo, Sri Lanka. Today the group imports, markets and distributes quality prescription medicines and medical technology across the island — over 30 years, 200+ employees, 9 specialty divisions, 16 distributors and 16+ global principals across four continents.",
        'vision' => 'Our vision is to be the role model in the healthcare industry in Sri Lanka.',
        'mission' => 'Our mission is to source quality pharmaceuticals and medical technology from around the globe to strengthen the healing of Sri Lanka.',
        'houses' => "Mega Pharma Group has two houses. Mega Pharma covers prescription medicine across nine specialty divisions, promoted ethically to the profession. Mega Meditech covers diagnostics, wound care, surgical systems and homecare devices from world-leading manufacturers.",
        'standards' => 'Six values guide everything we do: honesty & integrity, care for our people, dynamism, customer responsibility, people & team spirit, and a constant journey toward excellence.',
        'collections' => "Our full catalogue is in the Collections section — filterable by house (Mega Pharma / Mega Meditech), by therapeutic or device category, or searchable by brand, composition or manufacturer.",
        'contact' => "You can reach us at 93/5, Dutugemunu Street, Colombo 06, Sri Lanka. Phone +94 11 420 3596–7 or +94 11 281 2390–1. Email info@megapharma.lk.",
        'partner' => "If you're a manufacturer or principal interested in distribution partnership in Sri Lanka, please use the contact form and choose \"Becoming a distribution partner\" as the topic — our team will follow up.",
        'careers' => 'For careers enquiries, please use the contact form on this site and select "Careers" as the topic.',
    ];

    /** Ordered so more specific intents are checked before broad ones. */
    private const INTENT_KEYWORDS = [
        'greeting' => ['hello', 'hi', 'hey', 'good morning', 'good afternoon', 'good evening'],
        'thanks' => ['thank', 'thanks', 'cheers', 'appreciate'],
        'contact' => ['contact', 'phone', 'telephone', 'call', 'email', 'address', 'located', 'location', 'reach you', 'office'],
        'partner' => ['distributor', 'distribution partner', 'become a partner', 'principal', 'manufacturer partnership', 'supply to you', 'representation'],
        'careers' => ['career', 'careers', 'job', 'jobs', 'vacancy', 'vacancies', 'hiring', 'work for'],
        'houses' => ['mega meditech', 'mega pharma house', 'medical technology', 'two houses', 'houses', 'difference between'],
        'standards' => ['value', 'values', 'standard', 'standards', 'ethic', 'ethical', 'integrity'],
        'vision' => ['vision'],
        'mission' => ['mission'],
        'collections' => ['how many product', 'browse', 'collection', 'collections', 'catalogue', 'catalog', 'categories', 'category'],
        'about' => ['about', 'who are you', 'history', 'founded', 'when was', 'established', 'incorporated', '1995', 'how long', 'how many employee', 'how many year'],
    ];

    private const STOPWORDS = ['the', 'and', 'for', 'are', 'you', 'your', 'have', 'has', 'with', 'that', 'this',
        'what', 'which', 'does', 'do', 'is', 'a', 'an', 'of', 'to', 'in', 'on', 'i', 'me', 'my', 'about', 'tell', 'can', 'please'];

    /**
     * @return array{reply: string, products: array<int, array{name: string, generic: string, category: string, manufacturer: string, url: string}>}
     */
    public function respond(string $message): array
    {
        $normalized = Str::lower(trim($message));

        if ($normalized === '') {
            return ['reply' => "I didn't catch a question there — ask me about our products, the Group, or how to get in touch.", 'products' => []];
        }

        foreach (self::INTENT_KEYWORDS as $intent => $keywords) {
            foreach ($keywords as $keyword) {
                if (Str::contains($normalized, $keyword)) {
                    return ['reply' => $this->replyFor($intent), 'products' => []];
                }
            }
        }

        $products = $this->searchProducts($normalized);

        if ($products->isNotEmpty()) {
            $list = $products->map(fn (Product $p) => "{$p->name} ({$p->generic}) — {$p->manufacturer}, {$p->companyLabel}")->implode('; ');

            return [
                'reply' => "Here's what we carry that matches: {$list}. Tap a result below for full details, or ask me something else.",
                'products' => $products->map(fn (Product $p) => [
                    'name' => $p->name,
                    'generic' => $p->generic,
                    'category' => $p->category,
                    'manufacturer' => $p->manufacturer,
                    'url' => route('products.show', $p),
                ])->all(),
            ];
        }

        return [
            'reply' => "I couldn't find a product matching that in our catalogue, and I'm a simple assistant — I only know what's on this site. Try browsing Collections, or use the contact form and our team will help directly.",
            'products' => [],
        ];
    }

    private function replyFor(string $intent): string
    {
        return match ($intent) {
            'greeting' => "Hello! I can answer questions about Mega Pharma Group, our products, or how to reach us — what would you like to know?",
            'thanks' => "You're welcome! Anything else I can help with?",
            default => self::KNOWLEDGE[$intent] ?? "I'm not sure about that — try the contact form and our team will help directly.",
        };
    }

    /** @return Collection<int, Product> */
    private function searchProducts(string $normalized): Collection
    {
        $tokens = collect(preg_split('/[^a-z0-9]+/', $normalized, -1, PREG_SPLIT_NO_EMPTY))
            ->filter(fn (string $t) => strlen($t) >= 3 && ! in_array($t, self::STOPWORDS, true))
            ->unique()
            ->values();

        if ($tokens->isEmpty()) {
            return collect();
        }

        // The catalogue is small (a few hundred rows) and rarely changes —
        // cache it briefly rather than hitting the DB on every message.
        $catalogue = Cache::remember('chatbot.catalogue', now()->addMinutes(10), fn () => Product::all([
            'id', 'name', 'slug', 'generic', 'category', 'manufacturer', 'company',
        ]));

        return $catalogue
            ->map(function (Product $product) use ($tokens) {
                $haystack = Str::lower("{$product->name} {$product->generic} {$product->category} {$product->manufacturer} {$product->companyLabel}");
                $score = $tokens->sum(fn (string $token) => Str::contains($haystack, $token) ? 1 : 0);

                return [$score, $product];
            })
            ->filter(fn (array $pair) => $pair[0] > 0)
            ->sortByDesc(fn (array $pair) => $pair[0])
            ->take(5)
            ->map(fn (array $pair) => $pair[1])
            ->values();
    }
}
