<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EstimateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EstimateRequestController extends Controller
{
    public function index(Request $request): View
    {
        $filter = $request->string('filter')->toString();

        $query = EstimateRequest::query()->recent();

        if ($filter === 'unread') {
            $query->unread();
        }

        return view('screens.admin.estimate-requests.index', [
            'items' => $query->paginate(20)->withQueryString(),
            'filter' => $filter ?: 'all',
            'unreadCount' => EstimateRequest::unread()->count(),
            'title' => 'Estimate Requests',
        ]);
    }

    public function show(EstimateRequest $estimateRequest): View
    {
        $estimateRequest->markAsRead();

        return view('screens.admin.estimate-requests.show', [
            'estimate' => $estimateRequest,
            'title' => 'Estimate from '.$estimateRequest->name,
        ]);
    }

    public function markAllRead(): RedirectResponse
    {
        EstimateRequest::unread()->update(['read_at' => now()]);

        return redirect()
            ->route('admin.estimate-requests.index')
            ->with('success', 'All estimate requests marked as read.');
    }

    public function destroy(EstimateRequest $estimateRequest): RedirectResponse
    {
        $estimateRequest->delete();

        return redirect()
            ->route('admin.estimate-requests.index')
            ->with('success', 'Estimate request deleted.');
    }
}
