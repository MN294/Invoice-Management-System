<!DOCTYPE html>
<html>
<head>
    <title>Edit Customer</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
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

        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            padding: 20px;
            max-width: 600px;
            margin: auto;
        }

        .btn {
            border-radius: 5px;
            padding: 6px 12px;
        }
    </style>
</head>
<body>
<div class="container">

    <div class="card">
        <h1>Edit Customer</h1>

        <!-- Back button -->
        <a href="{{ route('customers.index') }}" class="btn btn-secondary mb-3">⬅ Back</a>

        <!-- Edit form -->
        <form action="{{ route('customers.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" value="{{ $customer->name }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" value="{{ $customer->email }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" value="{{ $customer->phone }}" class="form-control">
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea name="address" class="form-control">{{ $customer->address }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">💾 Update</button>
        </form>
    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>