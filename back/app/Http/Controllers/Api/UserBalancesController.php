<?php

namespace App\Http\Controllers\Api;

use App\Facades\JWTUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserBalancesController extends Controller
{
    public function show()
    {
        $userId = JWTUser::userId();
        return 'ok';
    }
}