<?php

require_once(APP_ROOT . APP_DEV . '/vendor/autoload.php');
use Dotenv\Dotenv;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Cargar variables de entorno desde .env
$dotenv = Dotenv::createImmutable(APP_ROOT . APP_DEV . '/');
$dotenv->load();

$jwtSecret = $_ENV['TOKEN'];

/**
 * Formats a price with the given currency symbol, decimal separator, and thousands separator.
 *
 * @param float $price The price to format.
 * @return string The formatted price with currency symbol.
 */
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
    $data = htmlspecialchars($data);
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