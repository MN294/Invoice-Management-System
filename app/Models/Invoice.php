<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /** @use HasFactory<\Database\Factories\InvoiceFactory> */
    use HasFactory;
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
   protected $fillable = [
        'customer_id',
        'invoice_date',
        'due_date',
        'total_amount',
    ];
}
#(Mariam)I added the items() relationship and the customer() relationship to the Invoice model.

