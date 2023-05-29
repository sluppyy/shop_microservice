<?php

namespace App\DTO\HatProduct;

use App\Http\Requests\UpdateHatProductRequest;

readonly class UpdateHatProductDTO
{
  function __construct(
    public int $id,
    public string $name,
    public string $description,
    public int $price,
    public string $model,
    public string $custom_model_data
  ) {
  }

  static function fromRequest(UpdateHatProductRequest $request)
  {
    $validated = $request->validated();

    return new UpdateHatProductDTO(
      id: $validated['id'],
      name: $validated['name'],
      description: $validated['description'],
      price: $validated['price'],
      model: $validated['model'],
      custom_model_data: $validated['custom_model_data']
    );
  }
}