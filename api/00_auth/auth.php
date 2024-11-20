<?php

// Verificar si se proporciona un token en el encabezado de autorización
$headers = apache_request_headers();
if (isset($headers['Authorization'])) {
    $token = str_replace('Bearer ', '', $headers['Authorization']);

    // Verificar el token aquí según tus requerimientos
    if (verificarToken($token)) {
        // Token válido, puedes continuar con el código para obtener los datos del usuario

        // 1) Informacion usuario
        // ruta => "https://control.elliotfern.com/api/auth/?type=user&id=1"
        if (isset($_GET['type']) && $_GET['type'] === 'user' && isset($_GET['id'])) {
        
            // Asigna valores a las variables después de verificar que no son null
            $id = $_GET['id'];

            
                global $conn;
                $data = array();
                $stmt = $conn->prepare(
                    "SELECT u.firstName, u.lastName
                    FROM db_users AS u
                    WHERE u.id=?");
                $stmt->execute([$id]);

                if ($stmt->rowCount() === 0) {
                    echo json_encode(null);  // Devuelve un objeto JSON nulo si no hay resultados
                } else {
                    // Solo obtenemos la primera fila ya que parece ser una búsqueda por ID
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    echo json_encode($row);  // Codifica la fila como un objeto JSON
                }
        
        } elseif (isset($_GET['type']) && $_GET['type'] == 'country' ) {
            global $conn;
            $data = array();
            $stmt = $conn->prepare(
                "SELECT p.id AS abbreviation, p.country AS name
                FROM db_countries AS p
                ORDER BY p.country ASC");
                $stmt->execute();
                if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
                echo json_encode($data);
                
        } elseif (isset($_GET['type']) && $_GET['type'] == 'tvshows' ) {
                global $conn;
                $data = array();
                $stmt = $conn->prepare("SELECT t.id, t.name, t.startYear, t.endYear, t.season, t.chapter, t.director, t.lang, t.genre, t.producer, t.country, t.img, d.id AS idDirector, d.nomDirector, d.lastName, tc.topic, di.producer AS tvProducer, c.country AS countryName, i.nameImg
                    FROM db_tvmovies_tvshows AS t
                    INNER JOIN db_tvmovies_directors AS d ON t.director = d.id
                    INNER JOIN db_topics AS tc ON t.genre = tc.id
                    INNER JOIN db_tvmovies_distributors AS di ON t.producer = di.id
                    INNER JOIN db_countries AS c ON t.country = c.id
                    INNER JOIN db_img AS i ON t.img = i.id
                    ORDER BY t.id ASC");
                    $stmt->execute();
                    if($stmt->rowCount() === 0) echo ('No rows');
                    while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                        $data[] = $users;
                    }

                    echo json_encode(array('data'=>$data));
        } elseif (isset($_GET['type']) && $_GET['type'] == 'movies' ) {
                global $conn;
                $data = array();
                $stmt = $conn->prepare("SELECT m.id, m.nameMovie, m.directorMovie, m.yearMovie, m.movieCountry, m.img, m.dataView, m.placeView, d.id AS idDirector, d.nomDirector, d.lastName, c.country AS countryName, i.nameImg
                    FROM db_tvmovies_movies AS m
                    INNER JOIN db_tvmovies_directors AS d ON m.directorMovie = d.id
                    INNER JOIN db_countries AS c ON m.movieCountry = c.id
                    INNER JOIN db_img AS i ON m.img = i.id
                    ORDER BY m.id ASC");
                    $stmt->execute();
                    if($stmt->rowCount() === 0) echo ('No rows');
                    while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                        $data[] = $users;
                    }

                    echo json_encode(array('data'=>$data));
        } elseif (isset($_GET['type']) && $_GET['type'] == 'img' && $_GET['group'] == 1 ) {
                global $conn;
                $data = array();
                $stmt = $conn->prepare("SELECT i.id, i.alt
                    FROM db_img AS i
                    WHERE i.typeImg = 1
                    ORDER BY i.alt");
                    $stmt->execute();
                    if($stmt->rowCount() === 0) echo ('No rows');
                    while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                        $data[] = $users;
                    }
                    echo json_encode($data);
        } elseif (isset($_GET['type']) && $_GET['type'] == 'img' && $_GET['group'] == 7 ) {
                    global $conn;
                    $data = array();
                    $stmt = $conn->prepare("SELECT i.id, i.alt
                        FROM db_img AS i
                        WHERE i.typeImg = 7
                        ORDER BY i.alt");
                        $stmt->execute();
                        if($stmt->rowCount() === 0) echo ('No rows');
                        while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                            $data[] = $users;
                        }
                        echo json_encode($data);
        } elseif (isset($_GET['type']) && $_GET['type'] == 'img' && $_GET['group'] == 1 ) {
                global $conn;
                $data = array();
                $stmt = $conn->prepare("SELECT i.id, i.alt
                    FROM db_img AS i
                    WHERE i.typeImg = 1
                    ORDER BY i.alt");
                    $stmt->execute();
                    if($stmt->rowCount() === 0) echo ('No rows');
                    while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                        $data[] = $users;
                    }
                echo json_encode($data);
        } elseif (isset($_GET['type']) && $_GET['type'] == 'profession' ) {
                global $conn;
                $data = array();
                $stmt = $conn->prepare("SELECT o.id, o.name 
                FROM db_persons_role AS o
                ORDER BY o.name ASC");
                $stmt->execute();
                if($stmt->rowCount() === 0) echo ('No rows');
                    while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                        $data[] = $users;
                    }
                echo json_encode($data);
        } elseif (isset($_GET['type']) && $_GET['type'] == 'movement' ) {
                global $conn;
                $data = array();
                $stmt = $conn->prepare("SELECT m.id, m.movement
                FROM db_library_movements AS m
                ORDER BY m.movement ASC");
                $stmt->execute();
                if($stmt->rowCount() === 0) echo ('No rows');
                    while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                        $data[] = $users;
                    }
                echo json_encode($data);
        } elseif (isset($_GET['type']) && $_GET['type'] == 'actors' ) {
                global $conn;
                $data = array();
                $stmt = $conn->prepare("SELECT a.id, a.actorLastName, a.actorFirstName, a.actorCountry, a.birthYear, a.deadYear, a.img, c.country
                FROM db_tvmovies_actors AS a
                INNER JOIN db_countries AS c ON a.actorCountry = c.id
                ORDER BY a.id ASC");
                $stmt->execute();
                if($stmt->rowCount() === 0) echo ('No rows');
                    while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                        $data[] = $users;
                    }
                    echo json_encode(array('data'=>$data));
        } elseif (isset($_GET['type']) && $_GET['type'] == 'img' && $_GET['group'] == 9 ) {
                    global $conn;
                    $data = array();
                    $stmt = $conn->prepare("SELECT i.id, i.alt
                        FROM db_img AS i
                        WHERE i.typeImg = 9
                        ORDER BY i.alt");
                        $stmt->execute();
                        if($stmt->rowCount() === 0) echo ('No rows');
                        while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                            $data[] = $users;
                        }
                    echo json_encode($data);
        }  elseif (isset($_GET['type']) && $_GET['type'] == 'history-courses' ) {
                global $conn;
                $data = array();
                $stmt = $conn->prepare("SELECT c.id, c.nameCat, c.nameCast, c.nameEng, c.nameIt, c.descripCat, c.descripCast, c.descripEng, c.descripIt, c.wpIdCat, c.wpIdCast, c.wpIdEng, c.wpIdIt, c.img, c.ordre
                    FROM db_openhistory_courses AS c
                    ORDER BY c.ordre");
                    $stmt->execute();
                    if($stmt->rowCount() === 0) echo ('No rows');
                    while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                        $data[] = $users;
                    }
                echo json_encode($data);
        }  elseif (isset($_GET['type']) && $_GET['type'] == 'history-articles' ) {
                global $conn;
                $data = array();
                $stmt = $conn->prepare("SELECT a.id, a.wpCat, a.wpCast, a.wpEng, a.wpIt, a.cursId, a.ordre, a.dateModified, pCat.post_title AS titleCat, pCast.post_title AS titleCast, pEng.post_title AS titleEng, pIt.post_title AS titleIt, c.nameEng
                FROM kvqphwff_data.db_openhistory_articles AS a
                LEFT JOIN kvqphwff_web.xfr_posts AS pCat ON a.wpCat = pCat.id
                LEFT JOIN kvqphwff_web.xfr_posts AS pCast ON a.wpCast = pCast.id
                LEFT JOIN kvqphwff_web.xfr_posts AS pEng ON a.wpEng = pEng.id
                LEFT JOIN kvqphwff_web.xfr_posts AS pIt ON a.wpIt = pIt.id
                INNER JOIN kvqphwff_data.db_openhistory_courses AS c ON a.cursId = c.id
                ORDER BY c.ordre ASC, a.ordre ASC");
                    $stmt->execute();
                    if($stmt->rowCount() === 0) echo ('No rows');
                    while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                        $data[] = $users;
                    }
                echo json_encode($data);
        }  elseif (isset($_GET['type']) && $_GET['type'] == 'wp-articles' ) {
                global $conn;
                $data = array();
                $stmt = $conn->prepare("SELECT p.id, p.post_title
                FROM kvqphwff_web.xfr_posts AS p
                ORDER BY p.id ASC");
                    $stmt->execute();
                    if($stmt->rowCount() === 0) echo ('No rows');
                    while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                        $data[] = $users;
                    }
                echo json_encode($data);
        }  elseif (isset($_GET['type']) && $_GET['type'] == 'wp-elliotfern-articles' ) {
                global $conn;
                $data = array();
                $stmt = $conn->prepare("SELECT p.ID AS idWp, p.post_title, l.id, l.idPost, l.lang, l.type
                FROM kvqphwff_web.xfr_posts AS p
                LEFT JOIN kvqphwff_data.db_elliotfern_posts_lang AS l ON p.ID = l.idPost
                WHERE (p.post_type = 'post' OR p.post_type= 'page') AND p.post_status = 'publish'
                ORDER BY p.ID ASC");
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