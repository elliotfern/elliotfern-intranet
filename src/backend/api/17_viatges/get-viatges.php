<?php

// Configuración de cabeceras para aceptar JSON y responder JSON
header("Content-Type: application/json");

$allowed_origins = array("https://elliot.cat", "https://historiaoberta.cat");

// Verificar si la URL de referencia existe
if (isset($_SERVER['HTTP_REFERER'])) {
    // Obtener la URL de referencia
    $url = $_SERVER['HTTP_REFERER'];

    // Parsear la URL para obtener solo la parte de dominio
    $parsed_url = parse_url($url);

    // Verificar si el esquema y el host están disponibles
    if (isset($parsed_url['scheme']) && isset($parsed_url['host'])) {
        // Extraer la parte del dominio y añadir el esquema
        $base_url = $parsed_url['scheme'] . "://" . $parsed_url['host'];

        // Eliminar todo lo que sigue después de .cat/
        $base_url = preg_replace('/(https:\/\/[^\/]+\/[^\/]+)\/.*/', '$1', $base_url);
    } else {
        http_response_code(403);
        echo json_encode(['error' => 'Acceso no permitido']);
        exit;
    }
} else {
    http_response_code(403);
    echo json_encode(['error' => 'Acceso no permitido']);
    exit;
}

if (isset($base_url) && in_array($base_url, $allowed_origins)) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_REFERER']}");
    header("Access-Control-Allow-Methods: GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Origin");
    header("Access-Control-Allow-Credentials: true");
} else {
    http_response_code(403);
    echo json_encode(['error' => 'Acceso no permitido']);
    exit;
}

// Check if the request method is OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit();
}

// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header('HTTP/1.1 405 Method Not Allowed');
    echo json_encode(['error' => 'Method not allowed']);
    exit();
}

// 1. Visites realizades en un espai
// ruta GET => "/api/viatges/get/?llistatVisitesEspai"
if (isset($_GET['llistatVisitesEspai'])) {
    $id = $_GET['llistatVisitesEspai'];

    $query = "SELECT v.id, vl.slug, vl.viatge AS nom, v.dataVisita AS any1
    FROM db_travel_places_visited AS v
    INNER JOIN db_viatges_llistat AS vl ON v.idViatge = vl.id
    WHERE v.espId = :id
    ORDER BY v.dataVisita ASC";

    // Preparar la consulta
    $stmt = $conn->prepare($query);

    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Ejecutar la consulta
    $stmt->execute();

    // Verificar si se encontraron resultados
    if ($stmt->rowCount() === 0) {
        echo json_encode(['error' => 'No rows found']);
        exit;
    }

    // Recopilar los resultados
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Devolver los datos en formato JSON
    echo json_encode($data);
}
