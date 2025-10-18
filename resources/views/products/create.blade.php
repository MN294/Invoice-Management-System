@extends('layout.app')
<head>
  <title>Create Product</title>
  <!-- <style>
    body { font-family: system-ui, Arial, sans-serif; margin: 24px; }
    label { display:block; margin-top: 12px; }
    input { width: 300px; padding: 6px; margin-top: 4px; }
    button { margin-top: 16px; padding: 8px 12px; }
    .error { color: red; font-size: 0.9em; }
  </style> -->
</head>
<body>
  <h2>Create Product</h2>

  <form action="{{ route('products.store') }}" method="POST" class="card p-4 shadow-sm">
    @csrf

    <label>Name:</label>
        <input type="text" name="name" required  class="form-control">
    </br><br>
    <label>SKU:</label>
        <input type="text" name="sku" required  class="form-control">
    </br><br>
    <label>Description:</label>
        <input type="text" name="description"  class="form-control">
    </br><br>
    <label>Price:</label>
        <input type="number" step="0.01" name="price" required  class="form-control">
    </br><br>
    <label>Stock Quantity:</label>
        <input type="number" name="stock_qty" required  class="form-control"><br>
    </br><br>
    <button type="submit" class="btn btn-primary">Save</button>
    <br>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
  </form>
</body>

