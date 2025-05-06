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

    $query = "SELECT e.id, esdeNom, slug, esdeDataIDia, esdeDataIMes, esdeDataIAny, esdeDataFDia, esdeDataFMes, esdeDataFAny, s.nomSubEtapa, p.etapaNom, c.city, co.pais_cat
    FROM db_historia_esdeveniments AS e
    LEFT JOIN db_historia_sub_periode AS s ON e.esSubEtapa = s.id
    LEFT JOIN db_historia_periode_historic AS p ON s.idEtapa = p.id
    LEFT JOIN db_cities AS c ON e.esdeCiutat = c.id
    LEFT JOIN db_countries AS co ON c.country = co.id
    WHERE 1";

    if ($etapaFiltro) {
        $query .= " AND p.id = :etapa";
    }

    if ($subetapaFiltro) {
        $query .= " AND s.id = :subetapa";
    }

    // Eliminar la parte LIMIT y OFFSET
    $query .= " ORDER BY e.esdeDataIAny ASC";

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

    // 5. Llistat subetapes
} else if (isset($_GET['llistatSubEtapes'])) {

    $query = "SELECT s.id, s.nomSubEtapa
    FROM db_historia_sub_periode AS s
    ORDER BY s.nomSubEtapa ASC";

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

    // 4. Esdeveniment
    // ruta GET => "/api/historia/get/?esdeveniment=revolucio-vellut"
} else if (isset($_GET['esdeveniment'])) {
    $slug = $_GET['esdeveniment'];

    $query = "SELECT e.id, e.esdeNom, e.esdeNomCast, e.esdeNomEng, e.esdeNomIt, e.slug, e.esdeDataIDia, e.esdeDataIMes, e.esdeDataIAny, e.esdeDataFDia, e.esdeDataFMes, e.esdeDataFAny, e.esSubEtapa, e.esdeCiutat, e.dateCreated, e.dateModified, s.nomSubEtapa, p.etapaNom, c.city, co.pais_cat, e.img, i.nameImg, e.descripcio, i.alt
    FROM db_historia_esdeveniments AS e
    LEFT JOIN db_historia_sub_periode AS s ON e.esSubEtapa = s.id
    LEFT JOIN db_historia_periode_historic AS p ON s.idEtapa = p.id
    LEFT JOIN db_cities AS c ON e.esdeCiutat = c.id
    LEFT JOIN db_countries AS co ON c.country = co.id
    LEFT JOIN db_img AS i ON e.img = i.id
    WHERE e.slug = :slug";

    // Preparar la consulta
    $stmt = $conn->prepare($query);

    $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);

    // Ejecutar la consulta
    $stmt->execute();

    // Verificar si se encontraron resultados
    if ($stmt->rowCount() === 0) {
        echo json_encode(['error' => 'No rows found']);
        exit;
    }

    // Recopilar los resultados
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    // Devolver los datos en formato JSON
    echo json_encode($data);

    // 5. Imatges esdeveniment
    // ruta GET => "/api/historia/get/?llistatImatgesEsdeveniments"
} else if (isset($_GET['llistatImatgesEsdeveniments'])) {

    $query = "SELECT i.id, i.alt
    FROM db_img AS i
    WHERE i.typeImg = 4";

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

    // 3. Llistat de persones vinculades a un esdeveniment
    // ruta GET => "/api/historia/get/?personesEsdeveniments=234"
} else if (isset($_GET['personesEsdeveniments'])) {
    $id = $_GET['personesEsdeveniments'];

    $query = "SELECT e.id, CONCAT(ep.nom, ' ', ep.cognoms) AS nom, ep.slug
    FROM db_historia_esdeveniment_persones AS e
    INNER JOIN db_persones AS ep ON ep.id = e.idPersona
    WHERE e.idEsdev = :id
    ORDER BY ep.cognoms ASC";

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

    // 3. Llistat d'organitzacions vinculades a un esdeveniment
    // ruta GET => "/api/historia/get/?organitzacionsEsdeveniments=234"
} else if (isset($_GET['organitzacionsEsdeveniments'])) {
    $id = $_GET['organitzacionsEsdeveniments'];

    $query = "SELECT o.id, org.nomOrg AS nom, org.slug
    FROM db_historia_esdeveniment_organitzacio AS o
    INNER JOIN db_historia_organitzacions AS org ON org.id = o.idOrg
    WHERE o.idEsde = :id
    ORDER BY org.nomOrg ASC";

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

    // 4. Llistat Esdeveniments
    // ruta GET => "/api/historia/get/?llistatEsdevenimentsSelect"
} else if (isset($_GET['llistatEsdevenimentsSelect'])) {

    $query = "SELECT e.id, e.esdeNom
    FROM db_historia_esdeveniments AS e
    ORDER BY e.esdeNom ASC";

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

    // 4. Llistat persones
    // ruta GET => "/api/historia/get/?llistatPersones"
} else if (isset($_GET['llistatPersones'])) {

    $query = "SELECT p.id, CONCAT(p.nom, ' ', p.cognoms) AS nom
    FROM db_persones AS p
    ORDER BY p.cognoms";

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


    // 3. Llistat d'esdeveniments vinculats a una persona
    // ruta GET => "/api/historia/get/?formEsdevenimentsPersona=234"
} else if (isset($_GET['formEsdevenimentsPersona'])) {
    $id = $_GET['formEsdevenimentsPersona'];

    $query = "SELECT e.id, e.idEsdev, e.idPersona
    FROM db_historia_esdeveniment_persones AS e
    WHERE e.id = :id";

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
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    // Devolver los datos en formato JSON
    echo json_encode($data);

    // 3. Llistat organitzacions
    // ruta GET => "/api/historia/get/?llistatOrganitzacions"
} else if (isset($_GET['llistatOrganitzacions'])) {
    $id = $_GET['llistatOrganitzacions'];

    $query = "SELECT o.id, o.nomOrg
    FROM db_historia_organitzacions AS o";

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

    // 3. Relació esdeveniment-organitzacions
    // ruta GET => "/api/historia/get/?formEsdevenimentOrganitzacions"
} else if (isset($_GET['formEsdevenimentOrganitzacions'])) {
    $id = $_GET['formEsdevenimentOrganitzacions'];

    $query = "SELECT o.id, o.idEsde, o.idOrg
    FROM db_historia_esdeveniment_organitzacio AS o
    WHERE o.id = :id";

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
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    // Devolver los datos en formato JSON
    echo json_encode($data);

    // 3. Càrrec d'una persona
    // ruta GET => "/api/historia/get/?personaCarrec="33"
} else if (isset($_GET['personaCarrec'])) {
    $id = $_GET['personaCarrec'];

    $query = "SELECT c.id, c.idPersona, c.carrecNom, c.carrecNomCast, c.carrecNomEng, c.carrecNomIt, c.carrecInici, c.carrecFi, c.idOrg, p.nom, p.cognoms
    FROM aux_persones_carrecs AS c
    INNER JOIN db_persones AS p ON c.idPersona = p.id
    WHERE c.id = :id";

    // Preparar la consulta
    $stmt = $conn->prepare($query);

    $stmt->bindParam(':id', $id, PDO::PARAM_STR);

    // Ejecutar la consulta
    $stmt->execute();

    // Verificar si se encontraron resultados
    if ($stmt->rowCount() === 0) {
        echo json_encode(['error' => 'No rows found']);
        exit;
    }

    // Recopilar los resultados
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    // Devolver los datos en formato JSON
    echo json_encode($data);
}
