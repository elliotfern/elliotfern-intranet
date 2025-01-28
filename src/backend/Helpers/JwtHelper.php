<?php
// src/Helpers/JwtHelper.php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class JwtHelper
{
    public static function generateJwt($payload, $secret)
    {
        return JWT::encode($payload, $secret, "HS256");
    }


    public static function verifyJwt($jwt, $secret)
    {
        try {
            $decoded = JWT::decode($jwt, new Key($secret, 'HS256'));
            return $decoded;
        } catch (Exception $e) {
            return null;
        }
    }
}
