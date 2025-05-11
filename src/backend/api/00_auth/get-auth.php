<?php

// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header('HTTP/1.1 405 Method Not Allowed');
    echo json_encode(['error' => 'Method not allowed']);
    exit();
}

// 01. Ruta GET per comprobar si usuari està registrat o no
// /api/auth/get/?isAdmin
if ((isset($_GET['isAdmin']))) {
    // Comprovem si les cookies 'token' i 'user_id' estan presents
    if (isset($_COOKIE['token']) && isset($_COOKIE['user_id'])) {
        $token = $_COOKIE['token']; // Cookie de token (HttpOnly)
        $userId = $_COOKIE['user_id']; // Cookie de user_id

        // Si el user_id és 1 (admin) i existeix el token, considerem l'usuari admin
        if ($userId === '1') {
            echo json_encode(['isAdmin' => true]);
        } else {
            echo json_encode(['isAdmin' => false]);
        }
    } else {
        // Si no existeixen les cookies o el user_id no és 1, no és admin
        echo json_encode(['isAdmin' => false]);
    }
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
    setcookie('user_id', '', $arr_cookie_options);
    setcookie('user_type', '', $arr_cookie_options);

    // Además, puedes destruir la sesión si estás utilizando sesiones en PHP
    session_unset();    // Elimina todas las variables de sesión
    session_destroy();  // Destruye la sesión

    // Respuesta en formato JSON o redirige
    echo json_encode(['message' => 'OK']);

    exit;
}
