<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Hat\TakeHatItemsRequest;
use App\Services\HatService;
use Illuminate\Http\Request;

class ApiUserHatItemsController extends Controller
{
    function __construct(
        private HatService $service
    ) {
    }

    function takeItems(TakeHatItemsRequest $request)
    {
        $validated = $request->validated();
        $this->service->takeUserItems($validated['user_id'], $validated['product_id'], $validated['count']);
    }
}