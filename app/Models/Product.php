<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// import the related model (optional if you use the full path below)
use App\Models\InvoiceItem;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    // Allow mass assignment for these columns
    protected $fillable = ['name', 'sku', 'description', 'price', 'stock_qty'];

    public function invoiceItems()
    {
        // Either of these is fine:
        // return $this->hasMany(\App\Models\InvoiceItem::class);
        return $this->hasMany(InvoiceItem::class);
    }
}


# (Mariam) I added the invoiceItems() relationship to the Product model.
