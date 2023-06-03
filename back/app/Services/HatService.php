<?php

namespace App\Services;

use App\Jobs\BuyHat;
use App\Repositories\HatProductRepository;
use App\Repositories\HatPurchaseRepository;
use Illuminate\Support\Facades\Storage;

class HatService
{
  function __construct(
    private HatProductRepository $productRepo,
    private BalanceService $balanceService,
    private HatPurchaseRepository $purchaseRepo
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

  //TODO add custom exception
  function createBuyHatRequest(string $user_id, int $product_id, int $count = 1)
  {
    if ($count <= 0)
      return null;

    $balance = $this->balanceService->findUserBalance($user_id);
    if ($balance == null)
      return null;

    $product = $this->findProduct($product_id);
    if ($product == null)
      return null;

    if ($product->price * $count > $balance->candies)
      return null;

    BuyHat::dispatch($product_id, $user_id, $count);

    return true;
  }

  /**
   * private method. use createBuyHatRequest instead
   */
  function _buyHat(string $user_id, int $product_id, int $count = 1)
  {
    if ($count <= 0)
      return;

    $balance = $this->balanceService->findUserBalance($user_id);
    if ($balance == null)
      return;

    $product = $this->findProduct($product_id);
    if ($product == null)
      return;

    $candiesToDecrease = $product->price * $count;
    if ($candiesToDecrease > $balance->candies)
      return;

    $this->purchaseRepo->create($user_id, $product_id, $product->price, $count);
    $this->balanceService->decreaseBalance($user_id, $candiesToDecrease);
  }
}