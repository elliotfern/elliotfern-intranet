<?php
/*
 * BACKEND LIBRARY
 * FUNCIONS INSERT BOOK
 * @update_book_ajax
 */

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
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

          // a) Inserir autor
          if (isset($_GET['autor'])) {
            $hasError = false;
            $response = [];
        
            // Validaciones
            if (empty($_POST["AutNom"])) {
                $hasError = true;
                $response['errors'][] = 'El campo "nom" es obligatorio.';
            } else {
                $nom = data_input($_POST['AutNom']);
            }
        
            if (empty($_POST["AutCognom1"])) {
                $hasError = true;
                $response['errors'][] = 'El campo "cognoms" es obligatorio.';
            } else {
                $cognoms = data_input($_POST['AutCognom1']);
            }
        
            $yearBorn = filter_input(INPUT_POST, 'yearBorn', FILTER_SANITIZE_NUMBER_INT) ?: null;
            $yearDie = filter_input(INPUT_POST, 'yearDie', FILTER_SANITIZE_NUMBER_INT) ?: null;
            $paisAutor = filter_input(INPUT_POST, 'paisAutor', FILTER_SANITIZE_NUMBER_INT) ?: null;
            $img = filter_input(INPUT_POST, 'img', FILTER_SANITIZE_NUMBER_INT) ?: null;
            $ocupacio = filter_input(INPUT_POST, 'AutOcupacio', FILTER_SANITIZE_NUMBER_INT) ?: null;
            $moviment = filter_input(INPUT_POST, 'AutMoviment', FILTER_SANITIZE_NUMBER_INT) ?: null;
        
            $AutWikipedia = !empty($_POST["AutWikipedia"]) ? data_input($_POST['AutWikipedia']) : null;
            $AutDescrip = !empty($_POST["AutDescrip"]) ? data_input($_POST['AutDescrip']) : null;
            $slug = !empty($_POST["slug"]) ? data_input($_POST['slug']) : null;
        
            $timestamp = date('Y-m-d');
            $dateCreated = $timestamp;
            $dateModified = $timestamp;
        
            if (!$hasError) {
                try {
                    global $conn;
                    $sql = "INSERT INTO 08_db_biblioteca_autors 
                            (nom, cognoms, yearBorn, yearDie, paisAutor, img, AutWikipedia, AutDescrip, moviment, ocupacio, dateModified, dateCreated, slug) 
                            VALUES 
                            (:nom, :cognoms, :yearBorn, :yearDie, :paisAutor, :img, :AutWikipedia, :AutDescrip, :moviment, :ocupacio, :dateModified, :dateCreated, :slug)";
                    $stmt = $conn->prepare($sql);
        
                    $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
                    $stmt->bindParam(":cognoms", $cognoms, PDO::PARAM_STR);
                    $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
                    $stmt->bindParam(":yearBorn", $yearBorn, PDO::PARAM_INT);
                    $stmt->bindParam(":yearDie", $yearDie, PDO::PARAM_INT);
                    $stmt->bindParam(":paisAutor", $paisAutor, PDO::PARAM_INT);
                    $stmt->bindParam(":img", $img, PDO::PARAM_INT);
                    $stmt->bindParam(":AutWikipedia", $AutWikipedia, PDO::PARAM_STR);
                    $stmt->bindParam(":AutDescrip", $AutDescrip, PDO::PARAM_STR);
                    $stmt->bindParam(":moviment", $moviment, PDO::PARAM_INT);
                    $stmt->bindParam(":ocupacio", $ocupacio, PDO::PARAM_INT);
                    $stmt->bindParam(":dateCreated", $dateCreated, PDO::PARAM_STR);
                    $stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
        
                    if ($stmt->execute()) {
                        $response['status'] = 'success';
                    } else {
                        $response['status'] = 'error';
                        $response['message'] = 'Hubo un problema con la base de datos.';
                    }
                } catch (PDOException $e) {
                    $response['status'] = 'error';
                    $response['message'] = $e->getMessage();
                }
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Errores de validación.';
            }
        
            header("Content-Type: application/json");
            echo json_encode($response);
    
            
          // INSERIR NOU LLIBRE
          // autor	titol	titolEng	slug	any	tipus	idEd	idGen	subGen	lang	img	dateCreated
          } elseif (isset($_GET['type']) && $_GET['type'] == 'llibre' ) {
              if (empty($_POST["autor"])) {
                $hasError = true;
              } else {
                  $autor = filter_input(INPUT_POST, 'autor', FILTER_SANITIZE_NUMBER_INT);
              }

              if (empty($_POST["titol"])) {
                $hasError = true;
              } else {
                $titol = data_input($_POST["titol"]);
              }

              if (empty($_POST["titolEng"])) {
                $titolEng = NULL;
              } else {
                $titolEng = data_input($_POST["titolEng"]);
              }

              if (empty($_POST["slug"])) {
                $hasError = true;
              } else {
                $slug = data_input($_POST["slug"]);
              }

              if (empty($_POST["any"])) {
                $hasError = true;
              } else {
                $any = filter_input(INPUT_POST, 'any', FILTER_SANITIZE_NUMBER_INT);
              }

              if (empty($_POST["idEd"])) {
                $hasError = true;
              } else {
                $idEd = filter_input(INPUT_POST, 'idEd', FILTER_SANITIZE_NUMBER_INT);
              }

              if (empty($_POST["idGen"])) {
                $hasError = true;
              } else {
                $idGen = filter_input(INPUT_POST, 'idGen', FILTER_SANITIZE_NUMBER_INT);
              }

              if (empty($_POST["subGen"])) {
                $hasError = true;
              } else {
                $subGen = filter_input(INPUT_POST, 'subGen', FILTER_SANITIZE_NUMBER_INT);
              }

              if (empty($_POST["lang"])) {
                $hasError = true;
              } else {
                $lang = filter_input(INPUT_POST, 'lang', FILTER_SANITIZE_NUMBER_INT);
              }

              if (empty($_POST["img"])) {
                $hasError = true;
              } else {
                $img = filter_input(INPUT_POST, 'img', FILTER_SANITIZE_NUMBER_INT);
              }

              if (empty($_POST["tipus"])) {
                $hasError = true;
              } else {
                $tipus = filter_input(INPUT_POST, 'tipus', FILTER_SANITIZE_NUMBER_INT);
              }

              if (empty($_POST["estat"])) {
                $hasError = true;
              } else {
                $estat = filter_input(INPUT_POST, 'estat', FILTER_SANITIZE_NUMBER_INT);
              }

              $dateCreated = ($_POST['dateCreated']);
              $dateModified = date('Y-m-d');
            
              if (!isset($hasError)) {
                global $conn;
                $sql = "INSERT INTO 08_db_biblioteca_llibres SET autor=:autor, titol=:titol, titolEng=:titolEng, any=:any, idEd=:idEd, lang=:lang, img=:img, tipus=:tipus, idGen=:idGen, subGen=:subGen, dateCreated=:dateCreated, slug=:slug, dateModified=:dateModified, estat=:estat";
                $stmt= $conn->prepare($sql);
                $stmt->bindParam(":autor", $autor, PDO::PARAM_INT);
                $stmt->bindParam(":titol", $titol, PDO::PARAM_STR);
                $stmt->bindParam(":titolEng", $titolEng, PDO::PARAM_STR);
                $stmt->bindParam(":any", $any, PDO::PARAM_INT);
                $stmt->bindParam(":idEd", $idEd, PDO::PARAM_INT);
                $stmt->bindParam(":lang", $lang, PDO::PARAM_INT);
                $stmt->bindParam(":img", $img, PDO::PARAM_INT);
                $stmt->bindParam(":tipus", $tipus, PDO::PARAM_INT);
                $stmt->bindParam(":idGen", $idGen, PDO::PARAM_INT);
                $stmt->bindParam(":subGen", $subGen, PDO::PARAM_INT);
                $stmt->bindParam(":estat", $estat, PDO::PARAM_INT);
                $stmt->bindParam(":dateCreated", $dateCreated, PDO::PARAM_STR);
                $stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
                $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);

                if ($stmt->execute()) {
                // response output
                $response['status'] = 'success';

                header( "Content-Type: application/json" );
                echo json_encode($response);

                } else {
                  // response output - data error
                  $response['status'] = 'error';

                  header( "Content-Type: application/json" );
                  echo json_encode($response);
                }
            } else {
              // response output - data error
              $response['status'] = 'error';

              header( "Content-Type: application/json" );
              echo json_encode($response);
            }
        
        } else {
          // response output - data error
          $response['status'] = 'error';
          header( "Content-Type: application/json" );
          echo json_encode($response);
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
