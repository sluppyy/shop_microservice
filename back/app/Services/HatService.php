<?php

namespace App\Services;

use App\DTO\HatProduct\CreateHatProductDTO;
use App\DTO\HatProduct\UpdateHatProductDTO;
use App\Repositories\HatProductRepository;

class HatProductService
{
  function __construct(
    private HatProductRepository $productRepo
  ) {
  }

  function findProducts()
  {
    return $this->productRepo->find();
  }

  function createProduct(CreateHatProductDTO $dto)
  {
    return $this->productRepo->create($dto);
  }

  function updateProduct(UpdateHatProductDTO $dto)
  {
    return $this->productRepo->update($dto);
  }

  function destroy(int $id)
  {
    return $this->productRepo->destroy($id);
  }
}