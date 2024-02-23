<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class suppliers extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
    protected $fillable = [
        'name',
        'code',
        'phone',
        'balance',
    ];

    public function add($amount) {
        $this->balance = $this->balance ?? 0;
        $this->balance += $amount;
        $this->save();
    }

    public function subtract($amountToSubtract){
        $this->balance = $this->balance ?? 0;
        $this->balance -= $amountToSubtract;
        $this->save();
      
    }


}
