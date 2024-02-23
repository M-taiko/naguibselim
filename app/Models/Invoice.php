<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\invoice_line;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['supplier_name', 'outlet_name', 'ordertype', 'profit', 'total_buy_price','total_amount', 'username'];


    public function invoiceLines()
    {
        return $this->hasMany(invoice_line::class, 'invoice_id', 'id');
    }
   

    public function supplier()
    {
        return $this->belongsTo(suppliers::class, 'supplier_name', 'id');
    }
}
