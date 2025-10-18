<!DOCTYPE html>
<html>
  <!-- quick minimal styling so it looks ok -->
  <!-- <style>
    body { font-family: system-ui, Arial, sans-serif; margin: 24px; }
    table { width: 100%; border-collapse: collapse; margin-top: 12px; }
    th, td { padding: 8px 10px; border-bottom: 1px solid #eee; text-align: left; }
    .top { display:flex; gap:10px; align-items:center; }
    .btn { padding: 8px 12px; border: 1px solid #555; background:#f5f5f5; border-radius:6px; text-decoration:none; color:#222;}
   
  </style> -->
  <head>
    <title>Products</title>
        <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
      <style>
        body {
            /* background: #f4f6f9; */
            font-family: Arial, sans-serif;
            padding: 30px;
        }

        h1 {
            margin-bottom: 20px;
            font-weight: 600;
            color: #222;
        }

        .table {
            /* background: #fff; */
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
        .top{
         
          margin-bottom:20px;
        }
        .container-box {
            max-width: 900px;
            margin: auto;
        }
         .right { text-align:right; }
    </style>
    </head>
<body>
<div class="container-box">
  <div class="top">
    <h2 style="margin:0;">Products</h2>
    <a class="btn btn-primary" href="{{ route('products.create') }}">+ New Product</a>
    <a class="btn btn-secondary" href="{{ route('home') }}">🏠 Home</a>
  </div>

  @if(session('success'))
    <p style="background:#e7f7ec; border:1px solid #bfe6c9; padding:8px 10px; border-radius:6px;">
      {{ session('success') }}
    </p>
  @endif

  @if(isset($products) && count($products))
    <table class="table table-bordered table-striped text-center">
      <thead class="table-dark">
        <tr>
          <th>Name</th>
          <th>SKU</th>
          <th>Description</th>
          <th class="right">Price</th>
          <th class="right">Stock</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      @foreach($products as $p)
        <tr>
          <td>{{ $p->name }}</td>
          <td>{{ $p->sku }}</td>
          <td>{{ $p->description }}</td>
          <td class="right">{{ number_format($p->price, 2) }}</td>
          <td class="right">{{ $p->stock_qty }}</td>
          <td>
            <div class="d-flex justify-content-center gap-2">
            <a href="{{ route('products.edit', $p) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
            <form action="{{ route('products.destroy', $p) }}" method="POST" onsubmit="return confirm('Delete this product?')">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm">🗑️ Delete</button>
            </form>
            </div>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  @else
    <p>No products yet.</p>
  @endif
</div>
</body>
</html>

