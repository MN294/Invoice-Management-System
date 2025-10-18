<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    /** @use HasFactory<\Database\Factories\InvoiceItemFactory> */
    use HasFactory;
    #(amjad) i'm make sure if invocies have relationship with prduct 
    protected $fillable = [
        'invoice_id',
        'product_id',
        'quantity',
        'unit_price',
        'line_total',
    ];
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($invoiceItem) {
            $invoiceItem->line_total = $invoiceItem->quantity * $invoiceItem->unit_price;
        });
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    protected static function booted()
{
    static::saved(function ($item) {
        $invoice = $item->invoice;
        $invoice->total_amount = $invoice->items()->sum('line_total');
        $invoice->save();
    });

    static::deleted(function ($item) {
        $invoice = $item->invoice;
        $invoice->total_amount = $invoice->items()->sum('line_total');
        $invoice->save();
    });
}
}

# (Mariam) I added the invoice() and product() relationships to the InvoiceItem model.
