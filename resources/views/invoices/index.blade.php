@extends('layout.app')
<head>
    <title>Invoices</title>
    <style>
            .table {
            background: #fff;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        
    </style>
</head>

@section('content')
<div class="container">
    <h1>Invoices</h1>
    <a href="{{ route('invoices.create') }}" class="btn btn-primary">Create a new invoice</a>
    <a href="{{ route('home') }}" class="btn btn-secondary">🏠 Home</a>

    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped mt-3">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Client</th>
                <th>Invoice date</th>
                <th>Due date</th>
                <th>Total amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
            <tr>
                <td>{{ $invoice->id }}</td>
                <td>{{ $invoice->customer->name }}</td>
                <td>{{ $invoice->invoice_date }}</td>
                <td>{{ $invoice->due_date }}</td>
                <td>{{ number_format($invoice->total_amount, 2) }}</td>
                <td>
                    <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('invoices.exportPdf', $invoice->id) }}" class="btn btn-success btn-sm">Export PDF</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection