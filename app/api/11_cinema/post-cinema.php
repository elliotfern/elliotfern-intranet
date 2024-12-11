<?php
/*
 * BACKEND CINEMA
 * FUNCIONS INSERT
 * 
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

          // a) Inserir pelicula
        if (isset($_GET['pelicula']) ) {
            
            if (empty($_POST["pelicula"])) {;
              $hasError=true;
            } else {
              $pelicula = data_input($_POST['pelicula']);
            }
          
            if (empty($_POST["pelicula_es"])) {;
              $hasError=true;
            } else {
              $pelicula_es = data_input($_POST['pelicula_es']);
            }

            if (empty($_POST["director"])) {;
              $hasError=true;
            } else {
              $director = filter_input(INPUT_POST, 'director', FILTER_SANITIZE_NUMBER_INT);
            }

            if (empty($_POST["any"])) {;
                $hasError=true;
              } else {
                $any = data_input($_POST['any']);
              }

            if (empty($_POST["genere"])) {;
                $hasError=true;
            } else {
              $genere = filter_input(INPUT_POST, 'genere', FILTER_SANITIZE_NUMBER_INT);
            }

            if (empty($_POST["pais"])) {;
              $hasError=true;
            } else {
              $pais = filter_input(INPUT_POST, 'pais', FILTER_SANITIZE_NUMBER_INT);
            }

            if (empty($_POST["lang"])) {;
                $hasError=true;
              } else {
                $lang = filter_input(INPUT_POST, 'lang', FILTER_SANITIZE_NUMBER_INT);
            }

            if (empty($_POST["img"])) {;
                $hasError=true;
              } else {
                $img = filter_input(INPUT_POST, 'img', FILTER_SANITIZE_NUMBER_INT);
            }

            if (empty($_POST["dataVista"])) {;
              $hasError=true;
            } else {
              $dataVista = data_input($_POST['dataVista']);
            }
            
            if (empty($_POST["descripcio"])) {;
              $hasError=true;
            } else {
              $descripcio = html_entity_decode($_POST['descripcio']);
            }

            $timestamp = date('Y-m-d');
            $dateCreated = $timestamp;
            $dateModified = $timestamp;

            if (!isset($hasError)) {
              global $conn;
              $sql = "INSERT INTO 11_db_pelicules SET pelicula=:pelicula, pelicula_es=:pelicula_es, director=:director, any=:any, genere=:genere, img=:img, pais=:pais, lang=:lang, dataVista=:dataVista, dateModified=:dateModified, dateCreated=:dateCreated, descripcio=:descripcio";
              $stmt= $conn->prepare($sql);
              $stmt->bindParam(":pelicula", $pelicula, PDO::PARAM_STR);
              $stmt->bindParam(":pelicula_es", $pelicula_es, PDO::PARAM_STR);
              $stmt->bindParam(":director", $director, PDO::PARAM_STR);
              $stmt->bindParam(":any", $any, PDO::PARAM_INT);
              $stmt->bindParam(":genere", $genere, PDO::PARAM_INT);
              $stmt->bindParam(":pais", $pais, PDO::PARAM_INT);
              $stmt->bindParam(":img", $img, PDO::PARAM_INT);
              $stmt->bindParam(":lang", $lang, PDO::PARAM_STR);
              $stmt->bindParam(":dataVista", $dataVista, PDO::PARAM_STR);
              $stmt->bindParam(":dateCreated", $dateCreated, PDO::PARAM_STR);
              $stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
              $stmt->bindParam(":descripcio", $descripcio, PDO::PARAM_STR);
              
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
            
          // INSERIR NOU autor
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
        
        // a) Inserir Actor en pelicula
        } elseif (isset($_GET['actorSerie']) ) {

              $hasError = false;

              if (empty($_POST["idActor"])) {
                $hasError = true;
              } else {
                  $idActor = filter_input(INPUT_POST, 'idActor', FILTER_SANITIZE_NUMBER_INT);
              }

              if (empty($_POST["idSerie"])) {
                $hasError = true;
              } else {
                  $idSerie = filter_input(INPUT_POST, 'idSerie', FILTER_SANITIZE_NUMBER_INT);
              }

              if (empty($_POST["role"])) {
                $hasError = true;
              } else {
                $role = data_input($_POST["role"], ENT_NOQUOTES);
              }
            
              if (!isset($hasError)) {
                global $conn;
                $sql = "INSERT INTO 11_aux_cinema_actors_seriestv SET idActor=:idActor, idSerie=:idSerie, role=:role";
                $stmt= $conn->prepare($sql);
                $stmt->bindParam(":idActor", $idActor, PDO::PARAM_INT);
                $stmt->bindParam(":idSerie", $idSerie, PDO::PARAM_INT);
                $stmt->bindParam(":role", $role, PDO::PARAM_STR);

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
        
             // c) Crear nova serie
            } elseif (isset($_GET['serie']) ) {

              $hasError = false;

              if (empty($_POST["name"])) {
                $hasError = true;
              } else {
                $name = data_input($_POST["name"], ENT_NOQUOTES);
              }

              if (empty($_POST["startYear"])) {
                $hasError = true;
              } else {
                  $startYear = filter_input(INPUT_POST, 'startYear', FILTER_SANITIZE_NUMBER_INT);
              }

              if (empty($_POST["endYear"])) {
                $endYear = NULL;
              } else {
                  $endYear = filter_input(INPUT_POST, 'endYear', FILTER_SANITIZE_NUMBER_INT);
              }

              if (empty($_POST["season"])) {
                $hasError = true;
              } else {
                  $season = filter_input(INPUT_POST, 'season', FILTER_SANITIZE_NUMBER_INT);
              }

              if (empty($_POST["chapter"])) {
                $hasError = true;
              } else {
                  $chapter = filter_input(INPUT_POST, 'chapter', FILTER_SANITIZE_NUMBER_INT);
              }

              if (empty($_POST["director"])) {
                $hasError = true;
              } else {
                  $director = filter_input(INPUT_POST, 'director', FILTER_SANITIZE_NUMBER_INT);
              }

              if (empty($_POST["lang"])) {
                $hasError = true;
              } else {
                  $lang = filter_input(INPUT_POST, 'lang', FILTER_SANITIZE_NUMBER_INT);
              }

              if (empty($_POST["genre"])) {
                $hasError = true;
              } else {
                  $genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_NUMBER_INT);
              }
              
              if (empty($_POST["producer"])) {
                $hasError = true;
              } else {
                  $producer = filter_input(INPUT_POST, 'producer', FILTER_SANITIZE_NUMBER_INT);
              }

              if (empty($_POST["country"])) {
                $hasError = true;
              } else {
                  $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_NUMBER_INT);
              }

              if (empty($_POST["img"])) {
                $hasError = true;
              } else {
                  $img = filter_input(INPUT_POST, 'img', FILTER_SANITIZE_NUMBER_INT);
              }

              if (empty($_POST["descripcio"])) {
                $hasError = true;
              } else {
                $descripcio = html_entity_decode($_POST['descripcio']);
              }
              
              $dateCreated = date('Y-m-d');
              $dateModified = date('Y-m-d');

              if (!$hasError) {
                global $conn;
                $sql = "INSERT INTO 11_db_cinema_series_tv SET name=:name, startYear=:startYear, endYear=:endYear, season=:season, chapter=:chapter, director=:director, lang=:lang, genre=:genre, producer=:producer, country=:country, img=:img, descripcio=:descripcio, dateCreated=:dateCreated, dateModified=:dateModified";
                $stmt= $conn->prepare($sql);
                $stmt->bindParam(":name", $name, PDO::PARAM_STR);
                $stmt->bindParam(":startYear", $startYear, PDO::PARAM_INT);
                $stmt->bindParam(":endYear", $endYear, PDO::PARAM_INT);
                $stmt->bindParam(":season", $season, PDO::PARAM_INT);
                $stmt->bindParam(":chapter", $chapter, PDO::PARAM_INT);
                $stmt->bindParam(":director", $director, PDO::PARAM_INT);
                $stmt->bindParam(":lang", $lang, PDO::PARAM_INT);
                $stmt->bindParam(":genre", $genre, PDO::PARAM_INT);
                $stmt->bindParam(":producer", $producer, PDO::PARAM_INT);
                $stmt->bindParam(":country", $country, PDO::PARAM_INT);
                $stmt->bindParam(":img", $img, PDO::PARAM_INT);
                $stmt->bindParam(":descripcio", $descripcio, PDO::PARAM_STR);
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
        
        // si no hi ha cap endpoint valid, mostrar error:
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
