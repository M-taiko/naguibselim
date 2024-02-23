<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cases extends Model
{
    use HasFactory;
    protected $table = 'cases';
    protected $fillable = [
        'name',
        'address',
        'age',
        'phone',
        'maritalStatus',
        'researcher',
        'BelongesTo',
        'Neighborhood',
        'governorate',
        'DescriptionOfTheHouse',
        'DescriptionOfTheCase',
        'income',
        'NSamount',
        'SearchHistory',
        'receivedDate',
        'HelpHistory',
        'situation',
        'IsUrgent',
        'notes',
        'StatusType',
        'created_at',
        'updated_at'
    ];
}
