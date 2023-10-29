<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $fillable = ['product_name', 'quantity', 'total', 'order_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Receipt.php
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_name', 'name');
    }


    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}