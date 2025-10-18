
@extends('layout.app')
 <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
  <!-- <style>
    body {
        background: #f0f2f5; /* light grey background */
        font-family: Arial, sans-serif;
        padding: 20px;
    }

    h1 {
        margin-bottom: 20px;
        font-weight: 600;
        color: #333;
    }

    .btn {
        border-radius: 6px;
        padding: 10px 15px;
        margin-right: 10px;
    }

    .stats, .recent-activity {
        background: #fff;
        border-radius: 8px;
        padding: 20px;
        margin-top: 20px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .stats ul, .recent-activity ul {
        list-style-type: none;
        padding-left: 0;
    }

    .stats li, .recent-activity li {
        margin-bottom: 10px;
        font-size: 16px;
    } -->
 <style>
h1 {
    font-weight: 700;
    color: #0d6efd; /* Bootstrap primary blue */
    margin-bottom: 1.5rem;
}
.top {
    margin-left: 1rem;
    margin-bottom: 2rem;

}
/* Stats section styling */
.stats {
    background: #f8f9fa; /* Bootstrap light gray */
    padding: 1.5rem;
    border-radius: 0.5rem;
    margin-top: 2rem;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
}

.stats ul {
    list-style: none;
    padding-left: 0;
}

.stats li {
    font-size: 1.1rem;
    padding: 0.25rem 0;
}

/* Recent activity section */
.recent-activity {
    margin-top: 2rem;
    padding: 1.5rem;
    border-left: 4px solid #198754; /* Bootstrap success green */
    background: #ffffff;
    border-radius: 0.5rem;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
}

.recent-activity h2 {
    font-size: 1.25rem;
    margin-bottom: 1rem;
}

/* Links section */
a.btn {
    margin-right: 0.5rem;
    margin-bottom: 0.5rem;
}
</style>
<body>
  @section('content')
   <div class="text-center my-4">
    <h1>Welcome to Our Invoice App</h1>
    <!-- Links to manage customers, products, and invoices -->
        <a href="{{ route('customers.index') }}" class="btn btn-primary">Manage Customers</a>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Manage Products</a>
        <a href="{{ route('invoices.index') }}" class="btn btn-success">Manage Invoices</a>
    </div>
    <!--Stats overview of total customers, products, and invoices-->
    <div class="stats">
        <h2>Statistics Overview</h2>
        <ul>
            <li>Total Customers: {{ $customersCount }}</li>
            <li>Total Products: {{ $productsCount }}</li>
            <li>Total Invoices: {{ $invoicesCount }}</li>
            <li>Total Revenue: ${{ number_format($totalRevenue, 2) }}</li>
        </ul>
    </div>
    <!-- Recent activity log (e.g., recent invoices created) -->
    <div class="recent-activity">
        <h2>Recent Activity</h2>
        <ul>
            @foreach($recentInvoices as $invoice)
                <li>Invoice #{{ $invoice->id }} for {{ $invoice->customer->name }} - ${{ number_format($invoice->total_amount, 2) }} on {{ $invoice->created_at->format('M d, Y') }}</li>
            @endforeach
        </ul>
    </div>
</body>
  @endsection




<!-- #What I did (Mariam):
#1. Created a HomeController with an index method to fetch statistics.
#2. Updated web.php to route '/' to HomeController@index.
#3. Created a home.blade.php view to display the statistics and navigation links.
#4. Added recent activity section to show latest invoices.