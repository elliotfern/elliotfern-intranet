<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
$updatedPath = str_replace('/httpdocs', '', $rootDirectory);

require_once($updatedPath . '/pass/connection.php');

// JSON
if ( (isset($_GET['type']) && $_GET['type'] == 'user') && (isset($_GET['id']) ) ) {
    $id = $_GET['id'];
    global $conn;
    $data = array();
    $stmt = $conn->prepare(
        "SELECT u.firstName, u.lastName
        FROM db_users AS u
        WHERE u.id=$id");
        $stmt->execute();
        if($stmt->rowCount() === 0) echo ('No rows');
        while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $data[] = $users;
        }
    echo json_encode($data);

} elseif (isset($_GET['type']) && $_GET['type'] == 'get' ) {
  global $conn;
  $data = array();
  $stmt = $conn->prepare(
      "SELECT book.titol, book.titolEng, book.any, book.img, book.idEd, book.idGen, book.lang, book.nomAutor, book.tipus, book.id, a.id AS idAutor, a.AutCognom1, a.AutNom, g.genre AS nomGenEng, g.id AS idGenere, bc.nomCollection
      FROM db_library_books AS book
      INNER JOIN db_library_authors AS a ON book.nomAutor = a.id
      INNER JOIN db_library_genres AS g ON book.idGen = g.id
      LEFT JOIN  db_library_books_collection AS bookc ON book.id = bookc.idBook
      LEFT JOIN  db_library_collection AS bc ON bookc.idCollection = bc.id");
      $stmt->execute();
      if($stmt->rowCount() === 0) echo ('No rows');
      while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
          $data[] = $users;
      }
      
      echo json_encode(array('data'=>$data));

} elseif (isset($_GET['type']) && $_GET['type'] == 'library_authors' ) {
  global $conn;
  $data = array();
  $stmt = $conn->prepare(
      "SELECT a.id, a.AutCognom1, a.AutNom, p.country, a.yearBorn, a.yearDie, p.id AS idPais, o.name
      FROM db_library_authors AS a
      INNER JOIN db_countries AS p ON a.PaisAutor = p.id
      INNER JOIN db_persons_role AS o ON a.AutOcupacio = o.id");
      $stmt->execute();
      if($stmt->rowCount() === 0) echo ('No rows');
      while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
          $data[] = $users;
      }
      echo json_encode(array('data'=>$data));
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
  } elseif (isset($_GET['type']) && $_GET['type'] == 'accounting-customers' ) {
    global $conn;
    $data = array();
    $stmt = $conn->prepare(
        "SELECT c.id, c.clientNom, c.clientCognoms, c.clientEmail, c.clientWeb, c.clientNIF, c.clientEmpresa, c.clientAdreca, c.clientCiutat, c.clientCP, c.clientProvincia, c.clientPais, c.clientTelefon, c.clientRegistre, ci.city, co.country, cou.county, c.clientStatus, s.estatNom
        FROM db_accounting_hispantic_costumers AS c
        INNER JOIN db_cities AS ci ON c.clientCiutat = ci.id
        INNER JOIN db_countries AS co ON c.clientPais = co.id
        INNER JOIN db_countries_counties AS cou ON c.clientProvincia = cou.id
        INNER JOIN  db_accounting_hispantic_costumers_status AS s ON c.clientStatus = s.id
        ORDER BY c.clientRegistre DESC");
        $stmt->execute();
        if($stmt->rowCount() === 0) echo ('No rows');
        while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $data[] = $users;
        }
        echo json_encode($data);
    } elseif (isset($_GET['type']) && $_GET['type'] == 'accounting-customers-invoices' ) {
        global $conn;
        $data = array();
        $stmt = $conn->prepare(
            "SELECT ic.id, ic.idUser, ic.facConcepte, ic.facData, YEAR(ic.facData) AS yearInvoice,  ic.facDueDate, ic.facSubtotal, ic.facFees, ic.facTotal, ic.facVAT, ic.facIva, ic.facEstat, ic.facPaymentType, vt.ivaPercen, ist.estat, pt.tipusNom, c.clientNom, c.clientCognoms, c.clientEmpresa
            FROM db_accounting_hispantic_invoices_customers  AS ic
            INNER JOIN db_accounting_hispantic_vat_type AS vt ON ic.facIva = vt.id
            INNER JOIN  db_accounting_hispantic_invoices_status AS ist ON ist.id = ic.facEstat
            INNER JOIN db_accounting_hispantic_payment_type AS pt ON ic.facPaymentType = pt.id
            INNER JOIN db_accounting_hispantic_costumers AS c ON ic.idUser = c.id
            ORDER BY ic.id ASC");
            $stmt->execute();
            if($stmt->rowCount() === 0) echo ('No rows');
            while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                $data[] = $users;
            }
            echo json_encode($data);
        } elseif (isset($_GET['type']) && $_GET['type'] == 'accounting-elliotfernandez-customers-invoices' ) {
            global $conn;
            $data = array();
            $stmt = $conn->prepare(
                "SELECT ic.id, ic.idUser, ic.facConcepte, ic.facData, YEAR(ic.facData) AS yearInvoice,  ic.facDueDate, ic.facSubtotal, ic.facFees, ic.facTotal, ic.facVAT, ic.facIva, ic.facEstat, ic.facPaymentType, vt.ivaPercen, ist.estat, pt.tipusNom, c.clientNom, c.clientCognoms, c.clientEmpresa
                FROM db_accounting_soletrade_invoices_customers  AS ic
                LEFT JOIN db_accounting_hispantic_vat_type AS vt ON ic.facIva = vt.id
                LEFT JOIN db_accounting_hispantic_invoices_status AS ist ON ist.id = ic.facEstat
                LEFT JOIN db_accounting_hispantic_payment_type AS pt ON ic.facPaymentType = pt.id
                LEFT JOIN db_accounting_hispantic_costumers AS c ON ic.idUser = c.id
                ORDER BY ic.id DESC");
                $stmt->execute();
                if($stmt->rowCount() === 0) echo ('No rows');
                while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                    $data[] = $users;
                }
                echo json_encode($data);
        
            } elseif (isset($_GET['type']) && $_GET['type'] == 'accounting-elliotfernandez-supplies-invoices' ) {
                global $conn;
                $data = array();
                $stmt = $conn->prepare(
                    "SELECT s.id, s.facEmpresa, s.facConcepte, s.facData, s.facSubtotal, s.facImportIva, s.facTotal, s.facIva, s.facPagament, c.id AS idEmpresa, c.empresaNom, c.empresaNIF, c.empresaDireccio, co.country, vt.ivaPercen, pt.tipusNom, cos.clientEmpresa
                    FROM db_accounting_soletrade_invoices_suppliers AS s
                    INNER JOIN db_accounting_hispantic_supplier_companies as c ON s.facEmpresa = c.id
                    INNER JOIN db_countries AS co ON c.empresaPais = co.id
                    INNER JOIN db_accounting_hispantic_vat_type AS vt ON s.facIva = vt.id
                    INNER JOIN db_accounting_hispantic_payment_type AS pt ON s.facPagament = pt.id
                    LEFT JOIN db_accounting_hispantic_costumers AS cos ON s.clientVinculat = cos.id
                    ORDER BY s.facData DESC");
                    $stmt->execute();
                    if($stmt->rowCount() === 0) echo ('No rows');
                    while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                        $data[] = $users;
                    }
                    echo json_encode($data);
    
        } elseif ( (isset($_GET['type']) && $_GET['type'] == 'customers-invoices') && (isset($_GET['id']) ) ) {
                $id = $_GET['id'];
                global $conn;
                $data = array();
                $stmt = $conn->prepare(
                    "SELECT ic.id, ic.idUser, ic.facConcepte, ic.facData, YEAR(ic.facData) AS yearInvoice,  ic.facDueDate, ic.facSubtotal, ic.facFees, ic.facTotal, ic.facVAT, ic.facIva, ic.facEstat, ic.facPaymentType, vt.ivaPercen, ist.estat, pt.tipusNom, c.clientNom, c.clientCognoms, c.clientEmpresa, c.clientEmail, c.clientWeb, c.clientNIF, c.clientAdreca, ciu.city AS clientCiutat, pro.county AS clientProvincia, pa.country AS clientPais, c.clientCP
                    FROM db_accounting_soletrade_invoices_customers  AS ic
                    LEFT JOIN db_accounting_hispantic_vat_type AS vt ON ic.facIva = vt.id
                    LEFT JOIN db_accounting_hispantic_invoices_status AS ist ON ist.id = ic.facEstat
                    LEFT JOIN db_accounting_hispantic_payment_type AS pt ON ic.facPaymentType = pt.id
                    LEFT JOIN db_accounting_hispantic_costumers AS c ON ic.idUser = c.id
                    LEFT JOIN db_cities AS ciu ON ciu.id = c.clientCiutat
                    LEFT JOIN db_countries_counties AS pro ON pro.id = c.clientProvincia
                    LEFT JOIN db_countries AS pa ON pa.id = c.clientPais
                    WHERE ic.id = $id");
                    $stmt->execute();
                    if($stmt->rowCount() === 0) echo ('No rows');
                    while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                        $data[] = $users;
                    }
                    echo json_encode($data);
    } elseif ( (isset($_GET['type']) && $_GET['type'] == 'invoice-products') && (isset($_GET['id']) ) ) {
                    $id = $_GET['id'];
                    global $conn;
                    $data = array();
                    $stmt = $conn->prepare(
                        "SELECT p.id, p.invoice, pd.product, p.notes, p.price
                        FROM db_accounting_soletrade_invoices_customers_products AS p
                        LEFT JOIN db_accounting_soletrade_products AS pd ON pd.id = p.product
                        WHERE p.invoice = $id
                        GROUP BY p.id
                        ORDER BY p.price desc");
                        $stmt->execute();
                        if($stmt->rowCount() === 0) echo ('No rows');
                        while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                            $data[] = $users;
                        }
                        echo json_encode($data);

      } elseif (isset($_GET['type']) && $_GET['type'] == 'accounting-supplies-invoices' ) {
        global $conn;
        $data = array();
        $stmt = $conn->prepare(
            "SELECT s.id, s.facEmpresa, s.facConcepte, s.facData, s.facSubtotal, s.facImportIva, s.facTotal, s.facIva, s.facPagament, s.loanDirectors, c.id AS idEmpresa, c.empresaNom, c.empresaNIF, c.empresaDireccio, co.country, vt.ivaPercen, pt.tipusNom
            FROM db_accounting_hispantic_invoices_suppliers AS s
            INNER JOIN db_accounting_hispantic_supplier_companies as c ON s.facEmpresa = c.id
            INNER JOIN db_countries AS co ON c.empresaPais = co.id
            INNER JOIN db_accounting_hispantic_vat_type AS vt ON s.facIva = vt.id
            INNER JOIN db_accounting_hispantic_payment_type AS pt ON s.facPagament = pt.id
            ORDER BY s.id ASC");
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

    }