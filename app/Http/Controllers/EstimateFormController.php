<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstimateFormRequest;
use App\Mail\EstimateRequestMail;
use App\Models\EstimateRequest;
use App\Services\MailSettingsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class EstimateFormController extends Controller
{
    public function store(EstimateFormRequest $request, MailSettingsService $mailSettings): JsonResponse
    {
        $data = $request->validated();

        $estimate = EstimateRequest::create($data);

        $mailSettings->applyToConfig();

        try {
            Mail::to($mailSettings->contactRecipient())->send(new EstimateRequestMail($data));
        } catch (\Throwable $exception) {
            report($exception);
        }

        return response()->json([
            'message' => 'Thank you — we received your estimate request and will be in touch soon.',
            'id' => $estimate->id,
        ]);
    }
}
