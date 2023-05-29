<?php

namespace App\DTO\HatProduct;

use App\Http\Requests\StoreHatProductRequest;

readonly class CreateHatProductDTO
{
  function __construct(
    public string $name,
    public string $description,
    public int $price,
    public string $model,
    public string $custom_model_data
  ) {
  }

  static function fromRequest(StoreHatProductRequest $request)
  {
    $validated = $request->validated();

    return new CreateHatProductDTO(
      name: $validated['name'],
      description: $validated['description'],
      price: $validated['price'],
      model: $validated['model'],
      custom_model_data: $validated['custom_model_data']
    );
  }
}