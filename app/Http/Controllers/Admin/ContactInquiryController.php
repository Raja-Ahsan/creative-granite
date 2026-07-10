<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactInquiryController extends Controller
{
    public function index(Request $request): View
    {
        $filter = $request->string('filter')->toString();

        $query = ContactInquiry::query()->recent();

        if ($filter === 'unread') {
            $query->unread();
        }

        return view('screens.admin.contact-inquiries.index', [
            'items' => $query->paginate(20)->withQueryString(),
            'filter' => $filter ?: 'all',
            'unreadCount' => ContactInquiry::unread()->count(),
            'title' => 'Contact Enquiries',
        ]);
    }

    public function show(ContactInquiry $contactInquiry): View
    {
        $contactInquiry->markAsRead();

        return view('screens.admin.contact-inquiries.show', [
            'inquiry' => $contactInquiry,
            'title' => 'Enquiry from '.$contactInquiry->name,
        ]);
    }

    public function markAllRead(): RedirectResponse
    {
        ContactInquiry::unread()->update(['read_at' => now()]);

        return redirect()
            ->route('admin.contact-inquiries.index')
            ->with('success', 'All enquiries marked as read.');
    }

    public function destroy(ContactInquiry $contactInquiry): RedirectResponse
    {
        $contactInquiry->delete();

        return redirect()
            ->route('admin.contact-inquiries.index')
            ->with('success', 'Enquiry deleted.');
    }
}
