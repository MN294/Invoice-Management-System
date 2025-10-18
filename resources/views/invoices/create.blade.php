@extends('layout.app') 

@section('content')
<div class="container">
    <h1>Create a new invoice</h1>

    <form action="{{ route('invoices.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="customer_id" class="form-label">Client:</label>
            <select name="customer_id" id="customer_id" class="form-control" required>
                <option value="">Choose a client</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
            @error('customer_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="invoice_date" class="form-label">Invoice Date:</label>
            <input type="date" name="invoice_date" id="invoice_date" class="form-control" value="{{ date('Y-m-d') }}" required>
            @error('invoice_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">due date:</label>
            <input type="date" name="due_date" id="due_date" class="form-control" value="{{ date('Y-m-d', strtotime('+7 days')) }}" required>
            @error('due_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <hr>
        <h3>Invoice items</h3>
        <table class="table" id="invoice-items-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price per unit</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {{-- Product rows will be added here by JavaScript --}}
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end"><strong>Total amount:</strong></td>
                    <td id="total-amount">0.00</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
         <button type="button" class="btn btn-success mt-2" id="add-product-row">➕ Add Product</button>
         <br><br>
        <button type="submit" class="btn btn-primary mb-3">💾 Save Invoice</button>
        <br>
        <a href="{{ route('invoices.index') }}" class="btn btn-secondary"> Back</a>
    </form>
</div>
@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const products = @json($products);
        const invoiceItemsTableBody = document.querySelector('#invoice-items-table tbody');
        const totalAmountElement = document.querySelector('#total-amount');
        let itemIndex = 0;

        // Function to add a new product row
        function addProductRow() {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>
                    <select name="products[${itemIndex}][product_id]" class="form-control product-select" required>
                        <option value="">Choose a product</option>
                        ${products
                            .filter(product => product.stock_qty > 0)
                            .map(product => `<option value="${product.id}" data-price="${product.price}">${product.name} (${parseFloat(product.price).toFixed(2)})</option>`)
                            .join('')}
                    </select>
                </td>
                <td>
                    <input type="number" name="products[${itemIndex}][quantity]" class="form-control quantity-input" value="1" min="1" required>
                </td>
                <td>
                    <input type="number" name="products[${itemIndex}][price]" class="form-control price-input" step="0.01" min="0" required>
                </td>
                <td>
                    <span class="subtotal">0.00</span>
                    <input type="hidden" name="products[${itemIndex}][subtotal]" class="subtotal-hidden">
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-product-row">Remove</button>
                </td>
            `;

            invoiceItemsTableBody.appendChild(row);
            itemIndex++;
            attachEventListeners(row);
            updateTotals();
        }

        function attachEventListeners(row) {
            row.querySelector('.product-select').addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const priceInput = row.querySelector('.price-input');
                if (selectedOption.dataset.price) {
                    priceInput.value = parseFloat(selectedOption.dataset.price).toFixed(2);
                }
                updateRowTotal(row);
            });

            row.querySelector('.quantity-input').addEventListener('input', function() {
                updateRowTotal(row);
            });

            row.querySelector('.price-input').addEventListener('input', function() {
                updateRowTotal(row);
            });

            row.querySelector('.remove-product-row').addEventListener('click', function() {
                row.remove();
                updateTotals();
            });
        }

        function updateRowTotal(row) {
            const quantity = parseFloat(row.querySelector('.quantity-input').value) || 0;
            const price = parseFloat(row.querySelector('.price-input').value) || 0;
            const subtotal = quantity * price;
            row.querySelector('.subtotal').textContent = subtotal.toFixed(2);
            row.querySelector('.subtotal-hidden').value = subtotal.toFixed(2);
            updateTotals();
        }

        function updateTotals() {
            let grandTotal = 0;
            const rows = invoiceItemsTableBody.querySelectorAll('tr');
            rows.forEach(row => {
                const subtotal = parseFloat(row.querySelector('.subtotal').textContent) || 0;
                grandTotal += subtotal;
            });
            totalAmountElement.textContent = grandTotal.toFixed(2);
        }

        // Attach event to Add Product button
        const addProductBtn = document.getElementById('add-product-row');
        if (addProductBtn) {
            addProductBtn.addEventListener('click', addProductRow);
        }
    });
</script>
@endpush
<!-- @push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const products = @json($products);
        const invoiceItemsTableBody = document.querySelector('#invoice-items-table tbody');
        const totalAmountElement = document.querySelector('#total-amount');
        let itemIndex = 0;

        // Ensure the add-product-row button exists before attaching event
        const addProductBtn = document.getElementById('add-product-row');
        if (addProductBtn) {
            addProductBtn.addEventListener('click', addProductRow);
        }
    });

    function addProductRow() {
        const row = document.createElement('tr');
        row.innerHTML = `
        <td>
            <select name="products[${itemIndex}][product_id]" class="form-control product-select" required>
                <option value="">Choose a product</option>
                ${products
                    .filter(product => product.stock_qty > 0)
                    .map(product => `<option value="${product.id}" data-price="${product.price}">${product.name} (${parseFloat(product.price).toFixed(2)})</option>`)
                    .join('')}
            </select>
        </td>
        <td>
            <input type="number" name="products[${itemIndex}][quantity]" class="form-control quantity-input" value="1" min="1" required>
        </td>
        <td>
            <input type="number" name="products[${itemIndex}][price]" class="form-control price-input" step="0.01" min="0" required>
        </td>
        <td>
            <span class="subtotal">0.00</span>
            <input type="hidden" name="products[${itemIndex}][subtotal]" class="subtotal-hidden">
        </td>
        <td>
            <button type="button" class="btn btn-danger btn-sm remove-product-row">Remove</button>
        </td>
    `;

    invoiceItemsTableBody.appendChild(row);
    itemIndex++;
    attachEventListeners(row);
    updateTotals();
}

        function attachEventListeners(row) {
            row.querySelector('.product-select').addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const priceInput = row.querySelector('.price-input');
                if (selectedOption.dataset.price) {
                    priceInput.value = parseFloat(selectedOption.dataset.price).toFixed(2);
                }
                updateRowTotal(row);
            });

            row.querySelector('.quantity-input').addEventListener('input', function() {
                updateRowTotal(row);
            });

            row.querySelector('.price-input').addEventListener('input', function() {
                updateRowTotal(row);
            });

            row.querySelector('.remove-product-row').addEventListener('click', function() {
                row.remove();
                updateTotals();
            });
        }

        function updateRowTotal(row) {
            const quantity = parseFloat(row.querySelector('.quantity-input').value) || 0;
            const price = parseFloat(row.querySelector('.price-input').value) || 0;
            const subtotal = quantity * price;
            row.querySelector('.subtotal').textContent = subtotal.toFixed(2);
            row.querySelector('.subtotal-hidden').value = subtotal.toFixed(2);
            updateTotals();
        }

    function updateTotals() {
        let grandTotal = 0;
        const rows = invoiceItemsTableBody.querySelectorAll('tr');
        rows.forEach(row => {
            const subtotal = parseFloat(row.querySelector('.subtotal').textContent) || 0;
            grandTotal += subtotal;
        });
        totalAmountElement.textContent = grandTotal.toFixed(2);
    }
</script>
@endpush
 -->
