<?php

namespace App\Services;

use App\Repositories\HatProductRepository;
use Illuminate\Support\Facades\Storage;

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
    if ($dto['preview'] !== null) {
      $path = Storage::disk('local')->put('public/images/products/hat', $dto['preview']);
      $dto['preview_img_url'] = $path;
    }
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