<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    protected $fillable = ['name', 'address', 'phone', 'email', 'password','path','role'];
    
    protected $hidden=['password'];
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }

    public function hasPermission($permission)
    {
        return $this->isAdmin(); 
    }
}