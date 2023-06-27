<?php

namespace Tests\Feature\Products;

use App\Http\Resources\HatProductResource;
use App\Services\HatService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HatProductsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_find_products(): void
    {
        $response = $this->get('/api/products/hat');

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [],
            'links' => [],
            'meta' => [
                'current_page' => 1,
                'per_page' => '10'
            ]
        ]);
    }

    public function test_find_one_product(): void
    {
        /**
         * @var HatService
         */
        $service = $this->app->make(HatService::class);

        $product = $service->createProduct([
            'name' => 'name',
            'description' => 'description',
            'price' => 99,
            'model' => 'model',
            'custom_model_data' => 1
        ]);

        $response = $this->get('/api/products/hat/' . $product->id);

        $response->assertOk();
        $response->assertJson([
            'data' => (new HatProductResource($product))->jsonSerialize()
        ]);
    }

    public function test_find_not_existing_one_product(): void
    {
        $response = $this->get('/api/products/hat/1');

        $response->assertNotFound();
    }
}