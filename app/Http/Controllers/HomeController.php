<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'title' => 'Dashboard',
            'customersCount' => \App\Models\Customer::count(),
            'productsCount' => \App\Models\Product::count(),
            'invoicesCount' => \App\Models\Invoice::count(),
            'totalRevenue' => \App\Models\Invoice::sum('total_amount'),
            'recentInvoices' => \App\Models\Invoice::with('customer')->orderBy('created_at', 'desc')->take(5)->get()
        ]);
    }
}
