<?php

namespace App\Http\Controllers\Api;

use App\Facades\JWTUser;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserBalanceResource;
use App\Services\BalanceService;

class ApiUserBalancesController extends Controller
{
    function __construct(
        private BalanceService $service
    ) {
    }

    public function show()
    {
        $userId = JWTUser::userId();
        $balance = $this->service->findUserBalance($userId);

        if ($balance == null) {
            return abort(404);
        }

        return new UserBalanceResource($balance);
    }
}