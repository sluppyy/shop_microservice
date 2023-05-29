<?php

namespace App\Services;

use App\Repositories\HatProductRepository;

class HatService
{
  function __construct(
    private HatProductRepository $productRepo
  ) {
  }

  function findProducts(int $perPage = 10, int $page = 10)
  {
    return $this->productRepo->find($perPage, $page);
  }

  function findProduct(int $id)
  {
    return $this->productRepo->findOne($id);
  }

  function createProduct(mixed $dto)
  {
    return $this->productRepo->create($dto);
  }

  function updateProduct(mixed $dto)
  {
    return $this->productRepo->update($dto);
  }

  function destroy(int $id)
  {
    return $this->productRepo->destroy($id);
  }
}