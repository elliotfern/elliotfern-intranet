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
}
