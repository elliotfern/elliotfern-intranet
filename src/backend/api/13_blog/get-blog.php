<?php

// Configuración de cabeceras para aceptar JSON y responder JSON
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: https://elliot.cat");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");

// Solo permitir POST
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit();
}


// Llistat complet del blog
// URL: /api/blog/get/?llistatArticles
if (isset($_GET['llistatArticles'])) {
    global $conn;

    $query = "SELECT b.id, b.post_type, b.post_title, b.post_excerpt, b.lang, b.post_status, b.slug, b.categoria, b.post_date, b.post_modified, t.tema_ca
        FROM db_blog AS b
        LEFT JOIN aux_temes AS t ON b.categoria = t.id
        ORDER BY b.post_date ASC";

    $stmt = $conn->prepare($query);

    $stmt->execute();

    // Verificar si hay resultados antes de hacer fetch
    if ($stmt->rowCount() === 0) {
        echo json_encode(["error" => "No rows found"]);
        exit;
    }

    // Recopilar los resultados
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Enviar respuesta en formato JSON
    echo json_encode($data);
    // URL: /api/blog/get/?articleSlug=revolut    
} else if (isset($_GET['articleSlug'])) {
    $slug = $_GET['articleSlug'];
    global $conn;

    $query = "SELECT b.id, b.post_type, b.post_title, b.post_excerpt, b.lang, b.post_content, b.post_status, b.slug, b.categoria, b.post_date, b.post_modified, t.tema_ca
        FROM db_blog AS b
        LEFT JOIN aux_temes AS t ON b.categoria = t.id
        WHERE b.slug = :slug";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);

    $stmt->execute();

    // Verificar si hay resultados antes de hacer fetch
    if ($stmt->rowCount() === 0) {
        echo json_encode(["error" => "No rows found"]);
        exit;
    }

    // Recopilar los resultados
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    // Enviar respuesta en formato JSON
    echo json_encode($data);
} else {
    // No se proporcionó un token
    header('HTTP/1.1 403 Forbidden');
    echo json_encode(['error' => 'Access not allowed']);
    exit();
}
