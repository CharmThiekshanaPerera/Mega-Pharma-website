<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

        ContactMessage::create($data + ['ip_address' => $request->ip()]);

        return response()->json(['message' => 'Thank you, your message has been sent.']);
    }
}
