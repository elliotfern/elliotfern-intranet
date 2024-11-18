<?php
require_once( 'connection.php');

// JSON of Links > all categories
if ( (isset($_GET['type']) && $_GET['type'] == 'blogArticle') && (isset($_GET['paramName']) ) ) {
    global $conn;
    $slug = $_GET['paramName'];
    $data = array();

    // Consulta preparada con parámetros seguros
    $stmt = $conn->prepare(
        "SELECT ID, post_title, post_content, post_date, post_modified, post_name
        FROM epgylzqu_historia_web.xfr_posts
        WHERE post_name = :slug"
    );

    // Asignamos el valor del parámetro de manera segura
    $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
    $stmt->execute();

    // Verificamos si hay filas devueltas
    if ($stmt->rowCount() === 0) {
        echo ('No rows');
    } else {
        while ($users = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $users;
        }
        // Convertimos el array a formato JSON
        echo json_encode($data);
    }

}  elseif (isset($_GET['type']) && $_GET['type'] == 'blog') {
        global $conn;
        
        $sql = "SELECT p.ID, p.post_title, p.post_content, p.post_date, p.post_name
        FROM epgylzqu_historia_web.xfr_posts AS p
        LEFT JOIN epgylzqu_historia_web.posts_lang AS pl_ca ON p.ID = pl_ca.ca
        LEFT JOIN epgylzqu_historia_web.posts_lang AS pl_es ON p.ID = pl_es.es
        LEFT JOIN epgylzqu_historia_web.posts_lang AS pl_fr ON p.ID = pl_fr.fr
        LEFT JOIN epgylzqu_historia_web.posts_lang AS pl_en ON p.ID = pl_en.en
        LEFT JOIN epgylzqu_historia_web.posts_lang AS pl_it ON p.ID = pl_it.it
        WHERE pl_ca.ca IS NULL
        AND pl_es.es IS NULL
        AND pl_fr.fr IS NULL
        AND pl_en.en IS NULL
        AND pl_it.it IS NULL
        AND p.post_status = 'publish'
        AND p.post_type = 'post'
        ORDER BY p.post_date DESC";

        $stmt = $conn->prepare($sql);
        
        // Ejecutar la consulta con el parámetro preparado
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

}  elseif (isset($_GET['type']) && $_GET['type'] == 'llistatCursos' && isset($_GET['langCurso'])) {
    global $conn;
    $slug = $_GET['langCurso'];
    
    if ($slug === "ca") {
        $sql = "SELECT id,
        ordre,
        nameCa AS nombreCurso,
        resumenCa AS resumen,
        img,
        paramNameCa AS paramName
        FROM db_openhistory_courses 
        ORDER BY ordre ASC";
    } else if ($slug === "en") {
        $sql = "SELECT id,
        ordre,
        nameEn AS nombreCurso,
        resumenEn AS resumen,
        img,
        paramNameEn AS paramName
        FROM db_openhistory_courses 
        ORDER BY ordre ASC";
      } else if ($slug === "es") {
        $sql = "SELECT id,
        ordre,
        nameEs AS nombreCurso,
        resumenEs AS resumen,
        img,
        paramNameEs AS paramName
        FROM db_openhistory_courses 
        ORDER BY ordre ASC";
      } else if ($slug === "fr") {
        $sql = "SELECT id,
        ordre,
        nameFr AS nombreCurso,
        resumenFr AS resumen,
        img,
        paramNameFr AS paramName
        FROM db_openhistory_courses 
        ORDER BY ordre ASC";
      } else if ($slug === "it") {
        $sql = "SELECT id,
        ordre,
        nameIt AS nombreCurso,
        resumenIt AS resumen,
        img,
        paramNameIt AS paramName
        FROM db_openhistory_courses 
        ORDER BY ordre ASC";
     }

    $stmt = $conn->prepare($sql);
    
    // Ejecutar la consulta con el parámetro preparado
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

} elseif (isset($_GET['type']) && $_GET['type'] == 'curso' && isset($_GET['paramName']) && isset($_GET['langCurso'])) {
    // Aquí puedes obtener los valores de los parámetros
    $paramName = $_GET['paramName'];
    $lang = $_GET['langCurso'];

    if ($lang === "ca") {
        $query = "SELECT p.ID, p.post_title, p.post_date, p.post_name, c.nameCa AS courseName, c.descripCa AS courseDescription, c.id AS cursId
        FROM epgylzqu_elliotfern_intranet.db_openhistory_courses AS c
        LEFT JOIN epgylzqu_historia_web.posts_lang AS l ON c.id = l.curs
        LEFT JOIN epgylzqu_historia_web.xfr_posts AS p ON p.ID = l.ca
        WHERE c.paramNameCa = :param
        ORDER BY l.ordre ASC";
    } else if ($lang === "en") {
        $query = "SELECT p.ID, p.post_title, p.post_date, p.post_name, c.nameEn AS courseName, c.descripEn AS courseDescription, c.id AS cursId
        FROM epgylzqu_elliotfern_intranet.db_openhistory_courses AS c
        LEFT JOIN epgylzqu_historia_web.posts_lang AS l ON c.id = l.curs
        LEFT JOIN epgylzqu_historia_web.xfr_posts AS p ON p.ID = l.en
        WHERE c.paramNameEn = :param
        ORDER BY l.ordre ASC;";
    } else if ($lang === "fr") {
        $query = "SELECT p.ID, p.post_title, p.post_date, p.post_name, c.nameFr AS courseName, c.descripFr AS courseDescription, c.id AS cursId
        FROM epgylzqu_elliotfern_intranet.db_openhistory_courses AS c
        LEFT JOIN epgylzqu_historia_web.posts_lang AS l ON c.id = l.curs
        LEFT JOIN epgylzqu_historia_web.xfr_posts AS p ON p.ID = l.fr
        WHERE c.paramNameFr = :param
        ORDER BY l.ordre ASC;";
    } else if ($lang === "es") {
        $query = "SELECT p.ID, p.post_title, p.post_date, p.post_name, c.nameEs AS courseName, c.descripEs AS courseDescription, c.id AS cursId
        FROM epgylzqu_elliotfern_intranet.db_openhistory_courses AS c
        LEFT JOIN epgylzqu_historia_web.posts_lang AS l ON c.id = l.curs
        LEFT JOIN epgylzqu_historia_web.xfr_posts AS p ON p.ID = l.es
        WHERE c.paramNameEs = :param
        ORDER BY l.ordre ASC;";
    } else if ($lang === "it") {
        $query = "SELECT p.ID, p.post_title, p.post_date, p.post_name, c.nameIt AS courseName, c.descripIt AS courseDescription, c.id AS cursId
        FROM epgylzqu_elliotfern_intranet.db_openhistory_courses AS c
        LEFT JOIN epgylzqu_historia_web.posts_lang AS l ON c.id = l.curs
        LEFT JOIN epgylzqu_historia_web.xfr_posts AS p ON p.ID = l.it
        WHERE c.paramNameIt = :param
        ORDER BY l.ordre ASC;";
    }
  
    global $conn;
        
            // Preparar la consulta
            $stmt = $conn->prepare($query);

            // Vincular los parámetros
            $stmt->bindParam(':param', $paramName);
            
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
     
    } elseif (isset($_GET['type']) && $_GET['type'] == 'articleName' && isset($_GET['paramName'])) {

        // Aquí puedes obtener los valores de los parámetros
        $name = $_GET['paramName'];

        global $conn;

        $query = "SELECT p.ID, p.post_title, p.post_date, p.post_content, p.post_excerpt, p.post_modified
        FROM epgylzqu_historia_web.xfr_posts AS p
        WHERE p.post_name = :param";
        
        // Preparar la consulta
        $stmt = $conn->prepare($query);

        // Vincular los parámetros
        $stmt->bindParam(':param', $name);
        
        // Ejecutar la consulta
        $stmt->execute();
        
        // Verificar si se encontraron resultados
        if ($stmt->rowCount() === 0) {
            echo json_encode(['error' => 'No rows found']);
            exit;
        }

        // Recopilar el resultado (solo uno)
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        // Establecer el encabezado de respuesta a JSON
        header('Content-Type: application/json');

        // Devolver los datos en formato JSON (como objeto, no array)
        echo json_encode($data);
    
    } elseif (isset($_GET['type']) && $_GET['type'] == 'articleId' && isset($_GET['id'])) {

        // Aquí puedes obtener los valores de los parámetros
        $id = $_GET['id'];

        global $conn;

        $query = "SELECT p.ID, p.post_title, p.post_date, p.post_content, p.post_excerpt, p.post_modified
        FROM epgylzqu_historia_web.xfr_posts AS p
        WHERE p.ID = :param";
        
        // Preparar la consulta
        $stmt = $conn->prepare($query);

        // Vincular los parámetros
        $stmt->bindParam(':param', $id);
        
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


    } elseif (isset($_GET['type']) && $_GET['type'] == 'arxiuArticles' && isset($_GET['lang'])) {

        // Aquí puedes obtener los valores de los parámetros
        $lang = $_GET['lang'];

        global $conn;

        if ($lang === "ca") {
            $query = "SELECT p.ID, p.post_title, p.post_name, c.nameCa AS cursName, c.paramNameCa AS cursParam
            FROM epgylzqu_historia_web.posts_lang AS l
            INNER JOIN epgylzqu_historia_web.xfr_posts AS p ON l.ca = p.ID
            INNER JOIN epgylzqu_elliotfern_intranet.db_openhistory_courses AS c ON l.curs = c.id
            GROUP BY p.id
            ORDER BY l.curs ASC, l.ordre ASC;";
        } else if ($lang === "en") {
            $query = "SELECT p.ID, p.post_title, p.post_name, c.nameEn AS cursName, c.paramNameEn AS cursParam
            FROM epgylzqu_historia_web.posts_lang AS l
            INNER JOIN epgylzqu_historia_web.xfr_posts AS p ON l.en = p.ID
            INNER JOIN epgylzqu_elliotfern_intranet.db_openhistory_courses AS c ON l.curs = c.id
            GROUP BY p.id
            ORDER BY l.curs ASC, l.ordre ASC;";
        } else if ($lang === "fr") {
            $query = "SELECT p.ID, p.post_title, p.post_name, c.nameFr AS cursName, c.paramNameFr AS cursParam
            FROM epgylzqu_historia_web.posts_lang AS l
            INNER JOIN epgylzqu_historia_web.xfr_posts AS p ON l.fr = p.ID
            INNER JOIN epgylzqu_elliotfern_intranet.db_openhistory_courses AS c ON l.curs = c.id
            GROUP BY p.id
            ORDER BY l.curs ASC, l.ordre ASC;";
        } else if ($lang === "es") {
            $query = "SELECT p.ID, p.post_title, p.post_name, c.nameEs AS cursName, c.paramNameEs AS cursParam
            FROM epgylzqu_historia_web.posts_lang AS l
            INNER JOIN epgylzqu_historia_web.xfr_posts AS p ON l.es = p.ID
            INNER JOIN epgylzqu_elliotfern_intranet.db_openhistory_courses AS c ON l.curs = c.id
            GROUP BY p.id
            ORDER BY l.curs ASC, l.ordre ASC;";
        } else if ($lang === "it") {
            $query = "SELECT p.ID, p.post_title, p.post_name, c.nameIt AS cursName, c.paramNameIt AS cursParam
            FROM epgylzqu_historia_web.posts_lang AS l
            INNER JOIN epgylzqu_historia_web.xfr_posts AS p ON l.it = p.ID
            INNER JOIN epgylzqu_elliotfern_intranet.db_openhistory_courses AS c ON l.curs = c.id
            GROUP BY p.id
            ORDER BY l.curs ASC, l.ordre ASC;";
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

    } elseif (isset($_GET['type']) && $_GET['type'] == 'links' && isset($_GET['lang'])) {

        // Aquí puedes obtener los valores de los parámetros
        $lang = $_GET['lang'];

        global $conn;

        if ($lang === "ca") {
            $query = "SELECT l.id, l.nom, l.web, ca.categoria_ca AS categoria, t.type_ca AS tipus, l.linkCreated, l.linkUpdated, tema.tema_ca AS tema, i.idioma_ca AS idioma
            FROM epgylzqu_elliotfern_intranet.db_links AS l
            INNER JOIN epgylzqu_elliotfern_intranet.aux_temes AS tema ON tema.id = l.cat
            INNER JOIN epgylzqu_elliotfern_intranet.aux_categories AS ca ON tema.idGenere = ca.id
            LEFT JOIN epgylzqu_elliotfern_intranet.db_links_type AS t ON t.id = l.tipus
            LEFT JOIN epgylzqu_elliotfern_intranet.aux_idiomes AS i ON l.lang = i.id
            ORDER BY l.nom ASC;";
        } elseif ($lang === "es") {
            $query = "SELECT l.id, l.nom, l.web, ca.categoria_es AS categoria, t.type_es AS tipus, l.linkCreated, l.linkUpdated, tema.tema_es AS tema, i.idioma_es AS idioma
            FROM epgylzqu_elliotfern_intranet.db_links AS l
            INNER JOIN epgylzqu_elliotfern_intranet.aux_temes AS tema ON tema.id = l.cat
            INNER JOIN epgylzqu_elliotfern_intranet.aux_categories AS ca ON tema.idGenere = ca.id
            LEFT JOIN epgylzqu_elliotfern_intranet.db_links_type AS t ON t.id = l.tipus
            LEFT JOIN epgylzqu_elliotfern_intranet.aux_idiomes AS i ON l.lang = i.id
            ORDER BY l.nom ASC;";
        } elseif ($lang === "en") {
            $query = "SELECT l.id, l.nom, l.web, ca.categoria_en AS categoria, t.type_en AS tipus, l.linkCreated, l.linkUpdated, tema.tema_en AS tema, i.idioma_en AS idioma
            FROM epgylzqu_elliotfern_intranet.db_links AS l
            INNER JOIN epgylzqu_elliotfern_intranet.aux_temes AS tema ON tema.id = l.cat
            INNER JOIN epgylzqu_elliotfern_intranet.aux_categories AS ca ON tema.idGenere = ca.id
            LEFT JOIN epgylzqu_elliotfern_intranet.db_links_type AS t ON t.id = l.tipus
            LEFT JOIN epgylzqu_elliotfern_intranet.aux_idiomes AS i ON l.lang = i.id
            ORDER BY l.nom ASC;";
        } elseif ($lang === "fr") {
            $query = "SELECT l.id, l.nom, l.web, ca.categoria_fr AS categoria, t.type_fr AS tipus, l.linkCreated, l.linkUpdated, tema.tema_fr AS tema, i.idioma_fr AS idioma
            FROM epgylzqu_elliotfern_intranet.db_links AS l
            INNER JOIN epgylzqu_elliotfern_intranet.aux_temes AS tema ON tema.id = l.cat
            INNER JOIN epgylzqu_elliotfern_intranet.aux_categories AS ca ON tema.idGenere = ca.id
            LEFT JOIN epgylzqu_elliotfern_intranet.db_links_type AS t ON t.id = l.tipus
            LEFT JOIN epgylzqu_elliotfern_intranet.aux_idiomes AS i ON l.lang = i.id
            ORDER BY l.nom ASC;";
        } elseif ($lang === "it") {
            $query = "SELECT l.id, l.nom, l.web, ca.categoria_it AS categoria, t.type_it AS tipus, l.linkCreated, l.linkUpdated, tema.tema_it AS tema, i.idioma_it AS idioma
            FROM epgylzqu_elliotfern_intranet.db_links AS l
            INNER JOIN epgylzqu_elliotfern_intranet.aux_temes AS tema ON tema.id = l.cat
            INNER JOIN epgylzqu_elliotfern_intranet.aux_categories AS ca ON tema.idGenere = ca.id
            LEFT JOIN epgylzqu_elliotfern_intranet.db_links_type AS t ON t.id = l.tipus
            LEFT JOIN epgylzqu_elliotfern_intranet.aux_idiomes AS i ON l.lang = i.id
            ORDER BY l.nom ASC;";
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
    
} elseif (isset($_GET['type']) && $_GET['type'] == 'llistatArticlesCurs' && isset($_GET['lang']) && isset($_GET['id'])) {

    // Aquí puedes obtener los valores de los parámetros
    $lang = $_GET['lang'];
    $id = $_GET['id'];

    global $conn;

    if ($lang === "ca") {
        $query = "SELECT 
            courses.nameCa AS curso_titulo,
            posts.post_title AS articulo_titulo,
            posts.post_name AS articulo_url,
            courses.paramNameCa as curso_url
        FROM epgylzqu_elliotfern_intranet.db_openhistory_courses AS courses
        JOIN epgylzqu_historia_web.posts_lang AS articles ON courses.id = articles.curs
        JOIN epgylzqu_historia_web.xfr_posts AS posts ON articles.ca = posts.ID
        WHERE 
            articles.curs = (
                SELECT curs
                FROM epgylzqu_historia_web.posts_lang AS articles
                WHERE ca = :param
            )
        ORDER BY 
            articles.ordre";
    } elseif ($lang === "es") {
        $query = "SELECT 
        courses.nameEs AS curso_titulo,
        posts.post_title AS articulo_titulo,
        posts.post_name AS articulo_url,
        courses.paramNameEs as curso_url
    FROM epgylzqu_elliotfern_intranet.db_openhistory_courses AS courses
    JOIN epgylzqu_historia_web.posts_lang AS articles ON courses.id = articles.curs
    JOIN epgylzqu_historia_web.xfr_posts AS posts ON articles.es = posts.ID
    WHERE 
        articles.curs= (
            SELECT curs
            FROM epgylzqu_historia_web.posts_lang AS articles
            WHERE es = :param
        )
    ORDER BY 
        articles.ordre";
    } elseif ($lang === "en") {
        $query = "SELECT 
        courses.nameEn AS curso_titulo,
        posts.post_title AS articulo_titulo,
        posts.post_name AS articulo_url,
        courses.paramNameEn as curso_url
    FROM epgylzqu_elliotfern_intranet.db_openhistory_courses AS courses
    JOIN epgylzqu_historia_web.posts_lang AS articles ON courses.id = articles.curs
    JOIN epgylzqu_historia_web.xfr_posts AS posts ON articles.en = posts.ID
    WHERE 
        articles.curs = (
            SELECT curs
            FROM epgylzqu_historia_web.posts_lang AS articles 
            WHERE en = :param
        )
    ORDER BY 
        articles.ordre";
    } elseif ($lang === "fr") {
        $query = "SELECT 
        courses.nameFr AS curso_titulo,
        posts.post_title AS articulo_titulo,
        posts.post_name AS articulo_url,
        courses.paramNameFr as curso_url
    FROM epgylzqu_elliotfern_intranet.db_openhistory_courses AS courses
    JOIN epgylzqu_historia_web.posts_lang AS articles ON courses.id = articles.curs
    JOIN epgylzqu_historia_web.xfr_posts AS posts ON articles.fr = posts.ID
    WHERE 
        articles.curs = (
            SELECT curs
            FROM epgylzqu_historia_web.posts_lang AS articles
            WHERE fr = :param
        )
    ORDER BY 
        articles.ordre";
    } elseif ($lang === "it" ) {
        $query = "SELECT 
        courses.nameIt AS curso_titulo,
        posts.post_title AS articulo_titulo,
        posts.post_name AS articulo_url,
        courses.paramNameIt as curso_url
    FROM epgylzqu_elliotfern_intranet.db_openhistory_courses AS courses
    JOIN epgylzqu_historia_web.posts_lang AS articles ON courses.id = articles.curs
    JOIN epgylzqu_historia_web.xfr_posts AS posts ON articles.it = posts.ID
    WHERE 
        articles.curs = (
            SELECT curs
            FROM epgylzqu_historia_web.posts_lang AS articles
            WHERE it = :param
        )
    ORDER BY 
        articles.ordre";
    }

    // Preparar la consulta
    $stmt = $conn->prepare($query);

    // Vincular los parámetros
    $stmt->bindParam(':param', $id);
        
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

} elseif (isset($_GET['type']) && $_GET['type'] == 'articleIdiomes' && isset($_GET['lang']) && isset($_GET['id'])) {

    // Aquí puedes obtener los valores de los parámetros
    $lang = $_GET['lang'];
    $id = $_GET['id'];

    global $conn;

    if ($lang === "ca") {
        $query = "SELECT l.es, l.fr, l.en, l.it,
        pEs.post_title AS post_titleEs,
        pEs.post_name AS post_nameEs,
        pEn.post_title AS post_titleEn,
        pEn.post_name AS post_nameEn,
        pFr.post_title AS post_titleFr,
        pFr.post_name AS post_nameFr,
        pIt.post_title AS post_titleIt,
        pIt.post_name AS post_nameIt,
        pCa.post_title AS post_titleCa,
        pCa.post_name AS post_nameCa
        FROM epgylzqu_historia_web.posts_lang AS l
        LEFT JOIN epgylzqu_historia_web.xfr_posts AS pEs ON l.es = pEs.ID
        LEFT JOIN epgylzqu_historia_web.xfr_posts AS pEn ON l.en = pEn.ID
        LEFT JOIN epgylzqu_historia_web.xfr_posts AS pFr ON l.fr = pFr.ID
        LEFT JOIN epgylzqu_historia_web.xfr_posts AS pIt ON l.it = pIt.ID
        LEFT JOIN epgylzqu_historia_web.xfr_posts AS pCa ON l.ca = pCa.ID
        WHERE l.ca = :param";
    } elseif ($lang === "es") {
        $query = "SELECT l.es, l.fr, l.en, l.it,
        pEs.post_title AS post_titleEs,
        pEs.post_name AS post_nameEs,
        pEn.post_title AS post_titleEn,
        pEn.post_name AS post_nameEn,
        pFr.post_title AS post_titleFr,
        pFr.post_name AS post_nameFr,
        pIt.post_title AS post_titleIt,
        pIt.post_name AS post_nameIt,
        pCa.post_title AS post_titleCa,
        pCa.post_name AS post_nameCa
        FROM epgylzqu_historia_web.posts_lang AS l
        LEFT JOIN epgylzqu_historia_web.xfr_posts AS pEs ON l.es = pEs.ID
        LEFT JOIN epgylzqu_historia_web.xfr_posts AS pEn ON l.en = pEn.ID
        LEFT JOIN epgylzqu_historia_web.xfr_posts AS pFr ON l.fr = pFr.ID
        LEFT JOIN epgylzqu_historia_web.xfr_posts AS pIt ON l.it = pIt.ID
        LEFT JOIN epgylzqu_historia_web.xfr_posts AS pCa ON l.ca = pCa.ID
        WHERE l.es = :param";
    } elseif ($lang === "en") {
        $query = "SELECT l.es, l.fr, l.en, l.it,
        pEs.post_title AS post_titleEs,
        pEs.post_name AS post_nameEs,
        pEn.post_title AS post_titleEn,
        pEn.post_name AS post_nameEn,
        pFr.post_title AS post_titleFr,
        pFr.post_name AS post_nameFr,
        pIt.post_title AS post_titleIt,
        pIt.post_name AS post_nameIt,
        pCa.post_title AS post_titleCa,
        pCa.post_name AS post_nameCa
        FROM epgylzqu_historia_web.posts_lang AS l
        LEFT JOIN epgylzqu_historia_web.xfr_posts AS pEs ON l.es = pEs.ID
        LEFT JOIN epgylzqu_historia_web.xfr_posts AS pEn ON l.en = pEn.ID
        LEFT JOIN epgylzqu_historia_web.xfr_posts AS pFr ON l.fr = pFr.ID
        LEFT JOIN epgylzqu_historia_web.xfr_posts AS pIt ON l.it = pIt.ID
        LEFT JOIN epgylzqu_historia_web.xfr_posts AS pCa ON l.ca = pCa.ID
        WHERE l.en = :param";
    } elseif ($lang === "fr") {
        $query = "SELECT l.es, l.fr, l.en, l.it,
        pEs.post_title AS post_titleEs,
        pEs.post_name AS post_nameEs,
        pEn.post_title AS post_titleEn,
        pEn.post_name AS post_nameEn,
        pFr.post_title AS post_titleFr,
        pFr.post_name AS post_nameFr,
        pIt.post_title AS post_titleIt,
        pIt.post_name AS post_nameIt,
        pCa.post_title AS post_titleCa,
        pCa.post_name AS post_nameCa
        FROM epgylzqu_historia_web.posts_lang AS l
        LEFT JOIN epgylzqu_historia_web.xfr_posts AS pEs ON l.es = pEs.ID
        LEFT JOIN epgylzqu_historia_web.xfr_posts AS pEn ON l.en = pEn.ID
        LEFT JOIN epgylzqu_historia_web.xfr_posts AS pFr ON l.fr = pFr.ID
        LEFT JOIN epgylzqu_historia_web.xfr_posts AS pIt ON l.it = pIt.ID
        LEFT JOIN epgylzqu_historia_web.xfr_posts AS pCa ON l.ca = pCa.ID
        WHERE l.fr = :param";
    } elseif ($lang === "it" ) {
        $query = "SELECT l.es, l.fr, l.en, l.it,
        pEs.post_title AS post_titleEs,
        pEs.post_name AS post_nameEs,
        pEn.post_title AS post_titleEn,
        pEn.post_name AS post_nameEn,
        pFr.post_title AS post_titleFr,
        pFr.post_name AS post_nameFr,
        pIt.post_title AS post_titleIt,
        pIt.post_name AS post_nameIt,
        pCa.post_title AS post_titleCa,
        pCa.post_name AS post_nameCa
        FROM epgylzqu_historia_web.posts_lang AS l
        LEFT JOIN epgylzqu_historia_web.xfr_posts AS pEs ON l.es = pEs.ID
        LEFT JOIN epgylzqu_historia_web.xfr_posts AS pEn ON l.en = pEn.ID
        LEFT JOIN epgylzqu_historia_web.xfr_posts AS pFr ON l.fr = pFr.ID
        LEFT JOIN epgylzqu_historia_web.xfr_posts AS pIt ON l.it = pIt.ID
        LEFT JOIN epgylzqu_historia_web.xfr_posts AS pCa ON l.ca = pCa.ID
        WHERE l.it = :param";
    }

    // Preparar la consulta
    $stmt = $conn->prepare($query);

    // Vincular los parámetros
    $stmt->bindParam(':param', $id);
        
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

} elseif (isset($_GET['type']) && $_GET['type'] == 'cursIdiomes' && isset($_GET['lang']) && isset($_GET['id'])) {

    // Aquí puedes obtener los valores de los parámetros
    $lang = $_GET['lang'];
    $id = $_GET['id'];

    global $conn;

        $query = "SELECT 
        c.paramNameEs AS post_nameEs,
        c.paramNameEn AS post_nameEn,
        c.paramNameFr AS post_nameFr,
        c.paramNameIt AS post_nameIt,
        c.paramNameCa AS post_nameCa
        FROM epgylzqu_elliotfern_intranet.db_openhistory_courses AS c
        WHERE c.id = :param";

    // Preparar la consulta
    $stmt = $conn->prepare($query);

    // Vincular los parámetros
    $stmt->bindParam(':param', $id);
        
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
}