<?php
// src/Helpers/JwtHelper.php

namespace Helpers;

use Firebase\JWT\JWT;

class JwtHelper
{
    public static function generateJwt($payload, $secret)
    {
        return JWT::encode($payload, $secret, "HS256");
    }
}
