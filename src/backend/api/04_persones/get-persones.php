<?php

// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header('HTTP/1.1 405 Method Not Allowed');
    echo json_encode(['error' => 'Method not allowed']);
    exit();
} else {


    // 1) Base de dades persones: Llistat complet
    // ruta GET => "https://elliot.cat/api/persones/get/llistatPersones"
    if (isset($_GET['type']) && $_GET['type'] == 'llistatPersones') {
        global $conn;

        // Obtener el número de página y el límite desde los parámetros GET, con valores por defecto
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 15;
        $offset = ($page - 1) * $limit;

        // Filtrar por grupo (si se pasa el parámetro 'group')
        $group = isset($_GET['group']) ? (int)$_GET['group'] : null;

        // Consulta SQL base
        $query = "SELECT 
            a.id, a.nom AS AutNom, a.cognoms AS AutCognom1, a.slug, 
            a.anyNaixement AS yearBorn, a.anyDefuncio AS yearDie, 
            a.web AS AutWikipedia, c.pais_cat AS country, 
            p.professio_ca AS profession, 
            i.nameImg, a.grup
        FROM db_persones AS a
        LEFT JOIN db_countries AS c ON a.paisAutor = c.id
        LEFT JOIN aux_professions AS p ON a.ocupacio = p.id
        LEFT JOIN db_img AS i ON a.img = i.id";

        // Si se pasa un filtro de grupo, agregarlo a la consulta
        if ($group) {
            $query .= " WHERE a.grup = :group";
        }

        // Añadir la paginación a la consulta
        $query .= " ORDER BY a.cognoms LIMIT :limit OFFSET :offset";

        // Preparar y ejecutar la consulta
        $stmt = $conn->prepare($query);
        if ($group) {
            $stmt->bindParam(':group', $group, PDO::PARAM_INT); // Bind del parámetro 'group' si está presente
        }
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT); // Bind del parámetro 'limit'
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT); // Bind del parámetro 'offset'
        $stmt->execute();

        // Obtener los resultados
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Contar el total de resultados para la paginación
        $stmtCount = $conn->prepare("SELECT COUNT(*) AS total FROM db_persones" . ($group ? " WHERE grup = :group" : ""));
        if ($group) {
            $stmtCount->bindParam(':group', $group, PDO::PARAM_INT); // Bind del parámetro 'group' para el conteo
        }
        $stmtCount->execute();
        $total = $stmtCount->fetch(PDO::FETCH_ASSOC)['total'];

        // Calcular el total de páginas
        $totalPages = ceil($total / $limit);

        // Enviar los resultados como JSON
        echo json_encode([
            'data' => $data,
            'total' => $total,
            'totalPages' => $totalPages,
            'currentPage' => $page
        ]);
    } elseif (isset($_GET['persona'])) {
        // ruta GET => "/api/persones/get/?persona=josep-fontana"
        $autorSlug = $_GET['persona'];
        global $conn;
        $data = array();
        $stmt = $conn->prepare("SELECT a.id, a.cognoms, a.nom, p.pais_cat, a.anyNaixement, a.anyDefuncio, p.id AS idPais, o.professio_ca, i.nameImg, i.alt, a.web, a.dateCreated, a.dateModified, a.descripcio, a.slug, a.img AS idImg, a.ocupacio AS idOcupacio, a.grup AS idGrup,
        a.sexe AS idSexe, a.mesNaixement, a.diaNaixement, a.mesDefuncio, a.diaDefuncio, c1.city AS ciutatNaixement, c2.city AS ciutatDefuncio, a.descripcioCast, a.descripcioEng, a.descripcioIt, a.ciutatNaixement AS idCiutatNaixement, a.ciutatDefuncio AS idCiutatDefuncio
                FROM db_persones AS a
                LEFT JOIN db_countries AS p ON a.paisAutor = p.id
                LEFT JOIN aux_professions AS o ON a.ocupacio = o.id
                LEFT JOIN db_img AS i ON a.img = i.id
                LEFT JOIN db_cities AS c1 ON a.ciutatNaixement = c1.id
                LEFT JOIN db_cities AS c2 ON a.ciutatDefuncio = c2.id
                WHERE a.slug = :slug");
        $stmt->execute(['slug' => $autorSlug]);

        if ($stmt->rowCount() === 0) {
            echo json_encode(null);  // Devuelve un objeto JSON nulo si no hay resultados
        } else {
            // Solo obtenemos la primera fila ya que parece ser una búsqueda por ID
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode($row);  // Codifica la fila como un objeto JSON
        }
    } else {
        // Si 'type', 'id' o 'token' están ausentes o 'type' no es 'user' en la URL
        header('HTTP/1.1 403 Forbidden');
        echo json_encode(['error' => 'Something get wrong']);
        exit();
    }
}
