<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Services\HatService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HatPurchasesController extends Controller
{
    function __construct(private HatService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = $this->service->findPurchases();
        return Inertia::render('HatPurchases/Index', compact('purchases'));
    }
}