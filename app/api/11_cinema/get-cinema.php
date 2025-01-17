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
        // ruta GET => "/api/cinema/get/?series"
        } elseif (isset($_GET['series'])) {
            global $conn;
            $data = array();
            $stmt = $conn->prepare(
            "SELECT tv.id, tv.name, tv.startYear, tv.endYear,tv.season, tv.chapter, d.nom, d.cognoms, id.idioma_ca AS lang, g.genere_ca AS genre, tv.producer, c.pais_cat AS country, tv.img
            FROM 11_db_cinema_series_tv AS tv
            INNER JOIN 11_aux_cinema_directors AS d ON tv.director = d.id
            INNER JOIN db_countries AS c ON tv.country = c.id
            INNER JOIN aux_idiomes AS id ON tv.lang = id.id
            LEFT JOIN 11_aux_cinema_generes AS g ON tv.genre = g.id
            ORDER BY tv.startYear ASC");
            $stmt->execute();
            if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
            echo json_encode($data);
        
        // 2) Pagina informacio tv show
        // ruta GET => "/api/cinema/get/?serie=35"
        } elseif (isset($_GET['serie']) && is_numeric($_GET['serie'])) {
            $id = $_GET['serie'];
            global $conn;
            $data = array();
            $stmt = $conn->prepare("SELECT tv.id, tv.name, tv.startYear, tv.endYear, tv.season, tv.chapter, d.nom, d.cognoms, id.idioma_ca, tv.genre, tv.producer, c.pais_cat, img.nameImg, g.genere_ca, tv.descripcio, d.id AS idDirector, c.id AS idPais, img.id AS idImg, id.id As idLang, g.id AS idGen, pr.id AS idProductora, pr.productora, tv.dateCreated, tv.dateModified
            FROM 11_db_cinema_series_tv AS tv
            INNER JOIN 11_aux_cinema_directors AS d ON tv.director = d.id
            INNER JOIN db_countries AS c ON tv.country = c.id
            LEFT JOIN db_img AS img ON tv.img = img.id
            INNER JOIN aux_idiomes AS id ON tv.lang = id.id
            LEFT JOIN 11_aux_cinema_generes AS g ON tv.genre = g.id
            LEFT JOIN 11_aux_cinema_productores AS pr ON tv.producer = pr.id
            WHERE tv.id = $id
            ORDER BY tv.startYear ASC");
            $stmt->execute();
            if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
            echo json_encode($data);

        // 2) Actors que participen en una serie determinada
        // ruta GET => "/api/cinema/get/?actors-serie=35"
    } elseif (isset($_GET['actors-serie']) && is_numeric($_GET['actors-serie'])) {
        $id = $_GET['actors-serie'];
        global $conn;
        $data = array();
        $stmt = $conn->prepare("SELECT a.nom, a.cognoms, a.id AS idActor, sa.role, img.nameImg, sa.id AS idCast
        FROM 11_db_cinema_series_tv AS s
        INNER JOIN 11_aux_cinema_actors_seriestv AS sa on s.id = sa.idSerie
        INNER JOIN 11_db_actors AS a ON a.id = sa.idActor
        LEFT JOIN db_img AS img ON a.img = img.id
        WHERE s.id = :id
        ORDER BY a.cognoms ASC");
        $stmt->execute(['id' => $id]);
        if($stmt->rowCount() === 0) echo ('No rows');
            while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                $data[] = $users;
            }
        echo json_encode($data);

         // 1) Llistat actors
        // ruta GET => "/api/cinema/get/?actors"
        } elseif (isset($_GET['actors'])) {
            global $conn;
            $data = array();
            $stmt = $conn->prepare("SELECT a.id, CONCAT(a.cognoms, ', ', a.nom) AS nomComplet
            FROM 11_db_actors AS a
            ORDER BY a.cognoms ASC");
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
        
        // Llistat productors
        // ruta GET => "/api/cinema/get/auxiliars/?type=productores"
        } elseif (isset($_GET['type']) && $_GET['type'] == 'productores' ) {
            global $conn;
            $data = array();
            $stmt = $conn->prepare("SELECT p.id, p.productora
            FROM 11_aux_cinema_productores AS p
            ORDER BY p.productora ASC");
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
        
        // Llistat imatges series
        // ruta GET => "/api/cinema/get/auxiliars/?type=imgSeries"
        } elseif (isset($_GET['type']) && $_GET['type'] == 'imgSeries' ) {
            global $conn;
            $data = array();
            $stmt = $conn->prepare("SELECT i.id, i.alt
            FROM db_img AS i
            WHERE i.typeImg = 7
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
