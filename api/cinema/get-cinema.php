<?php

// Verificar si se proporciona un token en el encabezado de autorización
$headers = apache_request_headers();

if (isset($headers['Authorization'])) {
    $token = str_replace('Bearer ', '', $headers['Authorization']);

    // Verificar el token aquí según tus requerimientos
    if (verificarToken($token)) {
        // Token válido, puedes continuar con el código para obtener los datos del usuario

        // 1) Llistat tv shows
        // ruta GET => "https://control.elliotfern/api/cinema/?type=tvshows"
        if (isset($_GET['type']) && $_GET['type'] == 'tvshows' ) {
            global $conn;
            $data = array();
            $stmt = $conn->prepare(
            "SELECT tv.id, tv.name, tv.startYear, tv.endYear,tv.season, tv.chapter, d.nomDirector, d.lastName, tv.lang,tv.genre, tv.producer, c.country, tv.img
            FROM db_tvmovies_tvshows AS tv
            INNER JOIN db_tvmovies_directors AS d ON tv.director = d.id
            INNER JOIN db_countries AS c ON tv.country = c.id
            ORDER BY tv.name ASC");
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