<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactInquiryMail;
use App\Models\SiteSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function store(ContactFormRequest $request): JsonResponse
    {
        $data = $request->validated();

        $recipient = SiteSetting::query()
            ->where('key', 'email')
            ->value('value');

        if (! $recipient) {
            $recipient = config('mail.from.address');
        }

        Mail::to($recipient)->send(new ContactInquiryMail($data));

        return response()->json([
            'message' => 'Thank you — we received your message and will be in touch soon.',
        ]);
    }
}
