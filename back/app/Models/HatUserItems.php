<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class HatUserItems extends UserItems
{
    use HasFactory;

    protected $table = 'hat_user_items';
    protected $fillable = ['user_id', 'product_id', 'count'];

    protected $primaryKey = 'user_id';
    protected $casts = [
        'user_id' => 'string'
    ];

    public function product()
    {
        return $this->belongsTo(HatProduct::class);
    }
}