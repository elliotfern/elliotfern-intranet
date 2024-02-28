<?php

// Verificar si se proporciona un token en el encabezado de autorización
$headers = getallheaders();

if (isset($headers['Authorization'])) {
    $token = str_replace('Bearer ', '', $headers['Authorization']);

    // Verificar el token aquí según tus requerimientos
    if (verificarToken($token)) {
        // Token válido, puedes continuar con el código para obtener los datos del usuario

        // 1) Llistat pelicules
        // ruta GET => "/api/cinema/get/?pelicules"
        if (isset($_GET['pelicules'])) {
            global $conn;
            $data = array();
            $stmt = $conn->prepare("SELECT c.id, c.pelicula, c.pelicula_es, c.any, c.dataVista, d.nom, d.cognoms, p.pais_cat, g.genere_ca, i.idioma_ca
            FROM 11_db_pelicules AS c
            INNER JOIN 11_aux_cinema_directors AS d ON c.director = d.id
            INNER JOIN db_countries AS p ON c.pais = p.id
            LEFT JOIN 11_aux_cinema_generes AS g ON c.genere = g.id
            LEFT JOIN aux_idiomes AS i ON c.lang = i.id
            ORDER BY c.any DESC");
            $stmt->execute();
            if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
            echo json_encode($data);

        // 1) Pelicules segons el genere
        // ruta GET => "/api/cinema/get/?type=generes&generes=ID"
        } elseif (isset($_GET['type']) && $_GET['type'] == 'generes' ) {
            $idGen = $_GET['generes'];
            global $conn;
            $data = array();
            $stmt = $conn->prepare("SELECT c.id, c.pelicula, c.pelicula_es, c.any, c.dataVista, d.nom, d.cognoms, p.pais_cat, g.genere_ca, i.idioma_ca
            FROM 11_db_pelicules AS c
            INNER JOIN 11_aux_cinema_directors AS d ON c.director = d.id
            INNER JOIN db_countries AS p ON c.pais = p.id
            LEFT JOIN 11_aux_cinema_generes AS g ON c.genere = g.id
            LEFT JOIN aux_idiomes AS i ON c.lang = i.id
            WHERE c.genere = $idGen
            ORDER BY c.any DESC");
            $stmt->execute();
            if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
            echo json_encode($data);
        
        // ruta detalls pelicula
        // ruta GET => "/api/cinema/get/?pelicula=123"
        } elseif (isset($_GET['pelicula']) && is_numeric($_GET['pelicula'])) {
            $id= $_GET['pelicula'];
            global $conn;
            $data = array();
            $stmt = $conn->prepare("SELECT c.id, c.pelicula, c.pelicula_es, c.any, c.dataVista, d.nom, d.cognoms, p.pais_cat, g.genere_ca, i.idioma_ca, img.nameImg, c.dateCreated, c.dateModified, c.descripcio, c.director, c.lang, c.lang, c.genere, c.img, c.pais
            FROM 11_db_pelicules AS c
            INNER JOIN 11_aux_cinema_directors AS d ON c.director = d.id
            INNER JOIN db_countries AS p ON c.pais = p.id
            LEFT JOIN 11_aux_cinema_generes AS g ON c.genere = g.id
            LEFT JOIN aux_idiomes AS i ON c.lang = i.id
            LEFT JOIN db_img AS img ON c.img = img.id
            WHERE c.id = $id");
            $stmt->execute();
            if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
            echo json_encode($data);

        // 1) Llistat tv shows
        // ruta GET => "https://control.elliotfern.com/api/cinema/get/?type=tvshows"
        } elseif (isset($_GET['type']) && $_GET['type'] == 'tvshows' ) {
            global $conn;
            $data = array();
            $stmt = $conn->prepare(
            "SELECT tv.id, tv.name, tv.startYear, tv.endYear,tv.season, tv.chapter, d.nomDirector, d.lastName, tv.lang,tv.genre, tv.producer, c.country, tv.img
            FROM db_tvmovies_tvshows AS tv
            INNER JOIN db_tvmovies_directors AS d ON tv.director = d.id
            INNER JOIN db_countries AS c ON tv.country = c.id
            ORDER BY tv.startYear ASC");
            $stmt->execute();
            if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
            echo json_encode($data);
        
        // 2) Pagina informacio tv show
        // ruta GET => "https://gestio.elliotfern.com/api/cinema/get/?type=tvshow&id=35"
        } elseif (isset($_GET['type']) && $_GET['type'] == 'tvshow' && isset($_GET['id'])) {
            $id = $_GET['id'];
            global $conn;
            $data = array();
            $stmt = $conn->prepare(
            "SELECT tv.id, tv.name, tv.startYear, tv.endYear,tv.season, tv.chapter, d.nomDirector, d.lastName, tv.lang,tv.genre, tv.producer, c.country, tv.img
            FROM db_tvmovies_tvshows AS tv
            INNER JOIN db_tvmovies_directors AS d ON tv.director = d.id
            INNER JOIN db_countries AS c ON tv.country = c.id
            WHERE tv.id = $id
            ORDER BY tv.startYear ASC");
            $stmt->execute();
            if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
            echo json_encode($data);

        // 1) AUXILIARS
        // Llistat directors
        // ruta GET => "/api/cinema/get/auxiliars/?type=directors"
        } elseif (isset($_GET['type']) && $_GET['type'] == 'directors' ) {
            global $conn;
            $data = array();
            $stmt = $conn->prepare("SELECT d.id, CONCAT(d.cognoms, ', ', d.nom) AS nomComplet
            FROM 11_aux_cinema_directors AS d
            ORDER BY d.cognoms ASC");
            $stmt->execute();
            if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
            echo json_encode($data);

        // Llistat imatges pelicules
        // ruta GET => "/api/cinema/get/auxiliars/?type=imgPelis"
        } elseif (isset($_GET['type']) && $_GET['type'] == 'imgPelis' ) {
            global $conn;
            $data = array();
            $stmt = $conn->prepare("SELECT i.id, i.alt
            FROM db_img AS i
            WHERE i.typeImg = 8
            ORDER BY i.alt ASC");
            $stmt->execute();
            if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
            echo json_encode($data);
        
        // Llistat generes pelicules
        // ruta GET => "/api/cinema/get/auxiliars/?type=generesPelis"
        } elseif (isset($_GET['type']) && $_GET['type'] == 'generesPelis' ) {
            global $conn;
            $data = array();
            $stmt = $conn->prepare("SELECT g.id, g.genere_ca
            FROM 11_aux_cinema_generes AS g
            ORDER BY g.genere_ca ASC");
            $stmt->execute();
            if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
            echo json_encode($data);
       
        // Llistat idiomes pelicules
        // ruta GET => "/api/cinema/get/auxiliars/?type=llengues"
        } elseif (isset($_GET['type']) && $_GET['type'] == 'llengues' ) {
            global $conn;
            $data = array();
            $stmt = $conn->prepare("SELECT i.id, i.idioma_ca
            FROM aux_idiomes AS i
            ORDER BY i.idioma_ca ASC");
            $stmt->execute();
            if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
            echo json_encode($data);

         // Llistat paisos
        // ruta GET => "/api/cinema/get/auxiliars/?type=paisos"
        } elseif (isset($_GET['type']) && $_GET['type'] == 'paisos' ) {
            global $conn;
            $data = array();
            $stmt = $conn->prepare("SELECT p.id, p.pais_cat
            FROM db_countries AS p
            ORDER BY p.pais_cat ASC");
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

// Cerrar la conexión a la base de datos después de su uso
$conn = null;
?>
