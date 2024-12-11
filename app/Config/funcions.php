<?php

use Dotenv\Dotenv;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Cargar variables de entorno desde .env
$jwtSecret = $_ENV['TOKEN'];
 
// Función que verifica si el usuario tiene un token válido
function verificarSesion() {
    // Inicia la sesión si no está ya iniciada
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Verifica si la cookie del token existe y es válida
    if (!isset($_COOKIE['token']) || !validarToken($_COOKIE['token']) || !isset($_COOKIE['user_type']) || $_COOKIE['user_type'] != 1) {
        header('Location: /entrada'); // Redirige a login si no hay token válido
        exit();
    }
}

function validarToken($jwt) {
   
    $jwtSecret = $_ENV['TOKEN'];  // Tu clave secreta
    $decoded = null;

    try {

        $decoded = JWT::decode($jwt, new key ($jwtSecret, 'HS256'));

       // Verifica si el token ha expirado
        if (isset($decoded->exp) && $decoded->exp < time()) {
            return false;  // Token expirado
        }

    } catch (Exception $e) {
        // Manejo del error
        error_log('Error al validar el token: ' . $e->getMessage());  // Log del error para depuración
        return false;
    }

    // Si la decodificación es exitosa y el token es válido, se devuelve el payload
    return $decoded;
}

function wc_price( $price ) {
    $currency_symbol = '€'; // replace with your currency symbol
    $decimal_separator = ','; // replace with your decimal separator
    $thousands_separator = '.'; // replace with your thousands separator
    
    $price = number_format( $price, 2, $decimal_separator, $thousands_separator );
    
    return $price . $currency_symbol;
}

function data_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    return $data;
  }

  function validateURLExists($url) {
    $headers = @get_headers($url);
    if ($headers && strpos($headers[0], '200') !== false) {
        // El código de respuesta es 200, la URL existe
        return true;
    } else {
        // El código de respuesta no es 200 o la URL no es accesible
        return false;
    }
}

function verificarToken($token) {
    $jwtSecretKey = obtenerClaveSecretaPorKid("key_api");

    
    try {
        // Decodificar el token
        $decoded = JWT::decode($token, new Key($jwtSecretKey, 'HS256'));
        return true;  // El token es válido
    } catch (Throwable $e) {
        echo 'Error al decodificar el token: ' . $e->getMessage();
        return false;
    }
}

function obtenerClaveSecretaPorKid($kid) {
    global $jwtSecret;

    $clavesSecretas = array(
        "key_api" => $jwtSecret,
    );

    if (isset($clavesSecretas[$kid])) {
        return $clavesSecretas[$kid];
    } else {
        return null; // "kid" no encontrado, devuelve null o maneja el caso según tus necesidades
    }
}

?>