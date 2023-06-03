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

  function find(int $pageSize = 10, int $page = null)
  {
    //implicit transmission of $page for pagination
    $_GET['page'] = $page ?? $_GET['page'] ?? 1;
    return HatPurchase::paginate($pageSize);
  }
}