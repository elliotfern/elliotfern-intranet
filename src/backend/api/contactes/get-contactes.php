<?php

// Verificar si se proporciona un token en el encabezado de autorización
$headers = apache_request_headers();

if (isset($headers['Authorization'])) {
    $token = str_replace('Bearer ', '', $headers['Authorization']);

    // Verificar el token aquí según tus requerimientos
    if (verificarToken($token)) {
        // Token válido, puedes continuar con el código para obtener los datos del usuario

        // 1) Llistat contactes
        // ruta GET => "/api/contactes/get/?type=contactes&tipus=1"
        if (isset($_GET['type']) && $_GET['type'] == 'contactes' && isset($_GET['tipus'])) {
            $tipus = $_GET['tipus'];
            global $conn;
            $data = array();
            $stmt = $conn->prepare(
            "SELECT c.id, c.nom, c.cognoms, c.email, c.tel_1, c.tel_2, c.tel_3, c.data_naixement, c.web, t.tipus, p.pais_cat AS country, c.adreca
            FROM db_contactes AS c
            LEFT JOIN aux_contactes_tipus AS t ON c.tipus = t.id
            LEFT JOIN db_countries AS p ON c.pais = p.id
            WHERE c.tipus = $tipus
            ORDER BY c.cognoms ASC");
            $stmt->execute();
            if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
            echo json_encode($data);

        // 2) Llistat contactes (tots : tipus 0)
        // ruta GET => "/api/contactes/get/?type=contactes"
        } elseif (isset($_GET['type']) && $_GET['type'] == 'contactes') {
            global $conn;
            $data = array();
            $stmt = $conn->prepare(
            "SELECT c.id, c.nom, c.cognoms, c.email, c.tel_1, c.tel_2, c.tel_3, c.data_naixement, c.web, t.tipus, p.pais_cat AS country, c.adreca
            FROM db_contactes AS c
            LEFT JOIN aux_contactes_tipus AS t ON c.tipus = t.id
            LEFT JOIN db_countries AS p ON c.pais = p.id
            ORDER BY c.cognoms ASC");
            $stmt->execute();
            if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
            echo json_encode($data);
        
        // 3) Contacte ID
        // ruta GET => "/api/contactes/get/?type=contacte&id=1"
        } elseif (isset($_GET['type']) && $_GET['type'] == 'contacte' && isset($_GET['id'])) {
            $id = $_GET['id'];
            global $conn;
            $data = array();
            $stmt = $conn->prepare(
            "SELECT c.id, c.nom, c.cognoms, c.email, c.tel_1, c.tel_2, c.tel_3, c.data_naixement, c.web, t.id AS tipus_id, t.tipus, c.adreca, p.id AS pais_id, p.pais_cat AS country
            FROM db_contactes AS c
            LEFT JOIN aux_contactes_tipus AS t ON c.tipus = t.id
            LEFT JOIN db_countries AS p ON c.pais = p.id
            WHERE c.id = $id");
            $stmt->execute();
            if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
            echo json_encode($data);

        // 4) Llistat tipus de contacte
        // ruta GET => "/api/contactes/get/?type=tipus-contacte"
        } elseif (isset($_GET['type']) && $_GET['type'] == 'tipus-contacte') {
            global $conn;
            $data = array();
            $stmt = $conn->prepare(
            "SELECT t.id, t.tipus
            FROM aux_contactes_tipus AS t
            ORDER BY t.tipus ASC");
            $stmt->execute();
            if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
            echo json_encode($data);
        // 5) Llistat paisos
        // ruta GET => "/api/contactes/get/?type=paisos"
        } elseif (isset($_GET['type']) && $_GET['type'] == 'paisos') {
            global $conn;
            $data = array();
            $stmt = $conn->prepare(
            "SELECT c.id, c.pais_cat AS country
            FROM db_countries AS c
            ORDER BY c.pais_cat ASC");
            $stmt->execute();
            if($stmt->rowCount() === 0) echo ('No rows');
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