<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ $product->name }} — Mega Pharma Group</title>
<meta name="description" content="{{ $metaDescription }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<style>
@include('partials.site-styles')
</style>
</head>
<body>
<a class="skip-link" href="#main">Skip to content</a>

<!-- fixed cinematic world (single calm scene — no scroll timeline on this page) -->
<div id="world" aria-hidden="true"></div>
<div id="grain" aria-hidden="true"></div>
<div id="vignette" aria-hidden="true"></div>

<!-- preloader -->
<div id="loader" aria-hidden="true">
  <div class="loader-mark"><b>Mega Pharma</b><span>Group</span></div>
  <div class="loader-track"><div class="loader-bar" id="loaderBar"></div></div>
  <div class="loader-pct" id="loaderPct">0%</div>
</div>

<div id="progress" aria-hidden="true"></div>

@include('partials.site-nav')

<main id="main">

<section class="chapter" id="product" aria-labelledby="product-h">
  <div class="wrap chapter-inner">
    @php $details = $product->details; @endphp

    <div class="pane pane--c"@if ($product->imageUrl) style="display:flex;flex-direction:column;align-items:center;gap:1.8rem" @endif>
      @if ($product->imageUrl)
        <div class="product-hero-media">
          <img src="{{ $product->imageUrl }}" alt="{{ $product->name }}" loading="eager" decoding="async">
          @if (!empty($details['award']))
            <div class="product-hero-award">
              <img src="{{ asset($details['award']['image']) }}" alt="" loading="lazy" decoding="async">
              <div><strong>{{ $details['award']['label'] }}</strong><span>{{ $details['award']['by'] }}</span></div>
            </div>
          @endif
        </div>
      @endif
      <div class="product-hero-details">
        <p class="eyebrow"><i>&larr;</i><a class="lnk" href="/#collections">Back to the collection</a></p>
        <span class="modal-co {{ $product->company }}">{{ $product->companyLabel }}</span>
        <h1 id="product-h" style="margin-top:.6rem">{{ $product->name }}</h1>
        <p class="modal-generic">{{ $product->generic }}</p>
        @if (!empty($details['tagline']))
          <p class="brochure-tagline">&ldquo;{{ $details['tagline'] }}&rdquo;</p>
        @endif
        <p class="lede" style="margin-top:1.4rem">{{ $product->description }}</p>

        @if (empty($details['specs']))
          <div class="modal-specs" style="margin-top:2rem;max-width:640px">
            <div><span>Category</span><em>{{ $product->category }}</em></div>
            <div><span>Manufacturer</span><em>{{ $product->manufacturer }}</em></div>
            <div><span>Presentations</span><em>{{ $product->variant }}</em></div>
            <div><span>House</span><em>{{ $product->companyLabel }}</em></div>
          </div>
        @endif

        <a class="btn" style="margin-top:2.2rem;display:inline-flex" href="/#contact">Contact us about this product</a>
        <p class="modal-note" style="margin-top:1rem">Information for healthcare professionals. For full prescribing or device information, contact Mega Pharma Group.</p>
      </div>
    </div>

    @if (!empty($details['components']))
      <div class="pane" style="margin-top:2.6rem;background:transparent;border:none;box-shadow:none;backdrop-filter:none">
        <p class="eyebrow">Meet the {{ $product->name }} system</p>
        <div class="brochure-components">
          @foreach ($details['components'] as $c)
            <div class="brochure-component">
              <span class="brochure-component-n">{{ $c['n'] }}</span>
              <h3>{{ $c['t'] }}</h3>
              <p>{{ $c['d'] }}</p>
            </div>
          @endforeach
        </div>
        @if (!empty($details['callout']))
          <p class="brochure-callout">{{ $details['callout'] }}</p>
        @endif
      </div>
    @endif

    @if (!empty($details['highlights']))
      <div class="pane" style="margin-top:2.6rem;background:transparent;border:none;box-shadow:none;backdrop-filter:none">
        <p class="eyebrow">Why it works</p>
        <div class="brochure-highlights">
          @foreach ($details['highlights'] as $h)
            <div class="brochure-highlight">
              <h3>{{ $h['h'] }}</h3>
              @if (!empty($h['points']))
                <ul class="{{ collect($h['points'])->contains(fn ($p) => is_array($p) && !empty($p['icon'])) ? 'has-icons' : '' }}">
                  @foreach ($h['points'] as $point)
                    @php $text = is_array($point) ? $point['t'] : $point; $icon = is_array($point) ? ($point['icon'] ?? null) : null; @endphp
                    <li>
                      @if ($icon)<img src="{{ asset($icon) }}" alt="" loading="lazy" decoding="async">@endif
                      <span>{{ $text }}</span>
                    </li>
                  @endforeach
                </ul>
              @elseif (!empty($h['body']))
                <p>{{ $h['body'] }}</p>
              @endif
            </div>
          @endforeach
        </div>
      </div>
    @endif

    @if (!empty($details['specs']))
      <div class="pane pane--c" style="margin-top:2.6rem">
        <p class="eyebrow">Specification</p>
        @foreach ($details['specs'] as $group)
          <table class="brochure-spec-table">
            <caption>{{ $group['group'] }}</caption>
            <tbody>
              @foreach ($group['rows'] as $row)
                <tr><th>{{ $row['label'] }}</th><td>{{ $row['value'] }}</td></tr>
              @endforeach
            </tbody>
          </table>
        @endforeach

        @if (!empty($details['manufacturer_info']))
          @php $mi = $details['manufacturer_info']; @endphp
          <p class="brochure-mfr-info">
            <strong>{{ $mi['name'] }}</strong><br>
            {{ $mi['address'] }}<br>
            Tel: {{ $mi['tel'] }} &middot; {{ $mi['email'] }} &middot; {{ $mi['website'] }}
          </p>
        @endif
      </div>
    @endif

    @if ($related->isNotEmpty())
      <div class="pane" style="margin-top:2.6rem;background:transparent;border:none;box-shadow:none;backdrop-filter:none">
        <p class="eyebrow">More in {{ $product->category }}@if ($collectionSlug = collect(config('collections'))->search(fn ($c) => $c['name'] === $product->category)) <a class="lnk" style="margin-left:1.2rem;letter-spacing:.16em" href="{{ route('collections.show', $collectionSlug) }}">View collection &rarr;</a>@endif</p>
        <div class="grid">
          @foreach ($related as $r)
            <a class="card{{ $r->imageUrl ? ' has-img' : '' }}" href="{{ route('products.show', $r) }}" data-co="{{ $r->company }}">
              @if ($r->imageUrl)
                <img class="card-img" src="{{ $r->imageUrl }}" alt="" loading="lazy" decoding="async">
              @endif
              <span class="card-cat">{{ $r->category }}</span>
              <span class="card-name">{{ $r->name }}</span>
              <p class="generic">{{ $r->generic }}</p>
              <p class="meta"><em>{{ $r->manufacturer }}</em><span>{{ $r->companyLabel }}</span></p>
            </a>
          @endforeach
        </div>
      </div>
    @endif
  </div>
</section>

</main>

@include('partials.partners')

@include('partials.site-footer')

@include('partials.legal-modal')
@include('partials.chatbot')

@include('partials.calm-world-script', ['themeColors' => $product->themeColors])

@include('partials.footer-legal-script')
</body>
</html>
