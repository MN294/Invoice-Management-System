<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    protected $fillable = ['name', 'email', 'phone', 'address'];
}


// Tables I created in the db (Mariam):
// 	•	customers → id, name, email, phone, address
// 	•	products → id, name, price, stock_qty
// 	•	invoices → id, customer_id, date, total_amount
// 	•	invoice_items → id, invoice_id, product_id, quantity, unit_price, line_total

// Relationships:
// 	•	Customer hasMany Invoices.
// 	•	Invoice belongsTo Customer.
// 	•	Invoice hasMany InvoiceItems.
// 	•	Product hasMany InvoiceItems.