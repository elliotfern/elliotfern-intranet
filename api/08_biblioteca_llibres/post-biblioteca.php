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
        if (isset($_GET['autor']) ) {
            if (empty($_POST["nom"])) {;
              $hasError=true;
            } else {
              $nom = data_input($_POST['nom']);
            }
          
            if (empty($_POST["cognoms"])) {;
              $hasError=true;
            } else {
              $cognoms = data_input($_POST['cognoms']);
            }

            if (empty($_POST["yearBorn"])) {;
              $hasError=true;
            } else {
              $yearBorn = filter_input(INPUT_POST, 'yearBorn', FILTER_SANITIZE_NUMBER_INT);
            }

            if (empty($_POST["yearDie"])) {;
              $yearDie = NULL;
            } else {
              $yearDie = filter_input(INPUT_POST, 'yearDie', FILTER_SANITIZE_NUMBER_INT);
            }

            if (empty($_POST["paisAutor"])) {;
              $hasError=true;
            } else {
              $paisAutor = filter_input(INPUT_POST, 'paisAutor', FILTER_SANITIZE_NUMBER_INT);
            }

            if (empty($_POST["AutWikipedia"])) {;
              $hasError=true;
            } else {
              $AutWikipedia = data_input($_POST['AutWikipedia']);
            }

            if (empty($_POST["AutDescrip"])) {;
              $hasError=true;
            } else {
              $AutDescrip = data_input($_POST['AutDescrip']);
            }

            if (empty($_POST["ocupacio"])) {;
              $hasError=true;
            } else {
              $ocupacio = filter_input(INPUT_POST, 'ocupacio', FILTER_SANITIZE_NUMBER_INT);
            }

            if (empty($_POST["moviment"])) {;
              $hasError=true;
            } else {
              $moviment = filter_input(INPUT_POST, 'moviment', FILTER_SANITIZE_NUMBER_INT);
            }
 
            if (empty($_POST["img"])) {;
              $hasError=true;
            } else {
              $img = filter_input(INPUT_POST, 'img', FILTER_SANITIZE_NUMBER_INT);
            }

            if (empty($_POST["slug"])) {;
              $hasError=true;
            } else {
              $slug = data_input($_POST['slug']);
            }

            $timestamp = date('Y-m-d');
            $dateCreated = $timestamp;
            $dateModified = $timestamp;

            if (!isset($hasError)) {
              global $conn;
              $sql = "INSERT INTO 08_db_biblioteca_autors SET nom=:nom, cognoms=:cognoms, yearBorn=:yearBorn, yearDie=:yearDie, paisAutor=:paisAutor, img=:img, AutWikipedia=:AutWikipedia, AutDescrip=:AutDescrip, moviment=:moviment, ocupacio=:ocupacio, dateModified=:dateModified, dateCreated=:dateCreated, slug=:slug";
              $stmt= $conn->prepare($sql);
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
                $titol = data_input($_POST["titol"], ENT_NOQUOTES);
              }

              if (empty($_POST["titolEng"])) {
                $titolEng = NULL;
              } else {
                $titolEng = data_input($_POST["titolEng"], ENT_NOQUOTES);
              }

              if (empty($_POST["slug"])) {
                $hasError = true;
              } else {
                $slug = data_input($_POST["slug"], ENT_NOQUOTES);
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

              $dateCreated = ($_POST['dateCreated']);
              $dateModified = date('Y-m-d');
            
              if (!isset($hasError)) {
                global $conn;
                $sql = "INSERT INTO 08_db_biblioteca_llibres SET autor=:autor, titol=:titol, titolEng=:titolEng, any=:any, idEd=:idEd, lang=:lang, img=:img, tipus=:tipus, idGen=:idGen, subGen=:subGen, dateCreated=:dateCreated, slug=:slug, dateModified=:dateModified";
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
