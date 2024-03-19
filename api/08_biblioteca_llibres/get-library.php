<?php

if (isset($params['allAuthors'])) {
    $authorsPoint = $params['allAuthors'];
} elseif (isset($params['topics'])) {
   $topicsPoint = $params['topics']; 
} elseif (isset($params['allBooks'])) {
    $booksPoint = $params['allBooks'];
} elseif (isset($params['generes'])) {
    $generesPoint = $params['generes'];
} elseif (isset($params['authorId'])) {
    $booksAuthorPoint = $params['authorId'];
} elseif (isset($params['slugAuthors'])) {
    $AuthorPoint = $params['slugAuthors'];
} elseif (isset($params['autors'])) {
    $autorsPoint = $params['autors'];
} elseif (isset($params['imatgesLlibres'])) {
    $imatgesLlibresPoint = $params['imatgesLlibres'];
}

// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header('HTTP/1.1 405 Method Not Allowed');
    echo json_encode(['error' => 'Method not allowed']);
    exit();
} else {
    // Verificar si se proporciona un token en el encabezado de autorización
    $headers = apache_request_headers();

    if (isset($headers['Authorization'])) {
        $token = str_replace('Bearer ', '', $headers['Authorization']);

        // Verificar el token aquí según tus requerimientos
        if (verificarToken($token)) {
            // Token válido, puedes continuar con el código para obtener los datos del usuario

            // 1) Llistat topics
            // ruta GET => "https://control.elliotfern/api/library/topics"
            if (isset($topicsPoint )) {
                global $conn;
                $data = array();
                $stmt = $conn->prepare(
                    "SELECT id, topic
                    FROM db_topics
                    ORDER BY topic ASC");
                    $stmt->execute();
                    if($stmt->rowCount() === 0) echo ('No rows');
                    while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                        $data[] = $users;
                    }
                    echo json_encode($data);
            
            // 2) Llistat llibres
            // ruta GET => "/api/library/books/all"
            } elseif (isset($booksPoint )) {
                global $conn;
                $data = array();
                $stmt = $conn->prepare(
                    "SELECT b.titol, b.titolEng, b.any, b.lang, b.id, a.id AS idAutor, a.cognoms AS AutCognom1, a.nom AS AutNom, g.genere_en AS nomGenEng, g.genere_cat AS nomGenCat, g.id AS idGenere, bc.nomCollection, b.slug, a.slug AS slugAuthor, g.codi_cdu AS codiGenere, sg.sub_genere_cat, sg.codi_cdu AS codiSubGenere, idi.idioma_ca, be.editorial, e.estat
                    FROM 08_db_biblioteca_llibres AS b
                    INNER JOIN 08_db_biblioteca_autors AS a ON b.autor = a.id
                    LEFT JOIN 08_aux_biblioteca_generes_literaris AS g ON b.idGen = g.id
                    LEFT JOIN 08_aux_biblioteca_sub_generes_literaris AS sg ON b.subGen = sg.id
                    LEFT JOIN 08_aux_biblioteca_editorials AS be ON b.idEd = be.id
                    LEFT JOIN aux_idiomes AS idi ON b.lang = idi.id
                    LEFT JOIN 08_aux_biblioteca_colleccions_llibres AS bookc ON b.id = bookc.idBook
                    LEFT JOIN 08_aux_biblioteca_colleccions AS bc ON bookc.idCollection = bc.id
                    LEFT JOIN 08_aux_biblioteca_estat_llibre AS e ON b.estat = e.id
                    WHERE b.tipus = 1
                    ORDER BY b.titol ASC");
                    $stmt->execute();
                    if($stmt->rowCount() === 0) echo ('No rows');
                    while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                        $data[] = $users;
                    }
                    echo json_encode($data);
        
            // 1) Llistat contactes 
            // ruta GET => "/api/library/book/generes"
            } elseif (isset($generesPoint)) {
                $idGen = $params['generes'];
                global $conn;
                $data = array();
                $stmt = $conn->prepare(
                "SELECT b.titol, b.titolEng, b.any, b.lang, b.id, a.id AS idAutor, a.cognoms AS AutCognom1, a.nom AS AutNom, g.genere_en AS nomGenEng, g.genere_cat AS nomGenCat, g.id AS idGenere, bc.nomCollection, b.slug, a.slug AS slugAuthor, g.codi_cdu AS codiGenere, sg.sub_genere_cat, sg.codi_cdu AS codiSubGenere, idi.idioma_ca, be.editorial
                FROM 08_db_biblioteca_llibres AS b
                INNER JOIN 08_db_biblioteca_autors AS a ON b.autor = a.id
                LEFT JOIN 08_aux_biblioteca_generes_literaris AS g ON b.idGen = g.id
                LEFT JOIN 08_aux_biblioteca_sub_generes_literaris AS sg ON b.subGen = sg.id
                LEFT JOIN 08_aux_biblioteca_editorials AS be ON b.idEd = be.id
                LEFT JOIN aux_idiomes AS idi ON b.lang = idi.id
                LEFT JOIN 08_aux_biblioteca_colleccions_llibres AS bookc ON b.id = bookc.idBook
                LEFT JOIN 08_aux_biblioteca_colleccions AS bc ON bookc.idCollection = bc.id
                WHERE g.codi_cdu = $idGen AND b.tipus = 1
                ORDER BY b.titol ASC");
                $stmt->execute();
                if($stmt->rowCount() === 0) echo ('No rows');
                    while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                        $data[] = $users;
                    }
                echo json_encode($data);

            // 3) Llistat autors
            // ruta GET => "https://control.elliotfern/api/library/get/authors"
            } elseif (isset($authorsPoint )) {
                        global $conn;
                        $data = array();
                        $stmt = $conn->prepare(
                            "SELECT a.id, a.nom AS AutNom, a.cognoms AS AutCognom1, a.slug, a.yearBorn, a.yearDie, a.AutWikipedia, c.pais_cat AS country, c.id AS idCountry, p.professio_ca AS profession, p.id AS idProfession,  i.nameImg
                            FROM 08_db_biblioteca_autors AS a
                            INNER JOIN db_countries AS c ON a.paisAutor = c.id
                            INNER JOIN aux_professions AS p ON a.ocupacio = p.id
                            LEFT JOIN db_img AS i ON a.img = i.id
                            ORDER BY a.cognoms");
                            $stmt->execute();
                            if($stmt->rowCount() === 0) echo ('No rows');
                            while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                                $data[] = $users;
                            }
                            echo json_encode($data);
        
            // 4) Authors page > list of books
            // ruta GET => "https://control.elliotfern/api/library/authors/books/9"
            } elseif (isset($booksAuthorPoint)) {
                $id = $params['authorId'];
                global $conn;
                $data = array();
                $stmt = $conn->prepare(
                "SELECT b.id, b.any, b.titol, b.slug
                FROM 08_db_biblioteca_llibres AS b
                WHERE b.autor = :id
                ORDER BY b.any ASC");
                $stmt->execute(['id' => $id]);

                if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
                echo json_encode($data);
            
            // 5) Authors page
            // ruta GET => "api/library/authors/joaquim-albareda"
            } elseif (isset($AuthorPoint)) {
                $slug = $params['slugAuthors'];
                global $conn;
                $data = array();
                $stmt = $conn->prepare(
                "SELECT a.id, a.cognoms AS AutCognom1, a.nom AS AutNom, p.pais_cat AS country, a.yearBorn, a.yearDie, p.id AS idPais, o.professio_ca AS name, i.nameImg, m.moviment_ca AS movement, m.id AS idMovement, a.AutWikipedia, a.dateCreated, a.dateModified, a.AutDescrip, a.slug, a.img AS idImg, a.ocupacio AS AutOcupacio
                FROM 08_db_biblioteca_autors AS a
                INNER JOIN db_countries AS p ON a.paisAutor = p.id
                INNER JOIN aux_professions AS o ON a.ocupacio = o.id
                LEFT JOIN db_img AS i ON a.img = i.id
                INNER JOIN 08_aux_biblioteca_moviments  AS m ON a.moviment = m.id
                WHERE a.slug = :slug");
                $stmt->execute(['slug' => $slug]);
                
                if ($stmt->rowCount() === 0) {
                    echo json_encode(null);  // Devuelve un objeto JSON nulo si no hay resultados
                } else {
                    // Solo obtenemos la primera fila ya que parece ser una búsqueda por ID
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    echo json_encode($row);  // Codifica la fila como un objeto JSON
                }
            
            // 5) Authors page
            // ruta GET => "/api/biblioteca/get/?autor-id=VALOR_DEL_ID"
            } elseif (isset($_GET['autor-id'])) {
                $id = $_GET['autor-id'];
                global $conn;
                $data = array();
                $stmt = $conn->prepare("SELECT a.id, a.cognoms AS AutCognom1, a.nom AS AutNom, p.pais_cat AS country, a.yearBorn, a.yearDie, p.id AS idPais, o.professio_ca AS name, i.nameImg, m.moviment_ca AS movement, m.id AS idMovement, a.AutWikipedia, a.dateCreated, a.dateModified, a.AutDescrip, a.slug, a.img AS idImg, a.ocupacio AS AutOcupacio
                FROM 08_db_biblioteca_autors AS a
                INNER JOIN db_countries AS p ON a.paisAutor = p.id
                INNER JOIN aux_professions AS o ON a.ocupacio = o.id
                LEFT JOIN db_img AS i ON a.img = i.id
                INNER JOIN 08_aux_biblioteca_moviments AS m ON a.moviment = m.id
                WHERE a.id = :id");
                $stmt->execute(['id' => $id]);
                
                if ($stmt->rowCount() === 0) {
                    echo json_encode(null);  // Devuelve un objeto JSON nulo si no hay resultados
                } else {
                    // Solo obtenemos la primera fila ya que parece ser una búsqueda por ID
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    echo json_encode($row);  // Codifica la fila como un objeto JSON
                }

            // 6) Book page
            // ruta GET => "/api/biblioteca/get/?llibre-id=ID"
                } elseif (isset($_GET['llibre-id'])) {
                    $id = $_GET['llibre-id'];
                    global $conn;
                    $data = array();
                    $stmt = $conn->prepare(
                    "SELECT b.id, b.autor,b.titol, b.titolEng, b.slug, b.any, b.tipus, b.idEd, b.idGen, b.lang,b.img, b.dateCreated, b.dateModified, b.subGen, b.estat
                    FROM 08_db_biblioteca_llibres AS b
                    WHERE b.id = :id");
                    $stmt->execute(['id' => $id]);
                    
                    if ($stmt->rowCount() === 0) {
                        echo json_encode(null);  // Devuelve un objeto JSON nulo si no hay resultados
                    } else {
                        // Solo obtenemos la primera fila ya que parece ser una búsqueda por ID
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        echo json_encode($row);  // Codifica la fila como un objeto JSON
                    }

            // 6) Book page
            // ruta GET => "/api/biblioteca/get/?llibre-slug=el-por-bien-del-imperio"
            } elseif (isset($_GET['llibre-slug'])) {
                $slug = $_GET['llibre-slug'];
                global $conn;
                $data = array();
                $stmt = $conn->prepare("SELECT b.id, a.nom, a.cognoms, a.id AS idAutor, a.slug AS slugAutor, b.titol, b.titolEng, b.slug, b.any, b.dateCreated, b.dateModified, i.nameImg, t.nomTipus, e.editorial, g.genere_cat, id.idioma_ca, a.slug AS slugAutor, sg.sub_genere_cat
                FROM 08_db_biblioteca_llibres AS b
                INNER JOIN db_img AS i ON b.img = i.id
                INNER JOIN 08_db_biblioteca_autors AS a ON b.autor = a.id
                INNER JOIN 08_aux_biblioteca_tipus as t on b.tipus = t.id
                INNER JOIN 08_aux_biblioteca_editorials AS e ON b.idEd = e.id
                INNER JOIN 08_aux_biblioteca_generes_literaris AS g ON b.idGen = g.id
                LEFT JOIN 08_aux_biblioteca_sub_generes_literaris AS sg ON b.subGen = sg.id
                INNER JOIN aux_idiomes AS id ON b.lang = id.id
                WHERE b.slug = :slug");
                $stmt->execute(['slug' => $slug]);

                if ($stmt->rowCount() === 0) {
                    echo json_encode(null);  // Devuelve un objeto JSON nulo si no hay resultados
                } else {
                    // Solo obtenemos la primera fila ya que parece ser una búsqueda por ID
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    echo json_encode($row);  // Codifica la fila como un objeto JSON
                }

        // ruta GET => "/api/biblioteca/get/?colleccio=123"
        } elseif (isset($_GET['colleccio']) && is_numeric($_GET['colleccio'])) {
            $id= $_GET['colleccio'];
            global $conn;
                $data = array();
                $stmt = $conn->prepare("SELECT bc.nomCollection AS Nom, bookc.ordre AS Ordre
                FROM 08_db_biblioteca_llibres AS book
                INNER JOIN 08_aux_biblioteca_colleccions_llibres AS bookc ON book.id = bookc.idBook
                INNER JOIN 08_aux_biblioteca_colleccions AS bc ON bookc.idCollection = bc.id
                WHERE book.id = :id");
                $stmt->execute(['id' => $id]);

                if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
                echo json_encode($data);

            // 7) Profession author
            // ruta GET => "/api/library/professio"
        } elseif (isset($_GET['professio']) ) {
                global $conn;
                $data = array();
                $stmt = $conn->prepare(
                "SELECT r.id, r.professio_ca AS professio_ca
                FROM aux_professions AS r
                ORDER BY r.professio_ca");
                $stmt->execute();
                
                if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
                echo json_encode($data);

            // 8) Movement author
            // ruta GET => "/api/library/moviment"
           } elseif (isset($_GET['moviment']) ) {
                global $conn;
                $data = array();
                $stmt = $conn->prepare(
                "SELECT m.id, m.moviment_ca AS movement_ca
                FROM 08_aux_biblioteca_moviments AS m
                ORDER BY m.moviment_ca");
                $stmt->execute();
                
                if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
                echo json_encode($data);

            // 9) country
            // ruta GET => "/api/places/pais"
        } elseif (isset($_GET['pais']) ) {
                global $conn;
                $data = array();
                $stmt = $conn->prepare(
                "SELECT c.id, c.pais_cat AS pais_ca
                FROM db_countries AS c
                ORDER BY c.pais_cat");
                $stmt->execute();
                
                if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
                echo json_encode($data);

         // 10) image author
        // ruta GET => "/api/biblioteca/auxiliars/?imatgeAutor"
        } elseif (isset($_GET['imageAuthor']) ) {
            global $conn;
            $data = array();
            $stmt = $conn->prepare(
            "SELECT i.id, i.alt
            FROM db_img AS i
            WHERE i.typeImg = 1
            ORDER BY i.alt");
            $stmt->execute();
            
            if($stmt->rowCount() === 0) echo ('No rows');
            while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                $data[] = $users;
            }
            echo json_encode($data);
        
        // 10) ruta estat del llibre
        // ruta GET => "/api/biblioteca/auxiliars/?estatLlibre"
        } elseif (isset($_GET['type']) && $_GET['type'] == 'estatLlibre' ) {
            global $conn;
            $data = array();
            $stmt = $conn->prepare(
            "SELECT e.id, e.estat
            FROM 08_aux_biblioteca_estat_llibre AS e
            ORDER BY e.estat");
            $stmt->execute();
            
            if($stmt->rowCount() === 0) echo ('No rows');
            while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                $data[] = $users;
            }
            echo json_encode($data);

        // 10) Llistat autors
        // ruta GET => "/api/biblioteca/auxiliars/?type=autors"
        } elseif (isset($_GET['type']) && $_GET['type'] == 'autors' ) {
            global $conn;
            $data = array();
            $stmt = $conn->prepare(
                "SELECT a.id, CONCAT(a.cognoms, ', ', a.nom) AS nomComplet
                FROM 08_db_biblioteca_autors AS a
                ORDER BY a.cognoms");
                $stmt->execute();
                if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
                echo json_encode($data);       
        
        // 11) Llibre imatge
        // ruta GET => "/api/biblioteca/auxiliars/?type=oficis"
        } elseif (isset($_GET['type']) && $_GET['type'] == 'imatgesLlibres' ) {
            global $conn;
            $data = array();
            $stmt = $conn->prepare(
                "SELECT i.id, i.alt
                FROM db_img AS i
                WHERE i.typeImg = 2
                ORDER BY i.alt ASC");
                $stmt->execute();
                if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
                echo json_encode($data);
        
         // 11) Editorials
        // ruta GET => "/api/biblioteca/auxiliars/?type=editorials"
        } elseif (isset($_GET['type']) && $_GET['type'] == 'editorials' ) {
            global $conn;
            $data = array();
            $stmt = $conn->prepare(
                "SELECT e.id, e.editorial
                FROM 08_aux_biblioteca_editorials AS e
                ORDER BY e.editorial ASC");
                $stmt->execute();
                if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
                echo json_encode($data);
            
            // 11) Gèneres
            // ruta GET => "/api/biblioteca/auxiliars/?type=generes"
            } elseif (isset($_GET['type']) && $_GET['type'] == 'generes' ) {
                global $conn;
                $data = array();
                $stmt = $conn->prepare(
                    "SELECT g.id, g.genere_cat
                    FROM 08_aux_biblioteca_generes_literaris AS g
                    ORDER BY g.genere_cat ASC");
                    $stmt->execute();
                    if($stmt->rowCount() === 0) echo ('No rows');
                    while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                        $data[] = $users;
                    }
                    echo json_encode($data);
            
                    // 11) Gèneres
            // ruta GET => "/api/biblioteca/auxiliars/?type=subgeneres"
            } elseif (isset($_GET['type']) && $_GET['type'] == 'subgeneres' ) {
                global $conn;
                $data = array();
                $stmt = $conn->prepare(
                    "SELECT g.id, g.sub_genere_cat
                    FROM 08_aux_biblioteca_sub_generes_literaris AS g
                    ORDER BY g.sub_genere_cat ASC");
                    $stmt->execute();
                    if($stmt->rowCount() === 0) echo ('No rows');
                    while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                        $data[] = $users;
                    }
                    echo json_encode($data);

            // 11) Gèneres
            // ruta GET => "/api/biblioteca/auxiliars/?type=llengues"
            } elseif (isset($_GET['type']) && $_GET['type'] == 'llengues' ) {
                global $conn;
                $data = array();
                $stmt = $conn->prepare(
                    "SELECT l.id, l.idioma_ca 
                    FROM aux_idiomes AS l
                    ORDER BY l.idioma_ca ASC");
                    $stmt->execute();
                    if($stmt->rowCount() === 0) echo ('No rows');
                    while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                        $data[] = $users;
                    }
                    echo json_encode($data);
                  
            // 11) Gèneres
            // ruta GET => "/api/biblioteca/auxiliars/?type=tipus"
            } elseif (isset($_GET['type']) && $_GET['type'] == 'tipus' ) {
                global $conn;
                $data = array();
                $stmt = $conn->prepare(
                    "SELECT t.nomTipus, t.id
                    FROM 08_aux_biblioteca_tipus AS t
                    ORDER BY t.nomTipus ASC");
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
}