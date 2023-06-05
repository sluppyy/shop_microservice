<?php

namespace App\Services;

use App\Jobs\BuyHat;
use App\Repositories\HatProductRepository;
use App\Repositories\HatPurchaseRepository;
use App\Repositories\HatUserItemsRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HatService
{
  function __construct(
    private HatProductRepository $productRepo,
    private BalanceService $balanceService,
    private HatPurchaseRepository $purchaseRepo,
    private HatUserItemsRepository $userItemsRepo
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

  function findPurchases(int $perPage = 10, int $page = 10)
  {
    return $this->purchaseRepo->find($perPage, $page);
  }

  function createBuyHatRequest(string $user_id, int $product_id, int $count = 1)
  {
    if ($count <= 0)
      throw new \App\Exceptions\NotPositiveCountException();

    $balance = $this->balanceService->findUserBalance($user_id);
    if ($balance == null)
      throw new \App\Exceptions\NotFoundBalanceException();


    $product = $this->findProduct($product_id);
    if ($product == null)
      throw new \App\Exceptions\NotFoundHatProductException();


    if ($product->price * $count > $balance->candies)
      throw new \App\Exceptions\NotEnoughCandiesException();

    BuyHat::dispatch($product_id, $user_id, $count);

    return true;
  }

  function findUserItems(string $user_id, int $product_id)
  {
    return $this->userItemsRepo->findUserItems($user_id, $product_id);
  }

  function findAllUserItems(string $user_id, int $pageSize = 10, int $page = null)
  {
    return $this->userItemsRepo->findAllUserItems($user_id, $pageSize, $page);
  }

  function findAllUsersItems(int $pageSize = 10, int $page = null)
  {
    return $this->userItemsRepo->findAllUsersItems($pageSize, $page);
  }

  function giveUserItem(string $user_id, int $product_id, int $count)
  {
    if ($count < 0)
      throw new \App\Exceptions\NotPositiveCountException;

    $items = $this->findUserItems($user_id, $product_id);
    if ($items === null) {
      $items = $this->userItemsRepo->create($user_id, $product_id, $count);
      return;
    }

    $this->userItemsRepo->updateUserItems($user_id, $product_id, ['count' => $items->count + $count]);
  }

  /**
   * private method. use createBuyHatRequest instead
   */
  function _buyHat(string $user_id, int $product_id, int $count = 1)
  {
    if ($count <= 0)
      throw new \App\Exceptions\NotPositiveCountException();

    DB::beginTransaction();
    $balance = $this->balanceService->findUserBalance($user_id);
    if ($balance == null)
      throw new \App\Exceptions\NotFoundBalanceException();

    $product = $this->findProduct($product_id);
    if ($product == null)
      throw new \App\Exceptions\NotFoundHatProductException();

    $candiesToDecrease = $product->price * $count;
    if ($candiesToDecrease > $balance->candies)
      throw new \App\Exceptions\NotEnoughCandiesException();

    $this->giveUserItem($user_id, $product_id, $count);
    $this->balanceService->decreaseBalance($user_id, $candiesToDecrease);
    $this->purchaseRepo->create($user_id, $product_id, $product->price, $count);
    DB::commit();
  }
}