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
}


// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header('HTTP/1.1 405 Method Not Allowed');
    echo json_encode(['error' => 'Method not allowed']);
    exit();
} else {
            // 2) Llistat llibres
            // ruta GET => "/api/library/books/all"
            if (isset($booksPoint )) {
                global $conn;
                $data = array();
                $stmt = $conn->prepare(
                    "SELECT b.titol, b.titolEng, b.any, b.lang, b.id, a.id AS idAutor, a.cognoms AS AutCognom1, a.nom AS AutNom, g.genere_en AS nomGenEng, g.genere_cat AS nomGenCat, g.id AS idGenere, bc.nomCollection, b.slug, a.slug AS slugAuthor, g.codi_cdu AS codiGenere, sg.sub_genere_cat, sg.codi_cdu AS codiSubGenere, idi.idioma_ca, be.editorial
                    FROM db_biblioteca_llibres AS b
                    INNER JOIN db_biblioteca_autors AS a ON b.autor = a.id
                    LEFT JOIN aux_biblioteca_generes_literaris AS g ON b.idGen = g.id
                    LEFT JOIN aux_biblioteca_sub_generes_literaris AS sg ON b.subGen = sg.id
                    LEFT JOIN aux_biblioteca_editorials AS be ON b.idEd = be.id
                    LEFT JOIN aux_idiomes AS idi ON b.lang = idi.id
                    LEFT JOIN db_library_books_collection AS bookc ON b.id = bookc.idBook
                    LEFT JOIN db_library_collection AS bc ON bookc.idCollection = bc.id
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
                FROM db_biblioteca_llibres AS b
                INNER JOIN db_biblioteca_autors AS a ON b.autor = a.id
                LEFT JOIN aux_biblioteca_generes_literaris AS g ON b.idGen = g.id
                LEFT JOIN aux_biblioteca_sub_generes_literaris AS sg ON b.subGen = sg.id
                LEFT JOIN aux_biblioteca_editorials AS be ON b.idEd = be.id
                LEFT JOIN aux_idiomes AS idi ON b.lang = idi.id
                LEFT JOIN db_library_books_collection AS bookc ON b.id = bookc.idBook
                LEFT JOIN db_library_collection AS bc ON bookc.idCollection = bc.id
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
                            "SELECT a.id, a.nom AS AutNom, a.cognoms AS AutCognom1, a.slug, a.yearBorn, a.yearDie, a.AutWikipedia, c.country, c.id AS idCountry, p.name AS profession, p.id AS idProfession,  i.nameImg
                            FROM db_biblioteca_autors AS a
                            INNER JOIN db_countries AS c ON a.paisAutor = c.id
                            INNER JOIN db_persons_role AS p ON a.ocupacio = p.id
                            INNER JOIN db_img AS i ON a.img = i.id
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
                FROM db_biblioteca_llibres AS b
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
                "SELECT a.id, a.cognoms AS AutCognom1, a.nom AS AutNom, p.country, a.yearBorn, a.yearDie, p.id AS idPais, o.name, i.nameImg, m.movement, m.id AS idMovement, a.AutWikipedia, a.dateCreated, a.dateModified, a.AutDescrip, a.slug, a.img AS idImg, a.ocupacio AS AutOcupacio
                FROM db_biblioteca_autors AS a
                INNER JOIN db_countries AS p ON a.paisAutor = p.id
                INNER JOIN db_persons_role AS o ON a.ocupacio = o.id
                INNER JOIN db_img AS i ON a.img = i.id
                INNER JOIN db_library_movements AS m ON a.moviment = m.id
                WHERE a.slug = :slug");
                $stmt->execute(['slug' => $slug]);
                
                if ($stmt->rowCount() === 0) {
                    echo json_encode(null);  // Devuelve un objeto JSON nulo si no hay resultados
                } else {
                    // Solo obtenemos la primera fila ya que parece ser una búsqueda por ID
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    echo json_encode($row);  // Codifica la fila como un objeto JSON
                }

            // 6) Book page
            // ruta GET => "https://control.elliotfern/api/library/get/?type=book-page-info&slug=el-por-bien-del-imperio"
            } elseif (isset($params['slugBook'])) {
                $slug = $params['slugBook'];
                global $conn;
                $data = array();
                $stmt = $conn->prepare(
                "SELECT 
                b.id, b.autor,b.titol, b.titolEng, b.slug, b.any, b.tipus, b.idEd, b.idGen, b.lang,b.img, b.dateCreated, b.dateModified
                FROM db_biblioteca_llibres AS b
                WHERE b.slug = :slug");
                $stmt->execute(['slug' => $slug]);
                
                if ($stmt->rowCount() === 0) {
                    echo json_encode(null);  // Devuelve un objeto JSON nulo si no hay resultados
                } else {
                    // Solo obtenemos la primera fila ya que parece ser una búsqueda por ID
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    echo json_encode($row);  // Codifica la fila como un objeto JSON
                }

            // 7) Profession author
            // ruta GET => "https://control.elliotfern/api/library/profession"
            } elseif (isset($params['profession'])) {
                global $conn;
                $data = array();
                $stmt = $conn->prepare(
                "SELECT r.id, r.name
                FROM db_persons_role AS r
                ORDER BY r.name");
                $stmt->execute();
                
                if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
                echo json_encode($data);

            // 8) Movement author
            // ruta GET => "https://control.elliotfern/api/library/movement"
            } elseif (isset($params['movement'])) {
                global $conn;
                $data = array();
                $stmt = $conn->prepare(
                "SELECT m.id, m.movement
                FROM db_library_movements AS m
                ORDER BY m.movement");
                $stmt->execute();
                
                if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
                echo json_encode($data);

            // 9) country
            // ruta GET => "https://control.elliotfern/api/places/country"
            } elseif (isset($params['country'])) {
                global $conn;
                $data = array();
                $stmt = $conn->prepare(
                "SELECT c.id, c.country
                FROM db_countries AS c
                ORDER BY c.country");
                $stmt->execute();
                
                if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
                echo json_encode($data);

            // 10) image author
            // ruta GET => "https://control.elliotfern/api/image/author/imageAuthor"
        } elseif (isset($params['imageAuthor'])) {
            global $conn;
            $data = array();
            $stmt = $conn->prepare(
            "SELECT i.id, i.nameImg
            FROM db_img AS i
            WHERE i.typeImg = 1
            ORDER BY i.nameImg");
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
}