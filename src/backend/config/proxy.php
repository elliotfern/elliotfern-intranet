<?php

// Endpoint intermedio que lee el token de la cookie y hace la llamada a la API externa
function proxyRequestAPI()
{
    // Verifica si la cookie del token existe y es válida
    if (!isset($_COOKIE['token']) || !validarToken($_COOKIE['token']) || !isset($_COOKIE['user_type']) || $_COOKIE['user_type'] != 1) {
        echo json_encode(['error' => 'Token no proporcionado']);
        exit();
    }


    $token = $_COOKIE['token'];  // Obtén el token desde la cookie
    return $token;
}
