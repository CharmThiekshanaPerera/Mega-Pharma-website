<?php

namespace App\Http\Controllers;

use App\Mail\ContactInquiryReceived;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactMessageController extends Controller
{
    /**
     * Store a contact enquiry submitted from the public site.
     */
    public function store(Request $request): JsonResponse
    {
        // Honeypot: bots fill every field, including this hidden one.
        // Silently pretend success without touching the database.
        if (filled($request->input('company'))) {
            return response()->json(['message' => 'Thank you.']);
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:150'],
            'topic' => ['required', 'string', 'max:150'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        $inquiry = ContactMessage::create($data + ['ip_address' => $request->ip()]);

        // The enquiry is already saved (visible in the admin panel) — email
        // is a secondary notification, so a broken mail config must never
        // fail the customer's submission.
        try {
            Mail::to(config('mail.admin_address'))->send(new ContactInquiryReceived($inquiry));
        } catch (\Throwable $e) {
            Log::error('Failed to send contact inquiry email: '.$e->getMessage());
        }

        return response()->json(['message' => 'Thank you, your message has been sent.']);
    }
}
