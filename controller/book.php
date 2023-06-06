<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
$updatedPath = str_replace('/httpdocs', '', $rootDirectory);

require_once($updatedPath . '/pass/connection.php');

// JSON of Links > all categories
if ( (isset($_GET['type']) && $_GET['type'] == 'book') && (isset($_GET['slug']) ) ) {
    global $conn;
    $slug = $_GET['slug'];
    $data = array();
    $stmt = $conn->prepare(
        "SELECT autor.id, autor.AutNom, autor.AutCognom1, book.titol, book.dateCreated, book.dateModified, book.any, editorial.nomEditorial, g.genre AS nomGenEng, l.language, editorial.idEditorial, g.id AS idGenere, img.nameImg, img.alt, type.name AS typeName, bt.nomTipusEng, autor2.id AS idAutor2, autor2.AutNom AS AutNom2, autor2.AutCognom1 AS AutCognom2, autor.slug AS autorSlug
        FROM db_library_books AS book
        LEFT JOIN db_library_authors AS autor ON book.nomAutor = autor.id
        LEFT JOIN db_library_books_authors  AS ba ON book.id = ba.idBook
        LEFT JOIN db_library_authors AS autor2 ON ba.idAuthor = autor2.id
        LEFT JOIN db_library_genres AS g ON book.idGen = g.id
        LEFT JOIN db_library_publishers AS editorial ON book.IdEd = editorial.idEditorial
        LEFT JOIN db_countries AS pais ON editorial.paisEditorial = pais.id
        LEFT JOIN db_library_languages AS l ON book.lang = l.id
        LEFT JOIN db_img AS img ON book.img = img.id
        LEFT JOIN db_img_type AS type ON img.typeImg = type.id
        INNER JOIN db_library_booktype  AS bt ON book.tipus = bt.id
        WHERE book.slug='$slug'");
        $stmt->execute([]);
        if($stmt->rowCount() === 0) echo ('No rows');
        while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $data[] = $users;
        }
        echo json_encode($data);

} elseif ( (isset($_GET['type']) && $_GET['type'] == 'books') ) {
            global $conn;
            $data = array();
            $stmt = $conn->prepare(
                "SELECT autor.id, autor.AutNom, autor.AutCognom1, book.titol, book.any, autor.slug AS autorSlug, book.slug AS bookSlug
                FROM db_library_books AS book
                LEFT JOIN db_library_authors AS autor ON book.nomAutor = autor.id
                ORDER BY book.titol ASC");
                $stmt->execute([]);
                if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
                echo json_encode($data);

} elseif ( (isset($_GET['type']) && $_GET['type'] == 'author') && (isset($_GET['slug']) ) ) {
            global $conn;
            $slug = $_GET['slug'];
            $data = array();
            $stmt = $conn->prepare(
                "SELECT a.id, a.AutNom, a.AutCognom1, a.AutOcupacio, a.AutMoviment, a.yearBorn, a.yearDie, a.paisAutor, a.img, a.AutWikipedia, a.AutDescrip, a.dateModified, a.dateCreated, c.country AS nomPaisEng, c.id AS idPais, m.movement AS nomMovEng, m.id AS idMov, o.name AS nameOc, i.nameImg, i.alt
                FROM db_library_authors AS a
                INNER JOIN db_countries AS c ON a.paisAutor = c.id
                INNER JOIN db_library_movements AS m ON a.AutMoviment = m.id
                INNER JOIN db_persons_role AS o ON a.AutOcupacio = o.id
                LEFT JOIN db_img AS i ON a.img = i.id
                WHERE a.slug='$slug'");
                $stmt->execute([]);
                if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
                echo json_encode($data);

} elseif ( (isset($_GET['type']) && $_GET['type'] == 'authors') ) {
                global $conn;
                $data = array();
                $stmt = $conn->prepare(
                    "SELECT a.id, a.AutNom, a.AutCognom1, a.yearBorn, a.yearDie, c.country AS nomPaisEng, c.id AS idPais, a.slug AS autorSlug, o.name AS professio
                    FROM db_library_authors AS a
                    INNER JOIN db_countries AS c ON a.paisAutor = c.id
                    INNER JOIN db_persons_role AS o ON a.AutOcupacio = o.id
                    ORDER BY a.AutCognom1 ASC");
                    $stmt->execute([]);
                    if($stmt->rowCount() === 0) echo ('No rows');
                    while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                        $data[] = $users;
                    }
                    echo json_encode($data);
} else {
    echo "error";
}

