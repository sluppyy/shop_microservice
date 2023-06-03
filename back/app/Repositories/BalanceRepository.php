<?php

namespace App\Repositories;

use App\Models\UserBalance;

class BalanceRepository
{
  function create(string $userId, $candies = 0)
  {
    $balance = UserBalance::create(['user_id' => $userId, 'candies' => $candies]);
    return $balance;
  }

  function find(int $pageSize = 10, int $page = null)
  {
    //implicit transmission of $page for pagination
    $_GET['page'] = $page ?? $_GET['page'] ?? 1;
    return UserBalance::paginate($pageSize);
  }

  function findUserBalance(string $userId): UserBalance|null
  {
    return UserBalance::find($userId);
  }
}