@extends('layout.app') 

@section('content')
<div class="container">
    <h1>Invoice details #{{ $invoice->id }}</h1>

    <div class="card mb-3">
        <div class="card-header">Customer information</div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $invoice->customer->name }}</p>
            <p><strong>e-mail:</strong> {{ $invoice->customer->email }}</p>
            <p><strong>the address:</strong> {{ $invoice->customer->address }}</p>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">Invoice details </div>
        <div class="card-body">
            <p><strong>Invoice date:</strong> {{ $invoice->invoice_date }}</p>
            <p><strong>due date:</strong> {{ $invoice->due_date }}</p>
            <p><strong>Total amount :</strong> {{ number_format($invoice->total_amount, 2) }}</p>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">Invoice items</div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price per unit</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoice->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->unit_price, 2) }}</td>
                        <td>{{ number_format($item->line_total, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <a href="{{ route('invoices.index') }}" class="btn btn-secondary">Back to Bill List</a>
    <a href="{{ route('invoices.exportPdf', $invoice->id) }}" class="btn btn-danger">export PDF</a>
</div>
@endsection