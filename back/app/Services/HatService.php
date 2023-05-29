<?php

namespace App\Services;

use App\Repositories\HatProductRepository;

class HatProductService
{
  function __construct(
    private HatProductRepository $repo
  ) {
  }
}