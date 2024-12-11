<?php
require('connection.php');

  // 1) ruta per treure la informació d'un llibre
  // RUTA: https://api.elliotfern.com/book.php?type=llibreDetalls&id=1&lang=ca
  if (isset($_GET['type']) && $_GET['type'] == 'llibreDetalls' && isset($_GET['slug']) && isset($_GET['lang'])) {
    global $conn;
    $slug = $_GET['slug'];
    $lang = $_GET['lang'];

    if ($lang === "ca") {
        $query = "SELECT autor.id, autor.nom AS AutNom, autor.cognoms AS AutCognom1, book.titol, book.titolEng, book.dateCreated, book.dateModified, book.any, editorial.editorial AS nomEditorial, g.genere_cat AS nomGen, l.idioma_ca AS idioma, editorial.id AS idEditorial, g.id AS idGenere, img.nameImg, img.alt, type.name AS typeName, bt.nomTipus AS tipusLlibre, autor2.id AS idAutor2, autor2.nom AS AutNom2, autor2.cognoms AS AutCognom2, autor.slug AS autorSlug, sg.sub_genere_cat AS tema
        FROM 08_db_biblioteca_llibres AS book
        LEFT JOIN 08_db_biblioteca_autors AS autor ON book.autor = autor.id
        LEFT JOIN 08_aux_biblioteca_autors_llibres AS ba ON book.id = ba.idBook
        LEFT JOIN 08_db_biblioteca_autors AS autor2 ON ba.idAuthor = autor2.id
        LEFT JOIN 08_aux_biblioteca_generes_literaris AS g ON book.idGen = g.id
        LEFT JOIN 08_aux_biblioteca_sub_generes_literaris AS sg ON sg.id = book.subGen
        LEFT JOIN 08_aux_biblioteca_editorials AS editorial ON book.IdEd = editorial.id
        LEFT JOIN db_countries AS pais ON editorial.pais = pais.id
        LEFT JOIN aux_idiomes AS l ON book.lang = l.id
        LEFT JOIN db_img AS img ON book.img = img.id
        LEFT JOIN db_img_type AS type ON img.typeImg = type.id
        INNER JOIN 08_aux_biblioteca_tipus AS bt ON book.tipus = bt.id
        WHERE book.slug = :slug";
    } else if ($lang === "es") {
        $query = "SELECT autor.id, autor.nom AS AutNom, autor.cognoms AS AutCognom1, book.titol, book.dateCreated, book.dateModified, book.any, editorial.editorial AS nomEditorial, g.genere_es AS nomGen, l.idioma_es AS idioma, editorial.id AS idEditorial, g.id AS idGenere, img.nameImg, img.alt, type.name AS typeName, bt.nomTipusCast AS tipusLlibre, autor2.id AS idAutor2, autor2.nom AS AutNom2, autor2.cognoms AS AutCognom2, autor.slug AS autorSlug
        FROM 08_db_biblioteca_llibres AS book
        LEFT JOIN 08_db_biblioteca_autors AS autor ON book.autor = autor.id
        LEFT JOIN 08_aux_biblioteca_autors_llibres AS ba ON book.id = ba.idBook
        LEFT JOIN 08_db_biblioteca_autors AS autor2 ON ba.idAuthor = autor2.id
        LEFT JOIN 08_aux_biblioteca_generes_literaris AS g ON book.idGen = g.id
        LEFT JOIN 08_aux_biblioteca_editorials AS editorial ON book.IdEd = editorial.id
        LEFT JOIN db_countries AS pais ON editorial.pais = pais.id
        LEFT JOIN aux_idiomes AS l ON book.lang = l.id
        LEFT JOIN db_img AS img ON book.img = img.id
        LEFT JOIN db_img_type AS type ON img.typeImg = type.id
        INNER JOIN 08_aux_biblioteca_tipus AS bt ON book.tipus = bt.id
        WHERE book.slug = :slug";
    } else if ($lang === "en") {
        $query = "SELECT autor.id, autor.nom AS AutNom, autor.cognoms AS AutCognom1, book.titol, book.dateCreated, book.dateModified, book.any, editorial.editorial AS nomEditorial, g.genere_en AS nomGen, l.idioma_en AS idioma, img.nameImg, img.alt, type.name AS typeName, bt.nomTipusEng AS tipusLlibre, autor2.id AS idAutor2, autor2.nom AS AutNom2, autor2.cognoms AS AutCognom2, autor.slug AS autorSlug
        FROM 08_db_biblioteca_llibres AS book
        LEFT JOIN 08_db_biblioteca_autors AS autor ON book.autor = autor.id
        LEFT JOIN 08_aux_biblioteca_autors_llibres AS ba ON book.id = ba.idBook
        LEFT JOIN 08_db_biblioteca_autors AS autor2 ON ba.idAuthor = autor2.id
        LEFT JOIN 08_aux_biblioteca_generes_literaris AS g ON book.idGen = g.id
        LEFT JOIN 08_aux_biblioteca_editorials AS editorial ON book.IdEd = editorial.id
        LEFT JOIN db_countries AS pais ON editorial.pais = pais.id
        LEFT JOIN aux_idiomes AS l ON book.lang = l.id
        LEFT JOIN db_img AS img ON book.img = img.id
        LEFT JOIN db_img_type AS type ON img.typeImg = type.id
        INNER JOIN 08_aux_biblioteca_tipus AS bt ON book.tipus = bt.id
        WHERE book.slug = :slug";
    } else if ($lang === "fr") {
        $query = "SELECT autor.id, autor.nom AS AutNom, autor.cognoms AS AutCognom1, book.titol, book.dateCreated, book.dateModified, book.any, editorial.editorial AS nomEditorial, g.genere_fr AS nomGen, l.idioma_fr AS idioma, img.nameImg, img.alt, type.name AS typeName, bt.nomTipusFr AS tipusLlibre, autor2.id AS idAutor2, autor2.nom AS AutNom2, autor2.cognoms AS AutCognom2, autor.slug AS autorSlug
        FROM 08_db_biblioteca_llibres AS book
        LEFT JOIN 08_db_biblioteca_autors AS autor ON book.autor = autor.id
        LEFT JOIN 08_aux_biblioteca_autors_llibres AS ba ON book.id = ba.idBook
        LEFT JOIN 08_db_biblioteca_autors AS autor2 ON ba.idAuthor = autor2.id
        LEFT JOIN 08_aux_biblioteca_generes_literaris AS g ON book.idGen = g.id
        LEFT JOIN 08_aux_biblioteca_editorials AS editorial ON book.IdEd = editorial.id
        LEFT JOIN db_countries AS pais ON editorial.pais = pais.id
        LEFT JOIN aux_idiomes AS l ON book.lang = l.id
        LEFT JOIN db_img AS img ON book.img = img.id
        LEFT JOIN db_img_type AS type ON img.typeImg = type.id
        INNER JOIN 08_aux_biblioteca_tipus AS bt ON book.tipus = bt.id
        WHERE book.slug = :slug";
    } else if ($lang === "it") {
        $query = "SELECT autor.id, autor.nom AS AutNom, autor.cognoms AS AutCognom1, book.titol, book.dateCreated, book.dateModified, book.any, editorial.editorial AS nomEditorial, g.genere_it AS nomGen, l.idioma_it AS idioma, img.nameImg, img.alt, type.name AS typeName, bt.nomTipusIt AS tipusLlibre, autor2.id AS idAutor2, autor2.nom AS AutNom2, autor2.cognoms AS AutCognom2, autor.slug AS autorSlug
        FROM 08_db_biblioteca_llibres AS book
        LEFT JOIN 08_db_biblioteca_autors AS autor ON book.autor = autor.id
        LEFT JOIN 08_aux_biblioteca_autors_llibres AS ba ON book.id = ba.idBook
        LEFT JOIN 08_db_biblioteca_autors AS autor2 ON ba.idAuthor = autor2.id
        LEFT JOIN 08_aux_biblioteca_generes_literaris AS g ON book.idGen = g.id
        LEFT JOIN 08_aux_biblioteca_editorials AS editorial ON book.IdEd = editorial.id
        LEFT JOIN db_countries AS pais ON editorial.pais = pais.id
        LEFT JOIN aux_idiomes AS l ON book.lang = l.id
        LEFT JOIN db_img AS img ON book.img = img.id
        LEFT JOIN db_img_type AS type ON img.typeImg = type.id
        INNER JOIN 08_aux_biblioteca_tipus AS bt ON book.tipus = bt.id
        WHERE book.slug = :slug";
    }

    // Preparar la consulta
    $stmt = $conn->prepare($query);

    // Vincular el valor del parámetro id de forma segura
    $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
                
    // Ejecutar la consulta
    $stmt->execute();
    
    // Verificar si se encontraron resultados
    if ($stmt->rowCount() === 0) {
        echo json_encode(['error' => 'No rows found']);
        exit;
    }

    // Recopilar los resultados
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Establecer el encabezado de respuesta a JSON
    header('Content-Type: application/json');
    
    // Devolver los datos en formato JSON
    echo json_encode($data);

 // 2) ruta per treure la informació de tots els llibres
// RUTA: https://api.elliotfern.com/book.php?type=totsLlibres&lang=ca
} elseif (isset($_GET['type']) && $_GET['type'] == 'totsLlibres' && isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    global $conn;

    if ($lang === "ca") {
        $query = "SELECT 
        autor.id AS idAuthor, 
        autor.nom AS AutNom, 
        autor.cognoms AS AutCognom1, 
        book.titol, 
        book.any, 
        autor.slug AS autorSlug, 
        book.slug AS bookSlug, 
        img.nameImg, 
        img.alt, 
        lang.idioma_ca AS lang, 
        book.id, 
        t.genere_cat AS genere,
        topic.sub_genere_cat AS tema
    FROM 08_db_biblioteca_llibres AS book 
    LEFT JOIN 08_db_biblioteca_autors AS autor ON book.autor = autor.id 
    LEFT JOIN db_img AS img ON book.img = img.id 
    LEFT JOIN aux_idiomes AS lang ON book.lang = lang.id
    LEFT JOIN 08_aux_biblioteca_generes_literaris AS t ON book.idGen = t.id
    LEFT JOIN 08_aux_biblioteca_sub_generes_literaris AS topic ON book.subGen = topic.id
    GROUP BY book.id
    ORDER BY book.titol ASC;";
    } else if ($lang === "en") {
        $query = "SELECT 
        autor.id AS idAuthor, 
        autor.nom AS AutNom, 
        autor.cognoms AS AutCognom1, 
        book.titol, 
        book.any, 
        autor.slug AS autorSlug, 
        book.slug AS bookSlug, 
        img.nameImg, 
        img.alt, 
        lang.idioma_en AS lang, 
        book.id, 
        t.genere_en AS genere,
        topic.sub_genere_en AS tema
    FROM 08_db_biblioteca_llibres AS book 
    LEFT JOIN 08_db_biblioteca_autors AS autor ON book.autor = autor.id 
    LEFT JOIN db_img AS img ON book.img = img.id 
    LEFT JOIN aux_idiomes AS lang ON book.lang = lang.id
    LEFT JOIN 08_aux_biblioteca_generes_literaris AS t ON book.idGen = t.id
    LEFT JOIN 08_aux_biblioteca_sub_generes_literaris AS topic ON book.subGen = topic.id
    GROUP BY book.id
    ORDER BY book.titol ASC;";
    } else if ($lang === "fr") {
        $query = "SELECT 
        autor.id AS idAuthor, 
        autor.nom AS AutNom, 
        autor.cognoms AS AutCognom1, 
        book.titol, 
        book.any, 
        autor.slug AS autorSlug, 
        book.slug AS bookSlug, 
        img.nameImg, 
        img.alt, 
        lang.idioma_fr AS lang, 
        book.id, 
        t.genere_fr AS genere,
        topic.sub_genere_fr AS tema
    FROM 08_db_biblioteca_llibres AS book 
    LEFT JOIN 08_db_biblioteca_autors AS autor ON book.autor = autor.id 
    LEFT JOIN db_img AS img ON book.img = img.id 
    LEFT JOIN aux_idiomes AS lang ON book.lang = lang.id
    LEFT JOIN 08_aux_biblioteca_generes_literaris AS t ON book.idGen = t.id
    LEFT JOIN 08_aux_biblioteca_sub_generes_literaris AS topic ON book.subGen = topic.id
    GROUP BY book.id
    ORDER BY book.titol ASC;";
    } else if ($lang === "es") {
        $query = "SELECT 
        autor.id AS idAuthor, 
        autor.nom AS AutNom, 
        autor.cognoms AS AutCognom1, 
        book.titol, 
        book.any, 
        autor.slug AS autorSlug, 
        book.slug AS bookSlug, 
        img.nameImg, 
        img.alt, 
        lang.idioma_es AS lang, 
        book.id, 
        t.genere_es AS genere,
        topic.sub_genere_es AS tema
    FROM 08_db_biblioteca_llibres AS book 
    LEFT JOIN 08_db_biblioteca_autors AS autor ON book.autor = autor.id 
    LEFT JOIN db_img AS img ON book.img = img.id 
    LEFT JOIN aux_idiomes AS lang ON book.lang = lang.id
    LEFT JOIN 08_aux_biblioteca_generes_literaris AS t ON book.idGen = t.id
    LEFT JOIN 08_aux_biblioteca_sub_generes_literaris AS topic ON book.subGen = topic.id
    GROUP BY book.id
    ORDER BY book.titol ASC;";
    } else if ($lang === "it") {
        $query = "SELECT 
        autor.id AS idAuthor, 
        autor.nom AS AutNom, 
        autor.cognoms AS AutCognom1, 
        book.titol, 
        book.any, 
        autor.slug AS autorSlug, 
        book.slug AS bookSlug, 
        img.nameImg, 
        img.alt, 
        lang.idioma_it AS lang, 
        book.id, 
        t.genere_it AS genere,
        topic.sub_genere_it AS tema
    FROM 08_db_biblioteca_llibres AS book 
    LEFT JOIN 08_db_biblioteca_autors AS autor ON book.autor = autor.id 
    LEFT JOIN db_img AS img ON book.img = img.id 
    LEFT JOIN aux_idiomes AS lang ON book.lang = lang.id
    LEFT JOIN 08_aux_biblioteca_generes_literaris AS t ON book.idGen = t.id
    LEFT JOIN 08_aux_biblioteca_sub_generes_literaris AS topic ON book.subGen = topic.id
    GROUP BY book.id
    ORDER BY book.titol ASC;";
    }

                 // Preparar la consulta
                $stmt = $conn->prepare($query);
                
                // Ejecutar la consulta
                $stmt->execute();
                
                // Verificar si se encontraron resultados
                if ($stmt->rowCount() === 0) {
                    echo json_encode(['error' => 'No rows found']);
                    exit;
                }

                // Recopilar los resultados
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                // Establecer el encabezado de respuesta a JSON
                header('Content-Type: application/json');
                
                // Devolver los datos en formato JSON
                echo json_encode($data);

} elseif  (isset($_GET['type']) && $_GET['type'] == 'autorDetalls' && isset($_GET['slug']) && isset($_GET['lang'])) {
            global $conn;
            $slug = $_GET['slug'];
            $lang = $_GET['lang'];

            if ($lang === "ca") {
                $query = "SELECT a.id, a.nom AS AutNom, a.cognoms AS AutCognom1, a.yearBorn, a.yearDie, a.img, a.AutWikipedia, a.AutDescrip, a.dateModified, a.dateCreated, c.pais_cat AS nomPais, c.id AS idPais, m.moviment_ca AS nomMov, m.id AS idMov, o.professio_ca AS nameOc, i.nameImg, i.alt
                FROM 08_db_biblioteca_autors AS a
                INNER JOIN db_countries AS c ON a.paisAutor = c.id
                INNER JOIN 08_aux_biblioteca_moviments AS m ON a.moviment = m.id
                INNER JOIN aux_professions AS o ON a.ocupacio = o.id
                LEFT JOIN db_img AS i ON a.img = i.id
                WHERE a.slug = :slug";
            } elseif ($lang === "es") {
                $query = "SELECT a.id, a.nom AS AutNom, a.cognoms AS AutCognom1, a.yearBorn, a.yearDie, a.img, a.AutWikipedia, a.AutDescrip, a.dateModified, a.dateCreated, c.pais_es AS nomPais, c.id AS idPais, m.moviment_es AS nomMov, m.id AS idMov, o.professio_es AS nameOc, i.nameImg, i.alt
                FROM 08_db_biblioteca_autors AS a
                INNER JOIN db_countries AS c ON a.paisAutor = c.id
                INNER JOIN 08_aux_biblioteca_moviments AS m ON a.moviment = m.id
                INNER JOIN aux_professions AS o ON a.ocupacio = o.id
                LEFT JOIN db_img AS i ON a.img = i.id
                WHERE a.slug = :slug";

            } elseif ($lang === "en") {
                $query = "SELECT a.id, a.nom AS AutNom, a.cognoms AS AutCognom1, a.yearBorn, a.yearDie, a.img, a.AutWikipedia, a.AutDescrip, a.dateModified, a.dateCreated, c.country AS nomPais, c.id AS idPais, m.movement AS nomMov, m.id AS idMov, o.professio_en AS nameOc, i.nameImg, i.alt
                FROM 08_db_biblioteca_autors AS a
                INNER JOIN db_countries AS c ON a.paisAutor = c.id
                INNER JOIN 08_aux_biblioteca_moviments AS m ON a.moviment = m.id
                INNER JOIN aux_professions AS o ON a.ocupacio = o.id
                LEFT JOIN db_img AS i ON a.img = i.id
                WHERE a.slug = :slug";
            } elseif ($lang === "fr") {
                $query = "SELECT a.id, a.nom AS AutNom, a.cognoms AS AutCognom1, a.yearBorn, a.yearDie, a.img, a.AutWikipedia, a.AutDescrip, a.dateModified, a.dateCreated, c.pais_fr AS nomPais, c.id AS idPais, m.moviment_fr AS nomMov, m.id AS idMov, o.professio_fr AS nameOc, i.nameImg, i.alt
                FROM 08_db_biblioteca_autors AS a
                INNER JOIN db_countries AS c ON a.paisAutor = c.id
                INNER JOIN 08_aux_biblioteca_moviments AS m ON a.moviment = m.id
                INNER JOIN aux_professions AS o ON a.ocupacio = o.id
                LEFT JOIN db_img AS i ON a.img = i.id
                WHERE a.slug = :slug";
            } elseif ($lang === "it") {
                $query = "SELECT a.id, a.nom AS AutNom, a.cognoms AS AutCognom1, a.yearBorn, a.yearDie, a.img, a.AutWikipedia, a.AutDescrip, a.dateModified, a.dateCreated, c.pais_it AS nomPais, c.id AS idPais, m.moviment_it AS nomMov, m.id AS idMov, o.professio_it AS nameOc, i.nameImg, i.alt
                FROM 08_db_biblioteca_autors AS a
                INNER JOIN db_countries AS c ON a.paisAutor = c.id
                INNER JOIN 08_aux_biblioteca_moviments AS m ON a.moviment = m.id
                INNER JOIN aux_professions AS o ON a.ocupacio = o.id
                LEFT JOIN db_img AS i ON a.img = i.id
                WHERE a.slug = :slug";
            }

                 // Preparar la consulta
                 $stmt = $conn->prepare($query);

                // Vincular el valor del parámetro id de forma segura
                 $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
                
                 // Ejecutar la consulta
                 $stmt->execute();
                 
                 // Verificar si se encontraron resultados
                 if ($stmt->rowCount() === 0) {
                     echo json_encode(['error' => 'No rows found']);
                     exit;
                 }
 
                 // Recopilar los resultados
                 $data = $stmt->fetch(PDO::FETCH_ASSOC);
                 
                 // Establecer el encabezado de respuesta a JSON
                 header('Content-Type: application/json');
                 
                 // Devolver los datos en formato JSON
                 echo json_encode($data);

} elseif (isset($_GET['type']) && $_GET['type'] == 'totsAutors' && isset($_GET['lang'])) {
          
                $lang = $_GET['lang'];
                global $conn;
            
                if ($lang === "ca") {
                    $query = "SELECT a.id, a.nom, a.cognoms, a.yearBorn, a.yearDie, c.pais_cat AS pais, a.slug AS autorSlug, o.professio_ca AS professio, i.nameImg
                    FROM 08_db_biblioteca_autors AS a
                    INNER JOIN db_countries AS c ON a.paisAutor = c.id
                    INNER JOIN aux_professions AS o ON a.ocupacio = o.id
                    LEFT JOIN db_img AS i ON a.img = i.id
                    ORDER BY a.cognoms ASC;";
                } else if ($lang === "en") {
                    $query = "SELECT a.id, a.nom, a.cognoms, a.yearBorn, a.yearDie, c.country AS pais, a.slug AS autorSlug, o.professio_en AS professio, i.nameImg
                    FROM 08_db_biblioteca_autors AS a
                    INNER JOIN db_countries AS c ON a.paisAutor = c.id
                    INNER JOIN aux_professions AS o ON a.ocupacio = o.id
                    LEFT JOIN db_img AS i ON a.img = i.id
                    ORDER BY a.cognoms ASC;";
                } else if ($lang === "es") {
                    $query = "SELECT a.id, a.nom, a.cognoms, a.yearBorn, a.yearDie, c.pais_es AS pais, a.slug AS autorSlug, o.professio_es AS professio, i.nameImg
                    FROM 08_db_biblioteca_autors AS a
                    INNER JOIN db_countries AS c ON a.paisAutor = c.id
                    INNER JOIN aux_professions AS o ON a.ocupacio = o.id
                    LEFT JOIN db_img AS i ON a.img = i.id
                    ORDER BY a.cognoms ASC;";
                } else if ($lang === "it") {
                    $query = "SELECT a.id, a.nom, a.cognoms, a.yearBorn, a.yearDie, c.pais_it AS pais, a.slug AS autorSlug, o.professio_it AS professio, i.nameImg
                    FROM 08_db_biblioteca_autors AS a
                    INNER JOIN db_countries AS c ON a.paisAutor = c.id
                    INNER JOIN aux_professions AS o ON a.ocupacio = o.id
                    LEFT JOIN db_img AS i ON a.img = i.id
                    ORDER BY a.cognoms ASC;";
                } else if ($lang === "fr") {
                    $query = "SELECT a.id, a.nom, a.cognoms, a.yearBorn, a.yearDie, c.pais_fr AS pais, a.slug AS autorSlug, o.professio_fr AS professio, i.nameImg
                    FROM 08_db_biblioteca_autors AS a
                    INNER JOIN db_countries AS c ON a.paisAutor = c.id
                    INNER JOIN aux_professions AS o ON a.ocupacio = o.id
                    LEFT JOIN db_img AS i ON a.img = i.id
                    ORDER BY a.cognoms ASC;";
                }
                    
                // Preparar la consulta
                $stmt = $conn->prepare($query);
                
                // Ejecutar la consulta
                $stmt->execute();
                
                // Verificar si se encontraron resultados
                if ($stmt->rowCount() === 0) {
                    echo json_encode(['error' => 'No rows found']);
                    exit;
                }

                // Recopilar los resultados
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                // Establecer el encabezado de respuesta a JSON
                header('Content-Type: application/json');
                
                // Devolver los datos en formato JSON
                echo json_encode($data);

// 2) ruta per treure la informació de tots els llibres
// RUTA: https://api.elliotfern.com/book.php?type=autorsLlibres&id=3
} elseif (isset($_GET['type']) && $_GET['type'] == 'autorsLlibres' && isset($_GET['id'])) {
    $id = $_GET['id'];
    global $conn;

    $query = "SELECT b.id, b.any, b.titol, b.slug
        FROM 08_db_biblioteca_llibres AS b
        WHERE b.autor = :id
        ORDER BY b.any ASC";

       // Preparar la consulta
       $stmt = $conn->prepare($query);

       // Vincular el valor del parámetro id de forma segura
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
       
        // Ejecutar la consulta
        $stmt->execute();

        // Verificar si se encontraron resultados
        if ($stmt->rowCount() === 0) {
            echo json_encode(['error' => 'No rows found']);
            exit;
        }

        // Recopilar los resultados
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Establecer el encabezado de respuesta a JSON
        header('Content-Type: application/json');
        
        // Devolver los datos en formato JSON
        echo json_encode($data);

} else {
    echo "error";
}

