<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHatProductRequest;
use App\Http\Requests\UpdateHatProductRequest;
use App\Services\HatService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class HatProductsController extends Controller
{
    public function __construct(
        private HatService $service
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->service->findProducts();

        return Inertia::render('HatProducts/Index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('HatProducts/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHatProductRequest $request)
    {
        $product = $this->service->createProduct($request->validated());

        return Redirect::route('hatProducts.edit', $product->id);
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = $this->service->findProduct($id);

        if ($product == null) {
            return abort(404);
        }

        return Inertia::render('HatProducts/Edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHatProductRequest $request, string $id)
    {
        $validated = $request->validated();
        $product = $this->service->updateProduct($id, $validated);

        if ($product == null) {
            return abort(404);
        }



        return Redirect::route('hatProducts.edit', $product->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = $this->service->destroy($id);

        if ($deleted == null) {
            return abort(404);
        }

        return Redirect::route('hatProducts.index');
    }
}