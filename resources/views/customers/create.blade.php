<!DOCTYPE html>
<html>
<head>
    
    <title>Add Customer</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background: #f8f9fa; /* light grey background */
        font-family: Arial, sans-serif;
    }

    h1 {
        margin-bottom: 20px;
        font-weight: 600;
        color: #333;
    }

    .card {
        background: #fff;
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    table {
        background: #fff;
        border-radius: 6px;
        overflow: hidden;
    }

    table th, table td {
        vertical-align: middle;
        text-align: center;
    }

    .btn {
        border-radius: 6px;
        padding: 6px 12px;
    }
</style>
</head>

<body>
    <h1>Add Customer</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="{{ route('customers.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf

        <label>Name:</label>
        <input type="text" name="name" required  class="form-control"><br>

        <label>Email:</label>
        <input type="email" name="email" required  class="form-control"><br>

        <label>Phone:</label>
        <input type="text" name="phone"  class="form-control"><br>

        <label>Address:</label>
        <input type="text" name="address"  class="form-control"><br>

        <button type="submit" class="btn btn-success">💾 Save</button>
        <br>
           <a href="{{ route('customers.index') }}" class="btn btn-secondary"> Back</a>
    </form>

 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>