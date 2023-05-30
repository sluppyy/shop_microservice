<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class HatProduct extends Product
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'preview_img_url', 'price', 'model', 'custom_model_data'];

    public function purchases()
    {
        return $this->hasMany(HatPurchase::class, 'product_id');
    }
}