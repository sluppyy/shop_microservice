<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\HatProductService;

class HatProductsController extends Controller
{
    function __construct(
        private HatProductService $service
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->service->kek();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}