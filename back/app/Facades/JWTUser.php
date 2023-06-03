<?php

namespace App\Facades;

use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTUser
{
  public static function userId(): string
  {
    try {
      $token = JWTAuth::getToken();
      return JWTAuth::getPayload($token)['id'];
    } catch (Exception $e) {
      return abort(401);
    }
  }
}