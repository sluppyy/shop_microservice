<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class HatPurchase extends Purchase
{
    use HasFactory;

    protected $fillable = ['product_id', 'user_id', 'price', 'count'];
}