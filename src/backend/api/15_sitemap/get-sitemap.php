<?php

// Configuración de cabeceras para aceptar JSON y responder JSON
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: https://elliot.cat");
header("Access-Control-Allow-Methods: GET");

// GET : "https://api.elliotfern.com/sitemap.php?type=sitemapArticlesHistoria&?lang=en"
if (isset($_GET['type']) && $_GET['type'] == 'sitemapArticlesHistoria' && isset($_GET['lang'])) {

    // Aquí puedes obtener los valores de los parámetros
    $lang = $_GET['lang'];
    $param = "publish";

    global $conn;

    if ($lang === "ca") {
        $query = "SELECT p.post_name AS loc, DATE(p.post_modified_gmt) AS lastmod
            FROM epgylzqu_historia_web.posts_lang AS l
            INNER JOIN epgylzqu_historia_web.xfr_posts AS p ON l.ca = p.ID
            WHERE p.post_status = :param
            GROUP BY p.ID, p.post_name, p.post_modified_gmt";
    } else if ($lang === "en") {
        $query = "SELECT p.post_name AS loc, DATE(p.post_modified_gmt) AS lastmod
            FROM epgylzqu_historia_web.posts_lang AS l
            INNER JOIN epgylzqu_historia_web.xfr_posts AS p ON l.en = p.ID
            WHERE p.post_status = :param
             GROUP BY p.ID, p.post_name, p.post_modified_gmt";
    } else if ($lang === "fr") {
        $query = "SELECT p.post_name AS loc, DATE(p.post_modified_gmt) AS lastmod
            FROM epgylzqu_historia_web.posts_lang AS l
            INNER JOIN epgylzqu_historia_web.xfr_posts AS p ON l.fr = p.ID
            WHERE p.post_status = :param
            GROUP BY p.ID, p.post_name, p.post_modified_gmt";
    } else if ($lang === "es") {
        $query = "SELECT p.post_name AS loc, DATE(p.post_modified_gmt) AS lastmod
            FROM epgylzqu_historia_web.posts_lang AS l
            INNER JOIN epgylzqu_historia_web.xfr_posts AS p ON l.es = p.ID
            WHERE p.post_status = :param
            GROUP BY p.ID, p.post_name, p.post_modified_gmt";
    } else if ($lang === "it") {
        $query = "SELECT p.post_name AS loc, DATE(p.post_modified_gmt) AS lastmod
            FROM epgylzqu_historia_web.posts_lang AS l
            INNER JOIN epgylzqu_historia_web.xfr_posts AS p ON l.it = p.ID
            WHERE p.post_status = :param
            GROUP BY p.ID, p.post_name, p.post_modified_gmt";
    }

    // Preparar la consulta
    $stmt = $conn->prepare($query);

    // Vincular los parámetros
    $stmt->bindParam(':param', $param);

    // Ejecutar la consulta
    $stmt->execute();

    // Verificar si se encontraron resultados
    if ($stmt->rowCount() === 0) {
        echo json_encode(['error' => 'No rows found']);
        exit;
    }

    // Recopilar los resultados
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Establecer el encabezado de respuesta a JSON
    header('Content-Type: application/json');

    // Devolver los datos en formato JSON
    echo json_encode($data);

    // GET : "https://api.elliotfern.com/sitemap.php?type=sitemapArticlesHistoria&?lang=en"
} else if (isset($_GET['type']) && $_GET['type'] == 'sitemapCursosHistoria' && isset($_GET['lang'])) {

    // Aquí puedes obtener los valores de los parámetros
    $lang = $_GET['lang'];

    global $conn;

    if ($lang === "ca") {
        $query = "SELECT c.paramNameCa AS loc, DATE(c.lastModified) AS lastmod
        FROM  epgylzqu_elliotfern_intranet.db_openhistory_courses AS c";
    } else if ($lang === "en") {
        $query = "SELECT c.paramNameEn AS loc, DATE(c.lastModified) AS lastmod
        FROM  epgylzqu_elliotfern_intranet.db_openhistory_courses AS c";
    } else if ($lang === "fr") {
        $query = "SELECT c.paramNameFr AS loc, DATE(c.lastModified) AS lastmod
        FROM  epgylzqu_elliotfern_intranet.db_openhistory_courses AS c";
    } else if ($lang === "es") {
        $query = "SELECT c.paramNameEs AS loc, DATE(c.lastModified) AS lastmod
        FROM  epgylzqu_elliotfern_intranet.db_openhistory_courses AS c";
    } else if ($lang === "it") {
        $query = "SELECT c.paramNameIt AS loc, DATE(c.lastModified) AS lastmod
        FROM  epgylzqu_elliotfern_intranet.db_openhistory_courses AS c";
    }

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

    // Establecer el encabezado de respuesta a JSON
    header('Content-Type: application/json');

    // Devolver los datos en formato JSON
    echo json_encode($data);
}
