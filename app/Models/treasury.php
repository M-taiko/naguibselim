<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class treasury extends Model
{
    use HasFactory;
    /**make fillable table */
    protected $fillable = [
        'name',
        'balance',
        
    ];



    public function treasury(){
        return $this->hasMany(transactions::class);
    
    }

    
    public function subtract($column, $amount = 1, array $extra = []) {
        $this->balance = $this->balance ?? 0;
        $this->balance -= $amount;
        $this->save();
    }
    
    public function increment($column, $amount = 1, array $extra = [])
    {
        $this->balance = $this->balance ?? 0;
        $this->balance += $amount;
        $this->save();
    }
    
}
