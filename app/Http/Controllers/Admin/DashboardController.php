<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'productCount' => Product::count(),
            'pharmaCount' => Product::where('company', 'pharma')->count(),
            'meditechCount' => Product::where('company', 'meditech')->count(),
            'unreadCount' => ContactMessage::whereNull('read_at')->count(),
            'recentMessages' => ContactMessage::latest()->take(5)->get(),
        ]);
    }
}
