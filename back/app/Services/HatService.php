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
    if (array_key_exists('preview', $dto)) {
      $path = Storage::disk('local')->put('public/images/products/hat', $dto['preview']);
      $dto['preview_img_url'] = $path;
    }
    return $this->productRepo->create($dto);
  }

  function updateProduct(int $id, mixed $dto)
  {
    if (array_key_exists('preview', $dto)) {
      $path = Storage::disk('local')->put('public/images/products/hat', $dto['preview']);
      $dto['preview_img_url'] = $path;

      $product = $this->findProduct($id);
      if ($product != null && $product->preview_img_url != null) {
        Storage::disk('local')->delete($product->preview_img_url);
      }
    }
    return $this->productRepo->update($id, $dto);
  }

  function destroy(int $id)
  {
    $product = $this->productRepo->destroy($id);
    if ($product != null) {
      Storage::disk('local')->delete($product->preview_img_url);
    }
    return $product;
  }
}