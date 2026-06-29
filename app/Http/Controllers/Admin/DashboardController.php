<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('screens.admin.dashboard.index', [
            'title' => 'Dashboard',
        ]);
    }
}
