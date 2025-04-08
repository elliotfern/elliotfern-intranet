<?php

// Configuración de cabeceras para aceptar JSON y responder JSON
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: https://elliot.cat");
header("Access-Control-Allow-Methods: GET");

// 1) Llistat pelicules
// ruta GET => "/api/cinema/get/?pelicules"
if (isset($_GET['pelicules'])) {
    global $conn;
    $data = array();
    $stmt = $conn->prepare("SELECT c.id, c.pelicula, c.pelicula_es, c.any, c.dataVista, d.nom, d.cognoms, p.pais_cat, g.genere_ca, i.idioma_ca, c.slug
            FROM 11_db_pelicules AS c
            LEFT JOIN db_persones AS d ON c.director = d.id
            LEFT JOIN db_countries AS p ON c.pais = p.id
            LEFT JOIN 11_aux_cinema_generes AS g ON c.genere = g.id
            LEFT JOIN aux_idiomes AS i ON c.lang = i.id
            ORDER BY c.any DESC");
    $stmt->execute();
    if ($stmt->rowCount() === 0) echo ('No rows');
    while ($users = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $users;
    }
    echo json_encode($data);

    // 1) Pelicules segons el genere
    // ruta GET => "/api/cinema/get/?type=generes&generes=ID"
} elseif (isset($_GET['type']) && $_GET['type'] == 'generes') {
    $idGen = $_GET['generes'];
    global $conn;
    $data = array();
    $stmt = $conn->prepare("SELECT c.id, c.pelicula, c.pelicula_es, c.any, c.dataVista, d.nom, d.cognoms, p.pais_cat, g.genere_ca, i.idioma_ca, c.slug
            FROM 11_db_pelicules AS c
            INNER JOIN 11_aux_cinema_directors AS d ON c.director = d.id
            INNER JOIN db_countries AS p ON c.pais = p.id
            LEFT JOIN 11_aux_cinema_generes AS g ON c.genere = g.id
            LEFT JOIN aux_idiomes AS i ON c.lang = i.id
            WHERE c.genere = $idGen
            ORDER BY c.any DESC");
    $stmt->execute();
    if ($stmt->rowCount() === 0) echo ('No rows');
    while ($users = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $users;
    }
    echo json_encode($data);

    // 1) Llistat tv shows
    // ruta GET => "/api/cinema/get/?series"
} elseif (isset($_GET['series'])) {
    global $conn;
    $data = array();
    $stmt = $conn->prepare(
        "SELECT tv.id, tv.name, tv.startYear, tv.endYear,tv.season, tv.chapter, d.nom, d.cognoms, id.idioma_ca AS lang, g.genere_ca AS genre, tv.producer, c.pais_cat AS country, tv.img, tv.slug, d.slug AS slugDirector
            FROM 11_db_cinema_series_tv AS tv
            INNER JOIN db_persones AS d ON tv.director = d.id
            INNER JOIN db_countries AS c ON tv.country = c.id
            INNER JOIN aux_idiomes AS id ON tv.lang = id.id
            LEFT JOIN 11_aux_cinema_generes AS g ON tv.genre = g.id
            ORDER BY tv.startYear DESC"
    );
    $stmt->execute();
    if ($stmt->rowCount() === 0) echo ('No rows');
    while ($users = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $users;
    }
    echo json_encode($data);

    // 2) Pagina informacio tv show
    // ruta GET => "/api/cinema/get/?serie="benvinguts-a-la-familia"
} elseif (isset($_GET['serie'])) {
    $slug = $_GET['serie'];
    global $conn;

    $query = "SELECT tv.id, tv.name, tv.startYear, tv.endYear, tv.season, tv.chapter, d.nom, d.cognoms, id.idioma_ca, tv.genre, tv.producer, c.pais_cat, img.nameImg, g.genere_ca, tv.descripcio, d.id AS idDirector, d.slug AS slugDirector, c.id AS idPais, img.id AS idImg, id.id As idLang, g.id AS idGen, pr.id AS idProductora, pr.productora, tv.dateCreated, tv.dateModified, tv.slug
            FROM 11_db_cinema_series_tv AS tv
            INNER JOIN db_persones AS d ON tv.director = d.id
            INNER JOIN db_countries AS c ON tv.country = c.id
            LEFT JOIN db_img AS img ON tv.img = img.id
            INNER JOIN aux_idiomes AS id ON tv.lang = id.id
            LEFT JOIN 11_aux_cinema_generes AS g ON tv.genre = g.id
            LEFT JOIN 11_aux_cinema_productores AS pr ON tv.producer = pr.id
            WHERE tv.slug = :slug";

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

    // 2) Pagina informacio pelicula
    // ruta GET => "/api/cinema/get/?pelicula=io-capitano"
} elseif (isset($_GET['pelicula'])) {
    $slug = $_GET['pelicula'];
    global $conn;

    $query = "SELECT p.id, p.pelicula, p.slug, p.pelicula_es, p.any, p.descripcio, p.dataVista, p.dateCreated, p.dateModified, d.nom, d.cognoms, id.idioma_ca, c.pais_cat, img.nameImg, g.genere_ca, d.id AS idDirector, c.id AS idPais, img.id AS idImg, id.id As idLang, g.id AS idGen, d.slug AS slugDirector
            FROM 11_db_pelicules AS p
            LEFT JOIN db_persones AS d ON p.director = d.id
            LEFT JOIN db_countries AS c ON p.pais = c.id
            LEFT JOIN db_img AS img ON p.img = img.id
            LEFT JOIN aux_idiomes AS id ON p.lang = id.id
            LEFT JOIN 11_aux_cinema_generes AS g ON p.genere = g.id
            WHERE p.slug = :slug";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
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

    // 2) Actors que participen en una serie determinada
    // ruta GET => "/api/cinema/get/?actors-serie=benvinguts-a-la-familia"
} elseif (isset($_GET['llistat-actors-serie']) && !empty($_GET['llistat-actors-serie'])) {
    $slug = $_GET['llistat-actors-serie'];
    global $conn;

    $query = "SELECT a.nom, a.cognoms, a.id AS idActor, sa.role, img.nameImg, sa.id AS idCast, a.slug
        FROM 11_db_cinema_series_tv AS s
        LEFT JOIN 11_aux_cinema_actors_seriestv AS sa on s.id = sa.idSerie
        INNER JOIN db_persones AS a ON a.id = sa.idActor
        LEFT JOIN db_img AS img ON a.img = img.id
        WHERE s.slug = :slug";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
    $stmt->execute();

    // Verificar si hay resultados antes de hacer fetch
    if ($stmt->rowCount() === 0) {
        echo json_encode(["error" => "No rows found"]);
        exit;
    }

    // Recopilar los resultados
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);

    // 2) Actors que participen en una pelicula
    // ruta GET => "/api/cinema/get/?actors-pelicula=35"
} elseif (isset($_GET['actors-pelicula'])) {
    $slug = $_GET['actors-pelicula'];
    global $conn;

    $query = "SELECT a.nom, a.cognoms, a.id AS idActor, sa.role, img.nameImg, sa.id AS idCast, a.slug
        FROM 11_db_pelicules AS s
        INNER JOIN 11_aux_cinema_actors_pelicules AS sa on s.id = sa.idMovie
        LEFT JOIN db_persones AS a ON a.id = sa.idActor
        LEFT JOIN db_img AS img ON a.img = img.id
        WHERE s.slug = :slug
        ORDER BY a.cognoms ASC";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
    $stmt->execute();

    // Verificar si hay resultados antes de hacer fetch
    if ($stmt->rowCount() === 0) {
        echo json_encode(["error" => "No rows found"]);
        exit;
    }

    // Recopilar los resultados
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);


    // 1) Llistat actors
    // ruta GET => "/api/cinema/get/?actors"
} elseif (isset($_GET['actors'])) {
    global $conn;
    $data = array();
    $stmt = $conn->prepare("SELECT a.id, a.cognoms, a.nom, CONCAT(a.cognoms, ', ', a.nom) AS nomComplet, c.pais_cat AS country, i.nameImg AS img, a.anyNaixement, a.anyDefuncio, a.slug
    FROM db_persones AS a
    LEFT JOIN db_countries AS c ON a.paisAutor = c.id
    LEFT JOIN db_img AS i ON a.img = i.id
    WHERE grup = '3'
    ORDER BY a.cognoms ASC");
    $stmt->execute();
    if ($stmt->rowCount() === 0) echo json_encode("No rows");
    while ($users = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $users;
    }
    echo json_encode($data);

    // 1) Llistat directors
    // ruta GET => "/api/cinema/get/?directors"
} elseif (isset($_GET['directors'])) {
    global $conn;
    $data = array();
    $stmt = $conn->prepare("SELECT a.id, CONCAT(a.cognoms, ', ', a.nom) AS nomComplet, i.nameImg, c.pais_cat, a.slug, a.anyNaixement, a.anyDefuncio 
            FROM db_persones AS a
            LEFT JOIN db_img AS i ON a.img = i.id
            LEFT JOIN db_countries AS c ON a.paisAutor = c.id
            WHERE grup = '2'
            ORDER BY a.cognoms ASC");

    $stmt->execute();
    if ($stmt->rowCount() === 0) echo ('No rows');
    while ($users = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $users;
    }
    echo json_encode($data);

    // 1) Fitxa director
    // ruta GET => "/api/cinema/get/?director=?arron-sorkin"
} elseif (isset($_GET['director'])) {
    $slug = $_GET['director'];
    global $conn;
    $data = array();
    $query = "SELECT a.id, a.cognoms, a.nom, i.nameImg, c.pais_cat, a.slug, a.anyNaixement, a.anyDefuncio, a.dateCreated, a.dateModified, pro.professio_ca, a.web
            FROM db_persones AS a
            LEFT JOIN db_img AS i ON a.img = i.id
            LEFT JOIN db_countries AS c ON a.paisAutor = c.id
            LEFT JOIN aux_professions AS pro ON a.ocupacio = pro.id
            WHERE a.slug = :slug";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() === 0) echo ('No rows');

    // Recopilar los resultados
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($data);

    // 1) Fitxa director: pelicules
    // ruta GET => "/api/cinema/get/?directorPelicules=?arron-sorkin"
} elseif (isset($_GET['directorPelicules'])) {
    $id = $_GET['directorPelicules'];
    global $conn;
    $data = array();
    $query = "SELECT p.id, p.pelicula AS name, p.slug, p.any AS anyInici, i.nameImg, c.pais_cat, g.genere_ca
            FROM 11_db_pelicules AS p
            LEFT JOIN db_img AS i ON p.img = i.id
            LEFT JOIN db_countries AS c ON p.pais = c.id
            LEFT JOIN 11_aux_cinema_generes AS g ON p.genere = g.id
            WHERE p.director = :id";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() === 0) {
        echo json_encode("No rows");
        exit;
    }

    // Recopilar los resultados
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);

    // 1) Fitxa director: series
    // ruta GET => "/api/cinema/get/?directorSeries=?arron-sorkin"
} elseif (isset($_GET['directorSeries'])) {
    $id = $_GET['directorSeries'];
    global $conn;
    $data = array();

    $query = "SELECT s.id, s.name AS name, s.slug, s.startYear AS anyInici, s.endYear, i.nameImg, c.pais_cat, g.genere_ca
            FROM 11_db_cinema_series_tv AS s
            LEFT JOIN db_img AS i ON s.img = i.id
            LEFT JOIN db_countries AS c ON s.country = c.id
            LEFT JOIN 11_aux_cinema_generes AS g ON s.genre = g.id
            WHERE s.director = :id";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() === 0) {
        echo json_encode("No rows");
        exit;
    }

    // Recopilar los resultados
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);

    // 2) Fitxa autor
    // ruta GET => "/api/cinema/get/?actor=nao-albert"
} elseif (isset($_GET['actor'])) {
    $actorSlug = $_GET['actor']; // Usar "actor" en lugar de "actorSlug"
    global $conn;
    // PREPARED STATEMENT para evitar inyección SQL
    $stmt = $conn->prepare("SELECT
	p.id, p.nom, p.cognoms, p.slug, p.ocupacio, p.anyNaixement, p.anyDefuncio, p.paisAutor, p.img, p.web, p.descripcio, p.dateCreated, p.dateModified, i.nameImg, c.pais_cat, professio_ca
    FROM db_persones AS p
    LEFT JOIN db_img AS i ON p.img = i.id
    LEFT JOIN db_countries AS c ON p.paisAutor = c.id
    LEFT JOIN aux_professions AS pro ON pro.id = p.ocupacio
    WHERE slug = :actorSlug");
    $stmt->bindParam(':actorSlug', $actorSlug, PDO::PARAM_STR);
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

    // 2) Llistat pelicules per actor
    // ruta GET => "/api/cinema/get/?actor-pelicules=nao-albert"
} elseif (isset($_GET['actor-pelicules'])) {
    $actorSlug = $_GET['actor-pelicules'];
    global $conn;

    $query = "SELECT p.pelicula AS titol, sa.role, p.any AS anyInici, p.slug
        FROM 11_db_pelicules AS p
        LEFT JOIN 11_aux_cinema_actors_pelicules AS sa ON p.id = sa.idMovie
        LEFT JOIN db_persones AS pe ON pe.id = sa.idActor 
        WHERE pe.slug = :actorSlug
        ORDER BY p.pelicula ASC";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':actorSlug', $actorSlug, PDO::PARAM_STR);
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

    // 2) Llistat series tv per actor
    // ruta GET => "/api/cinema/get/?actor-series=nao-albert"
} elseif (isset($_GET['actor-series'])) {
    $actorSlug = $_GET['actor-series'];
    global $conn;

    $query = "SELECT s.name AS titol, sa.role, s.startYear AS anyInici, s.endYear AS anyFi, s.slug
        FROM 11_db_cinema_series_tv AS s
        LEFT JOIN 11_aux_cinema_actors_seriestv AS sa ON s.id = sa.idSerie
        LEFT JOIN db_persones AS pe ON pe.id = sa.idActor 
        WHERE pe.slug = :actorSlug
        ORDER BY s.name ASC";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':actorSlug', $actorSlug, PDO::PARAM_STR);
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

    // 2) Actor-pelicula
    // ruta GET => "/api/cinema/get/?actorPelicula=35"
} elseif (isset($_GET['actorPelicula'])) {
    $id = $_GET['actorPelicula'];
    global $conn;

    $query = "SELECT cap.idMovie, cap.idActor, cap.role, p.pelicula, cap.id
        FROM 11_aux_cinema_actors_pelicules AS cap
        LEFT JOIN 11_db_pelicules AS p ON cap.idMovie = p.id
        WHERE cap.id = :id";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();

    // Verificar si hay resultados antes de hacer fetch
    if ($stmt->rowCount() === 0) {
        echo json_encode(["error" => "No rows found"]);
        exit;
    }

    // Recopilar los resultados
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);

    // 2) Actor-serie tv
    // ruta GET => "/api/cinema/get/?actorSerie=35"
} elseif (isset($_GET['actorSerie'])) {
    $id = $_GET['actorSerie'];
    global $conn;

    $query = "SELECT cas.idSerie, cas.idActor, cas.role, cas.id, s.name
        FROM 11_aux_cinema_actors_seriestv AS cas
        LEFT JOIN 11_db_cinema_series_tv AS s ON cas.idSerie = s.id
        WHERE cas.id = :id";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute();

    // Verificar si hay resultados antes de hacer fetch
    if ($stmt->rowCount() === 0) {
        echo json_encode(["error" => "No rows found"]);
        exit;
    }

    // Recopilar los resultados
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
} else {
    // Si 'type', 'id' o 'token' están ausentes o 'type' no es 'user' en la URL
    header('HTTP/1.1 403 Forbidden');
    echo json_encode(['error' => 'Something get wrong']);
    exit();
}
