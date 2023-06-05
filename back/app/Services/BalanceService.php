<?php

namespace App\Services;

use App\Repositories\BalanceRepository;

class BalanceService
{
  public function __construct(
    private BalanceRepository $repo
  ) {

  }
  function findUserBalance(string $userId)
  {
    $balance = $this->repo->findUserBalance($userId);

    if ($balance == null) {
      $balance = $this->repo->create($userId);
    }

    return $balance;
  }

  function findUserBalances(int $perPage = 10, int $page = 10)
  {
    return $this->repo->find($perPage, $page);
  }

  function decreaseBalance(string $user_id, int $count)
  {
    $balance = $this->findUserBalance($user_id);
    if ($balance == null)
      return null;
    $balance->candies -= $count;
    $balance->save();
    return $balance;
  }

  function increaseBalance(string $user_id, int $count)
  {
    $balance = $this->findUserBalance($user_id);
    if ($balance == null)
      return null;
    $balance->candies += $count;
    $balance->save();
    return $balance;
  }
}