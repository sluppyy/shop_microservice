<?php

namespace App\Http\Controllers\Api;

use App\Facades\JWTUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\BuyHatProductRequest;
use App\Http\Requests\StoreHatProductRequest;
use App\Http\Resources\HatProductResource;
use App\Http\Resources\UserItemsResource;
use App\Services\HatService;

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

    public function store(StoreHatProductRequest $request)
    {
        $validated = $request->validated();
        return new HatProductResource(
            $this->service->createProduct($validated)
        );
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

    public function buyHat(BuyHatProductRequest $request)
    {
        $user_id = JWTUser::userId();
        $dto = $request->validated();
        $this->service->createBuyHatRequest($user_id, $dto['product_id'], $dto['count']);
    }

    function userItems()
    {
        $user_id = JWTUser::userId();
        $perPage = $_GET['perPage'] ?? 10;
        $page = $_GET['page'] ?? 1;
        $userItems = $this->service->findAllUserItems($user_id, $perPage, $page);
        return UserItemsResource::collection($userItems);
    }
}