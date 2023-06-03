<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBalance extends Model
{
    use HasFactory;

    protected $table = 'user_balances';
    protected $fillable = ['user_id', 'candies'];
    protected $primaryKey = 'user_id';

    protected $casts = [
        'user_id' => 'string'
    ];
}