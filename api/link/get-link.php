<?php

// Verificar si se proporciona un token en el encabezado de autorización
$headers = apache_request_headers();

if (isset($headers['Authorization'])) {
    $token = str_replace('Bearer ', '', $headers['Authorization']);

    // Verificar el token aquí según tus requerimientos
    if (verificarToken($token)) {
        // Token válido, puedes continuar con el código para obtener los datos del usuario

        // 1) Llistat categories enllaços
        // ruta GET => "/api/links/?type=categories"
        if (isset($_GET['type']) && $_GET['type'] == 'categories' ) {
            global $conn;
            $data = array();
            $stmt = $conn->prepare(
            "SELECT g.id, g.categoria_ca AS genre
            FROM aux_categories AS g
            INNER JOIN aux_temes AS t ON g.id = t.idGenere
            INNER JOIN db_links AS l ON l.cat = t.id
            GROUP BY g.id
            ORDER BY g.categoria_ca ASC");
            $stmt->execute();
            if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
            echo json_encode($data);
        
        // 2) Llistat enllaços segons una categoria en concret
        // ruta GET => "/api/links/?type=categoria$id=11"
        } elseif ( (isset($_GET['type']) && $_GET['type'] == 'categoria') && (isset($_GET['id']) ) ) {
            $id = $_GET['id'];
            global $conn;
            $data = array();
            $stmt = $conn->prepare(
            "SELECT t.id AS idTema, t.tema_ca AS tema, g.categoria_ca AS genre
            FROM aux_temes AS t
            INNER JOIN aux_categories AS g ON t.idGenere = g.id
            INNER JOIN db_links AS l ON l.cat = t.id
            WHERE t.idGenere=?
            GROUP BY t.id
            ORDER BY t.tema_ca ASC");
            $stmt->execute([$id]);
            if ($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
            echo json_encode($data);

        // 3) Llistat enllaços segons un topic concret
        // ruta GET => "/api/links/?type=topic$id=11"
    } elseif ( (isset($_GET['type']) && $_GET['type'] == 'topic') && (isset($_GET['id']) ) ) {

        $id = $_GET['id'];
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // Número de página, predeterminado: 1
        $itemsPerPage = 10;  // Número de elementos por página

        // Calcular el offset (desplazamiento)
        $offset = ($page - 1) * $itemsPerPage;

        global $conn;
        $data = array();
        $stmt = $conn->prepare("SELECT l.web AS url, l.nom, t.id AS idTema, t.tema_ca AS tema, l.id AS linkId, l.lang, ty.id AS idType, ty.type, g.categoria_ca AS genre, g.id AS idCategoria, total_enlaces.total_count
        FROM aux_temes AS t
        INNER JOIN aux_categories AS g ON t.idGenere = g.id
        INNER JOIN db_links AS l ON l.cat = t.id
        LEFT JOIN db_links_type AS ty ON ty.id = l.tipus
        CROSS JOIN (
            SELECT COUNT(*) AS total_count
            FROM db_links
            WHERE cat = :id
        ) AS total_enlaces
        WHERE t.id = :id
        ORDER BY l.nom ASC
        LIMIT :limit OFFSET :offset");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            echo json_encode(array('message' => 'No rows'));
        } else {
            while ($users = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $users;
            }
            echo json_encode($data);
        }
        
        // 4) Llistat de topics
        // ruta GET => "/api/links/?type=all-topics"
        } elseif ( (isset($_GET['type']) && $_GET['type'] == 'all-topics') ) {
            global $conn;
            $data = array();
            $stmt = $conn->prepare(
            "SELECT t.id AS idTema, t.tema_ca AS tema, g.categoria_ca AS genre, g.id AS idGenre
            FROM aux_temes AS t
            INNER JOIN aux_categories AS g ON t.idGenere = g.id
            INNER JOIN db_links AS l ON l.cat = t.id
            GROUP BY t.id
            ORDER BY t.tema_ca ASC");
            $stmt->execute();
            if ($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
            echo json_encode($data);

         // 5) Ruta para sacar 1 enlace y actualizarlo 
        // ruta GET => "/api/links/?type=link$id=11"
        } elseif ( (isset($_GET['type']) && $_GET['type'] == 'link') && (isset($_GET['id']) ) ) {
            $id = $_GET['id'];
            global $conn;
            $data = array();
            $stmt = $conn->prepare(
            "SELECT l.id, l.web, l.nom, l.cat AS idTema, l.tipus, l.lang, l.linkCreated, l.linkUpdated
            FROM db_links AS l
            WHERE l.id=?");
            
            $stmt->execute([$id]);

            if ($stmt->rowCount() === 0) {
                echo json_encode(null);  // Devuelve un objeto JSON nulo si no hay resultados
            } else {
                 // Solo obtenemos la primera fila ya que parece ser una búsqueda por ID
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                echo json_encode($row);  // Codifica la fila como un objeto JSON
             }

        // 5) Llistat de tipus de links
        // ruta POST => "https://control.elliotfern/api/links/?type=all-types"
        } elseif ( (isset($_GET['type']) && $_GET['type'] == 'all-types') ) {
            global $conn;
            $data = array();
            $stmt = $conn->prepare(
            "SELECT t.id AS idType, t.type
            FROM db_links_type AS t
            ORDER BY t.type ASC");
            $stmt->execute();
            if ($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
            echo json_encode($data);
        } else {
            // Si 'type', 'id' o 'token' están ausentes o 'type' no es 'user' en la URL
            header('HTTP/1.1 403 Forbidden');
            echo json_encode(['error' => 'Something get wrong']);
            exit();
        }

    } else {
    // Token no válido
    header('HTTP/1.1 403 Forbidden');
    echo json_encode(['error' => 'Invalid token']);
    exit();
    }

} else {
// No se proporcionó un token
header('HTTP/1.1 403 Forbidden');
echo json_encode(['error' => 'Access not allowed']);
exit();
}