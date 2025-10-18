<!DOCTYPE html>
<html>
<head>
    <title>invoice #{{ $invoice->id }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif; /* Supports Arabic language */
            direction: rtl; /* For right-to-left text direction*/
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: right;
        }
        .header, .footer {
            text-align: center;
            margin-bottom: 20px;
        }
        .total {
            text-align: left;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>invoice</h1>
        <p>invoice number : #{{ $invoice->id }}</p>
        <p>invoice date : {{ $invoice->invoice_date }}</p>
        <p>Due date : {{ $invoice->due_date }}</p>
    </div>

    <div class="customer-info">
        <h3>Customer Information:</h3>
        <p><strong>Name:</strong> {{ $invoice->customer->name }}</p>
        <p><strong> e-mail:</strong> {{ $invoice->customer->email }}</p>
        <p><strong>address:</strong> {{ $invoice->customer->address }}</p>
    </div>

    <h3>Invoice items: :</h3>
    <table>
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

    <div class="total">
        <h3> Total amount : {{ number_format($invoice->total_amount, 2) }}</h3>
    </div>

    <div class="footer">
        <p> Thank you !</p>
    </div>
</body>
</html>