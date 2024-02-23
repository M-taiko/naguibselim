<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice_line extends Model
{
    use HasFactory;

    protected $table = 'invoice_line'; // Corrected table name
    protected $fillable = [
        'invoice_id',
        'product_id',
        'product_name',
        'buy_price',
        'sell_price',
        'quantity',
        'total',
        'profit_per_product',
    ];

    // Corrected relationship method name and added correct pivot columns
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id', 'id');
    }
}
