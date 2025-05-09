<?php

use Dotenv\Dotenv;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Cargar variables de entorno desde .env
$jwtSecret = $_ENV['TOKEN'];

// Llamada a la API con token en los encabezados
function hacerLlamadaAPI($url)
{
    $token = $_COOKIE['token'];

    // Inicializa cURL
    $ch = curl_init($url);

    // Configura los encabezados de la solicitud, incluyendo el token en el encabezado Authorization
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer {$token}",
            "Content-Type: application/json",

        ],
    ]);

    // Ejecutar la solicitud
    $response = curl_exec($ch);
    $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Verifica si hay errores en la solicitud
    if (curl_errno($ch)) {
        die("Error en cURL: " . curl_error($ch));
    }

    // Verifica el código de estado HTTP
    $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpStatusCode !== 200) {
        die("Error al obtener los datos de la API. HTTP Status Code: {$httpStatusCode}");
    }

    // Decodifica la respuesta
    $data = json_decode($response, true);

    if ($data === null) {
        die("Error al decodificar los datos de la API.");
    }

    // Retorna los datos de la factura
    return $data;
}


// Función que verifica el token enviado a través del encabezado Authorization
function verificarTokenAPI()
{
    // Obtener el encabezado Authorization
    $headers = apache_request_headers();

    // Verificar si el encabezado Authorization está presente
    if (!isset($headers['Authorization'])) {
        header('HTTP/1.1 401 Unauthorized');
        echo json_encode(['error' => 'Token no proporcionado']);
        exit();
    }

    // Extraer el token del encabezado (se espera el formato: Bearer <token>)
    $token = str_replace('Bearer ', '', $headers['Authorization']);

    // Si el token está vacío, devolver un error
    if (empty($token)) {
        header('HTTP/1.1 401 Unauthorized');
        echo json_encode(['error' => 'Token vacío']);
        exit();
    }

    // Verificar el token
    $jwtSecret = $_ENV['TOKEN'];  // La clave secreta para validar el JWT
    try {
        // Intentar decodificar el JWT
        $decoded = JWT::decode($token, new Key($jwtSecret, 'HS256'));

        // Verificar si el token ha expirado
        if (isset($decoded->exp) && $decoded->exp < time()) {
            header('HTTP/1.1 401 Unauthorized');
            echo json_encode(['error' => 'El token ha expirado']);
            exit();
        }

        // Si el token es válido, devolver los datos decodificados
        return $decoded;  // Puedes usar datos como el user_id, roles, etc.

    } catch (Exception $e) {
        // Si hay un error al decodificar el token, devolver un error
        header('HTTP/1.1 401 Unauthorized');
        echo json_encode(['error' => 'Token inválido o mal formado']);
        exit();
    }
}

function validateURLExists($url)
{
    $headers = @get_headers($url);
    if ($headers && strpos($headers[0], '200') !== false) {
        // El código de respuesta es 200, la URL existe
        return true;
    } else {
        // El código de respuesta no es 200 o la URL no es accesible
        return false;
    }
}

function verificarToken($token)
{
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

function obtenerClaveSecretaPorKid($kid)
{
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
