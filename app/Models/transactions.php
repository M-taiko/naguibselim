<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\cases;
use App\Models\treasury;

use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'fromUser_id', 'toUser_id' ,'cases','treasury','amount','transaction_date','description','transaction_type','status','created_at'
    ];
 

    public function to_user()
    {
        return $this->belongsTo(User::class ,  'toUser_id' );
    }
    public function from_user()
    {
        return $this->belongsTo(User::class ,  'fromUser_id' );
    }
    
 
    public function cases()
    {
        return $this->belongsTo(cases::class , 'cases');
    }
    public function treasury(){
        return $this->belongsTo(treasury::class ,'treasury');
    
    }




}
