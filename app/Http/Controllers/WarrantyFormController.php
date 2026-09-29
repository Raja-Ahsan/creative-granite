<?php

namespace App\Http\Controllers;

use App\Http\Requests\WarrantyFormRequest;
use App\Mail\WarrantyRequestMail;
use App\Models\WarrantyRequest;
use App\Services\MailSettingsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class WarrantyFormController extends Controller
{
    public function store(WarrantyFormRequest $request, MailSettingsService $mailSettings): JsonResponse
    {
        $data = $request->validated();

        $warranty = WarrantyRequest::create($data);

        $mailSettings->applyToConfig();

        try {
            Mail::to($mailSettings->warrantyRecipient())->send(new WarrantyRequestMail($data));
        } catch (\Throwable $exception) {
            report($exception);
        }

        return response()->json([
            'message' => 'Thank you — we received your warranty request and will follow up soon.',
            'id' => $warranty->id,
        ]);
    }
}
