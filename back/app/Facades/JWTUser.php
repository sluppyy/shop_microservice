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
      $payload = JWTAuth::getPayload($token);
      return $payload['id'] ??
        $payload['http://schemas.xmlsoap.org/ws/2005/05/identity/claims/name'] ??
        abort(401);
    } catch (Exception $e) {
      return abort(401);
    }
  }
}