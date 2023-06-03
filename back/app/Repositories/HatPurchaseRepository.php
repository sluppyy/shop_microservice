<?php

namespace App\Repositories;

use App\Models\HatPurchase;

class HatPurchaseRepository
{
  function create(
    string $user_id,
    int $product_id,
    int $price,
    int $count
  ): HatPurchase {
    return HatPurchase::create(
      compact(
        'user_id',
        'product_id',
        'price',
        'count'
      )
    );
  }
}