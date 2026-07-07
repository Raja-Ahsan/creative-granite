<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactInquiryMail;
use App\Models\ContactInquiry;
use App\Services\MailSettingsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function store(ContactFormRequest $request, MailSettingsService $mailSettings): JsonResponse
    {
        $data = $request->validated();

        $inquiry = ContactInquiry::create($data);

        $mailSettings->applyToConfig();

        try {
            Mail::to($mailSettings->contactRecipient())->send(new ContactInquiryMail($data));
        } catch (\Throwable $exception) {
            report($exception);
        }

        return response()->json([
            'message' => 'Thank you — we received your message and will be in touch soon.',
            'id' => $inquiry->id,
        ]);
    }
}
