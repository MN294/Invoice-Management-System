@extends('layout.app')
<!DOCTYPE html>
<html>
<head>
    <title>Customers</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Simple Custom Styling -->
    <style>
        body {
            background: #f4f6f9;
            font-family: Arial, sans-serif;
            padding: 30px;
        }

        h1 {
            margin-bottom: 20px;
            font-weight: 600;
            color: #222;
        }

        .table {
            background: #fff;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            padding: 20px;
        }

        .btn {
            border-radius: 5px;
            padding: 6px 12px;
        }

        .container-box {
            max-width: 900px;
            margin: auto;
        }
    </style>
</head>
<body>
<div class="container-box">

    <h1>Customers</h1>

    <!-- Success message -->
    @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif

    <!-- Add new customer button -->
    <a href="{{ route('customers.create') }}" class="btn btn-primary mb-3">➕ Add Customer</a>
    <a href="{{ route('home') }}" class="btn btn-secondary mb-3">🏠 Home</a>

    <!-- Customers table -->
    <table class="table table-bordered table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($customers as $customer)
            <tr>
                <td>{{ $customer->id }}</td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->phone }}</td>
                <td>{{ $customer->address }}</td>
                <td class="d-flex justify-content-center align-items-center gap-2">
                    <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this customer?')">🗑️ Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>