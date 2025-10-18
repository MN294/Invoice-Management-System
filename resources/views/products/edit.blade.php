
@extends('layout.app')
<head>
  <title>Edit Product</title>
  <!-- <style>
    body { font-family: system-ui, Arial, sans-serif; margin: 24px; }
    label { display:block; margin-top: 12px; }
    input { width: 300px; padding: 6px; margin-top: 4px; }
    button { margin-top: 16px; padding: 8px 12px; }
    .error { color: red; font-size: 0.9em; }
  </style> -->
</head>
<body>
  <h2>Edit Product</h2>

  <form method="POST" action="{{ route('products.update', $product) }}" class="card p-4 shadow-sm">
    @csrf
    @method('PUT')
    <label>Name:
      <input type="text" name="name" value="{{ old('name', $product->name) }}">
      @error('name') <div class="error">{{ $message }}</div> @enderror
    </label>
      </br><br> 
    <label>SKU:
      <input type="text" name="sku" value="{{ old('sku', $product->sku) }}">
      @error('sku') <div class="error">{{ $message }}</div> @enderror
    </label>
      </br><br>
    <label>Description:
      <input type="text" name="description" value="{{ old('description', $product->description) }}">
      @error('description') <div class="error">{{ $message }}</div> @enderror
    </label>
      </br><br>
    <label>Price:
      <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}">
      @error('price') <div class="error">{{ $message }}</div> @enderror
    </label>
      </br><br>
    <label>Stock Quantity:
      <input type="number" name="stock_qty" value="{{ old('stock_qty', $product->stock_qty) }}">
      @error('stock_qty') <div class="error">{{ $message }}</div> @enderror
    </label>
      </br><br>
    <button type="submit" class="btn btn-primary">Update</button>
    <br>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
  </form>
</body>

