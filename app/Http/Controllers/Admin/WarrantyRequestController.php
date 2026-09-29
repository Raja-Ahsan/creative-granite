<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WarrantyRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WarrantyRequestController extends Controller
{
    public function index(Request $request): View
    {
        $filter = $request->string('filter')->toString();

        $query = WarrantyRequest::query()->recent();

        if ($filter === 'unread') {
            $query->unread();
        }

        return view('screens.admin.warranty-requests.index', [
            'items' => $query->paginate(20)->withQueryString(),
            'filter' => $filter ?: 'all',
            'unreadCount' => WarrantyRequest::unread()->count(),
            'title' => 'Warranty Requests',
        ]);
    }

    public function show(WarrantyRequest $warrantyRequest): View
    {
        $warrantyRequest->markAsRead();

        return view('screens.admin.warranty-requests.show', [
            'warranty' => $warrantyRequest,
            'title' => 'Warranty from '.$warrantyRequest->name,
        ]);
    }

    public function markAllRead(): RedirectResponse
    {
        WarrantyRequest::unread()->update(['read_at' => now()]);

        return redirect()
            ->route('admin.warranty-requests.index')
            ->with('success', 'All warranty requests marked as read.');
    }

    public function destroy(WarrantyRequest $warrantyRequest): RedirectResponse
    {
        $warrantyRequest->delete();

        return redirect()
            ->route('admin.warranty-requests.index')
            ->with('success', 'Warranty request deleted.');
    }
}
