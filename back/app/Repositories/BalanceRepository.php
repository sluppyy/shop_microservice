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

  function findUserBalance(string $userId): UserBalance|null
  {
    return UserBalance::find($userId);
  }
}