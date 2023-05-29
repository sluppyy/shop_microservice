<?php

namespace App\Repositories;

use App\DTO\HatProduct\CreateHatProductDTO;
use App\DTO\HatProduct\UpdateHatProductDTO;
use App\Models\HatProduct;

class HatProductRepository
{
  function find(int $pageSize = 10, int $page = $_GET['page'] ?? 1)
  {
    $_GET['page'] = $page;
    return HatProduct::paginate($pageSize);
  }

  function create(CreateHatProductDTO $dto): HatProduct
  {
    return HatProduct::create($dto);
  }

  function update(UpdateHatProductDTO $dto): HatProduct
  {
    return HatProduct::find('id', $dto->id);
  }

  function destroy(int $id): bool
  {
    return HatProduct::destroy($id) === 1;
  }
}