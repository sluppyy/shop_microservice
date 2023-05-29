<?php

namespace App\Repositories;

use App\Models\HatProduct;

class HatProductRepository
{
  function find(int $pageSize = 10, int $page = null)
  {
    //implicit transmission of $page for pagination
    $_GET['page'] = $page ?? $_GET['page'] ?? 1;
    return HatProduct::paginate($pageSize);
  }

  function findOne(int $id): HatProduct|null
  {
    return HatProduct::find($id);
  }

  function create(mixed $dto): HatProduct
  {
    return HatProduct::create($dto);
  }

  function update(mixed $dto): HatProduct|null
  {
    $product = HatProduct::find($dto['id']);
    if ($product === null)
      return null;

    $product->fill($dto);
    $product->save();
    return $product;
  }

  function destroy(int $id): bool
  {
    return HatProduct::destroy($id) === 1;
  }
}