<?php

namespace App\Repositories;

use App\Models\HatUserItems;

class HatUserItemsRepository
{
  function create(string $user_id, int $product_id, int $count): HatUserItems
  {
    return HatUserItems::create(
      compact(
        'user_id',
        'product_id',
        'count'
      )
    );
  }

  function findUserItems(string $user_id, int $product_id): HatUserItems|null
  {
    return HatUserItems::where(compact('user_id', 'product_id'))->first();
  }

  function findAllUserItems(string $user_id, int $pageSize = 10, int $page = null)
  {
    //implicit transmission of $page for pagination
    $_GET['page'] = $page ?? $_GET['page'] ?? 1;
    return HatUserItems::where(compact('user_id'))->paginate($pageSize);
  }

  function findAllUsersItems(int $pageSize = 10, int $page = null)
  {
    //implicit transmission of $page for pagination
    $_GET['page'] = $page ?? $_GET['page'] ?? 1;
    return HatUserItems::orderBy('user_id', 'desc')->paginate($pageSize);
  }

  function updateUserItems(string $user_id, int $product_id, mixed $fill)
  {
    return HatUserItems::where(compact('user_id', 'product_id'))
      ->update($fill);
  }
}