<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Resources\InquiryResource;
use App\Models\Inquiry;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Store a newly created contact inquiry in database.
     */
    public function store(ContactRequest $request): JsonResponse
    {
        $validated = $request->validated();

        // Basic honeypot spam protection:
        // If a hidden bot field is filled, silently return a success response without persisting
        if (!empty($request->input('website')) || !empty($request->input('bot_check'))) {
            Log::warning('Spam bot honeypot triggered on contact form', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'email' => $request->input('email'),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Thank you for reaching out to Cana Gardens. Your inquiry has been received.',
                'data' => [
                    'reference' => 'CG-BOT-SHIELD',
                ],
            ], 200);
        }

        // Normalize guest count from either guest_count or estimated_guests
        $estimatedGuests = $validated['guest_count'] ?? $validated['estimated_guests'] ?? null;

        // Persist the inquiry
        $inquiry = Inquiry::create([
            'name'             => trim($validated['name']),
            'email'            => strtolower(trim($validated['email'])),
            'phone'            => trim($validated['phone']),
            'event_type'       => $validated['event_type'] ?? 'wedding',
            'estimated_guests' => $estimatedGuests ? (int) $estimatedGuests : null,
            'event_date'       => $validated['event_date'] ?? null,
            'message'          => trim($validated['message']),
            'status'           => 'new',
            'ip_address'       => $request->ip(),
            'user_agent'       => substr((string) $request->userAgent(), 0, 500),
        ]);

        Log::info("New contact inquiry received #{$inquiry->id}", [
            'name'       => $inquiry->name,
            'email'      => $inquiry->email,
            'event_type' => $inquiry->event_type,
            'event_date' => $inquiry->event_date,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for contacting Cana Gardens! We have received your inquiry and our team will get in touch with you shortly.',
            'data'    => new InquiryResource($inquiry),
        ], 201);
    }
}
