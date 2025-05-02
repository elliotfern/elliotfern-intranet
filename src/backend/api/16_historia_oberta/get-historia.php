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

// GET : "https://elliot.cat/api/historia-oberta/get/?type=llistat-articles"
if (isset($_GET['type']) && $_GET['type'] == 'llistat-articles') {

    $query = "SELECT a.post_name, DATE(a.post_date) AS postData, a.ID, a.post_title
            FROM epgylzqu_historia_web.xfr_posts AS a
            ORDER BY a.id";

    // Preparar la consulta
    $stmt = $conn->prepare($query);

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

    // 2. Llistat de càrrecs d'una persona
    // ruta GET => "/api/historia/get/?carrecsPersona=234"
} else if (isset($_GET['carrecsPersona'])) {
    $id = $_GET['carrecsPersona'];

    $query = "SELECT c.id, c.carrecNom AS carrec, c.carrecInici AS anys, c.carrecFi, o.nomOrg AS organitzacio, o.slug
    FROM aux_persones_carrecs AS c
    LEFT JOIN db_historia_organitzacions AS o ON c.idOrg = o.id
    WHERE c.idPersona = :id
    ORDER BY c.carrecInici";

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

    // 3. Llistat d'esdeveniments vinculats a d'una persona
    // ruta GET => "/api/historia/get/?esdevenimentsPersona=234"
} else if (isset($_GET['esdevenimentsPersona'])) {
    $id = $_GET['esdevenimentsPersona'];

    $query = "SELECT ep.id AS idEP, e.id, e.esdeNom AS esdeveniment, e.esdeDataIAny AS any, e.slug
    FROM db_historia_esdeveniment_persones AS ep
    INNER JOIN db_historia_esdeveniments AS e ON ep.idEsdev = e.id
    WHERE ep.idPersona = :id
    ORDER BY e.esdeDataIAny ASC";

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

    // 2. Llistat d'esdeveniments
    // ruta GET => "/api/historia/get/?llistatEsdeveniments"
} else if (isset($_GET['llistatEsdeveniments'])) {
    // Obtener los parámetros de filtro
    $etapaFiltro = isset($_GET['etapa']) ? $_GET['etapa'] : '';
    $subetapaFiltro = isset($_GET['subetapa']) ? $_GET['subetapa'] : '';

    $query = "SELECT e.id, esdeNom, slug, esdeDataIDia, esdeDataIMes, esdeDataIAny, esdeDataFDia, esdeDataFMes, esdeDataFAny, s.nomSubEtapa, p.etapaNom, c.city
    FROM db_historia_esdeveniments AS e
    LEFT JOIN db_historia_sub_periode AS s ON e.esSubEtapa = s.id
    LEFT JOIN db_historia_periode_historic AS p ON s.idEtapa = p.id
    LEFT JOIN db_cities AS c ON e.esdeCiutat = c.id
    WHERE 1";

    if ($etapaFiltro) {
        $query .= " AND p.id = :etapa";
    }

    if ($subetapaFiltro) {
        $query .= " AND s.id = :subetapa";
    }

    // Eliminar la parte LIMIT y OFFSET
    $query .= " ORDER BY e.esdeDataIAny DESC";

    // Preparar la consulta
    $stmt = $conn->prepare($query);

    // Vincular parámetros si es necesario
    if ($etapaFiltro) {
        $stmt->bindParam(':etapa', $etapaFiltro, PDO::PARAM_INT);
    }
    if ($subetapaFiltro) {
        $stmt->bindParam(':subetapa', $subetapaFiltro, PDO::PARAM_INT);
    }

    // Ejecutar la consulta
    $stmt->execute();

    // Verificar si se encontraron resultados
    if ($stmt->rowCount() === 0) {
        echo json_encode(['error' => 'No rows found']);
        exit;
    }

    // Recopilar los resultados
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Devolver los datos y el total de eventos
    echo json_encode([
        'data' => $data,
    ]);

    // 2. Llistat de subetapes
    // ruta GET => "/api/historia/get/?subEtapesEtapa=1"
} else if (isset($_GET['subEtapesEtapa'])) {
    $id = $_GET['subEtapesEtapa'];

    $query = "SELECT s.id, s.nomSubEtapa
    FROM db_historia_sub_periode AS s
    WHERE s.idEtapa = :id
    ORDER BY s.anyInici";

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
