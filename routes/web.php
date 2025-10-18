<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('customers', CustomerController::class);

use App\Http\Controllers\ProductController;

Route::resource('products', ProductController::class);

use App\Http\Controllers\InvoiceController;
Route::resource('invoices', InvoiceController::class);
Route::get('invoices/{invoice}/pdf', [InvoiceController::class, 'exportPdf'])->name('invoices.exportPdf');
