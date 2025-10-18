<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::with(['customer', 'items.product'])->orderBy('created_at', 'asc')->get();
        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('invoices.create', compact('customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
{
    $request->validate([
        'customer_id' => 'required|exists:customers,id',
        'invoice_date' => 'required|date',
        'due_date' => 'required|date|after_or_equal:invoice_date',
        'products' => 'required|array|min:1',
        'products.*.product_id' => 'required|exists:products,id',
        'products.*.quantity' => 'required|integer|min:1',
        'products.*.price' => 'required|numeric|min:0', 
    ]);

    $invoice = Invoice::create([
        'customer_id' => $request->customer_id,
        'invoice_date' => $request->invoice_date,
        'due_date' => $request->due_date,
        'total_amount' => 0, // Will be calculated later
    ]);

    $totalAmount = 0;
    foreach ($request->products as $item) {
        $product = Product::find($item['product_id']);
        $subtotal = $item['quantity'] * $item['price']; 

        InvoiceItem::create([
            'invoice_id' => $invoice->id,
            'product_id' => $item['product_id'],
            'quantity'   => $item['quantity'],
            'unit_price' => $item['price'], // renamed here
            'line_total' => $subtotal,
        ]);

        $totalAmount += $subtotal;

        // Optionally, update product stock
        if ($product) {
            $product->stock_qty -= $item['quantity'];
            $product->save();
        }
    }

    $invoice->total_amount = $totalAmount;
    $invoice->save();

    return redirect()->route('invoices.index')->with('success', 'Invoice created successfully!');
}
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'customer_id' => 'required|exists:customers,id',
    //         'invoice_date' => 'required|date',
    //         'due_date' => 'required|date|after_or_equal:invoice_date',
    //         'products' => 'required|array|min:1',
    //         'products.*.product_id' => 'required|exists:products,id',
    //         'products.*.quantity' => 'required|integer|min:1',
    //         'products.*.unit_price' => 'required|numeric|min:0',
    //     ]);

    //     $invoice = Invoice::create([
    //         'customer_id' => $request->customer_id,
    //         'invoice_date' => $request->invoice_date,
    //         'due_date' => $request->due_date,
    //         'total_amount' => 0, // Will be calculated later
    //     ]);

    //     $totalAmount = 0;
    //     foreach ($request->products as $item) {
    //         $product = Product::find($item['product_id']);
    //         $subtotal = $item['quantity'] * $item['unit_price'];
    //         InvoiceItem::create([
    //             'invoice_id' => $invoice->id,
    //             'product_id' => $item['product_id'],
    //             'quantity' => $item['quantity'],
    //             'unit_price' => $item['unit_price'],
    //             'line_total' => $subtotal,
    //         ]);
    //         $totalAmount += $subtotal;

    //         // Optionally, update product stock
    //         if ($product) {
    //             $product->stock_qty -= $item['quantity'];
    //             $product->save();
    //         }
    //     }

    //     $invoice->total_amount = $totalAmount;
    //     $invoice->save();

    //     return redirect()->route('invoices.index')->with('success', 'Invoice created successfully!');
    // }

    // /**
    // Display the specified resource.
    //  
    public function show(Invoice $invoice)
    {
        $invoice->load(['customer', 'items.product']);
        return view('invoices.show', compact('invoice'));
    }

    /**
     * Export the specified invoice as PDF.
     */
    public function exportPdf(Invoice $invoice)
    {
        $invoice->load(['customer', 'items.product']);
        $pdf = Pdf::loadView('invoices.pdf', compact('invoice'));
        return $pdf->download('invoice-' . $invoice->id . '.pdf');
    }
}