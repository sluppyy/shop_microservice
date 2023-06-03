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
}