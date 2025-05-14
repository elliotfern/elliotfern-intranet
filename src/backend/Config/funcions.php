<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Función para validar si una cookie está definida y no vacía
function getSanitizedCookie($name)
{
    return isset($_COOKIE[$name]) ? trim(htmlspecialchars($_COOKIE[$name], ENT_QUOTES, 'UTF-8')) : null;
}


function isUserAdmin(): bool
{
    // Cargar variables de entorno desde .env
    $jwtSecret = $_ENV['TOKEN'];

    if (!isset($_COOKIE['token'])) {
        return false;
    }

    $token = trim($_COOKIE['token']);

    try {
        $decoded = JWT::decode($token, new Key($jwtSecret, 'HS256'));

        // Comprobamos si el usuario es admin (user_type = 1)
        if (isset($decoded->user_type) && $decoded->user_type == 1) {
            return true;
        }
    } catch (Exception $e) {
        // Token inválido, expirado o manipulado
        error_log("Error en isUserAdmin(): " . $e->getMessage());
    }

    return false;
}
