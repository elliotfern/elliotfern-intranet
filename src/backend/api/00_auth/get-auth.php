<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Cargar variables de entorno desde .env
$jwtSecret = $_ENV['TOKEN'];

// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header('HTTP/1.1 405 Method Not Allowed');
    echo json_encode(['error' => 'Method not allowed']);
    exit();
}

// 01. Ruta GET per comprobar si usuari està registrat o no
// /api/auth/get/?isAdmin
if ((isset($_GET['isAdmin']))) {

    $token = getSanitizedCookie('token');

    if (!empty($token)) {
        try {
            // Verifica y decodifica el token
            $decoded = JWT::decode($token, new Key($jwtSecret, 'HS256'));

            // Verifica si el usuario tiene permisos de administrador
            if (
                isset($decoded->user_type) &&
                $decoded->user_type == 1 // Solo user_type 1 es admin
            ) {
                echo json_encode(['isAdmin' => true]);
                exit;
            }
        } catch (Exception $e) {
            // Token inválido, expirado o manipulado
            error_log("JWT inválido: " . $e->getMessage());
        }
    }

    // Si no cumple, no es admin
    echo json_encode(['isAdmin' => false]);
} else if ((isset($_GET['logOut']))) {
    // Verifica que el usuario esté autenticado
    session_start();

    $arr_cookie_options = array(
        'expires' => time() - 3600,
        'path' => '/',
        'domain' => 'elliot.cat',
        'secure' => true,         // igual que al crearlas
        'httponly' => true,       // igual que al crearlas
        'samesite' => 'Strict'    // igual que al crearlas
    );

    //Elimina les cookies
    setcookie('token', '', $arr_cookie_options);

    // Además, puedes destruir la sesión si estás utilizando sesiones en PHP
    session_unset();    // Elimina todas las variables de sesión
    session_destroy();  // Destruye la sesión

    // Respuesta en formato JSON o redirige
    echo json_encode(['message' => 'OK']);

    exit;
}
