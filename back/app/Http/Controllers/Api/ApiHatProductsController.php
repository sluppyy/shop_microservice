<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHatProductRequest;
use App\Http\Requests\UpdateHatProductRequest;
use App\Http\Resources\HatProductResource;
use App\Services\HatService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiHatProductsController extends Controller
{
    function __construct(
        private HatService $service
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perPage = $_GET['perPage'] ?? 10;
        $page = $_GET['page'] ?? 1;

        return HatProductResource::collection(
            $this->service->findProducts(
                perPage: $perPage,
                page: $page
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHatProductRequest $request)
    {
        $validated = $request->validated();
        $product = $this->service->createProduct($validated);
        return new HatProductResource($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = $this->service->findProduct($id);
        if ($product === null)
            abort(404);
        return new HatProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHatProductRequest $request)
    {
        $validated = $request->validated();
        $product = $this->service->updateProduct($validated);
        if ($product === null)
            abort(404);
        return new HatProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}