<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\transactions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'balance',
        'Role'
    ];
    public function to_User()
    {
        return $this->hasMany(transactions::class);
    }
    public function from_User()
    {
        return $this->hasMany(transactions::class );
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



  
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    
    public function users()
    {
        return $this->hasMany(transactions::class);
    }

    
  
    public function ToUsers()
    {
        return $this->hasMany(transactions::class);
    }
    
    public function FromUsers(){
        return $this->hasMany(transactions::class);
    }
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'Role' => 'array',
    ];
}
