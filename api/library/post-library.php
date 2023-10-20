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

        // values
        if (empty($_POST["AutNom"])) {;
          $hasError=true;
        } else {
          $AutNom = data_input($_POST['AutNom']);
        }

        if (empty($_POST["AutCognom1"])) {;
          $hasError=true;
        } else {
          $AutCognom1 = data_input($_POST['AutCognom1']);
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

        if (empty($_POST["AutOcupacio"])) {;
          $hasError=true;
        } else {
          $AutOcupacio = filter_input(INPUT_POST, 'AutOcupacio', FILTER_SANITIZE_NUMBER_INT);
        }

        if (empty($_POST["AutMoviment"])) {;
          $hasError=true;
        } else {
          $AutMoviment = filter_input(INPUT_POST, 'AutMoviment', FILTER_SANITIZE_NUMBER_INT);
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
          $sql = "INSERT INTO db_library_authors SET AutNom=:AutNom, AutCognom1=:AutCognom1, yearBorn=:yearBorn, yearDie=:yearDie, paisAutor=:paisAutor, img=:img, AutWikipedia=:AutWikipedia, AutDescrip=:AutDescrip, AutMoviment=:AutMoviment, AutOcupacio=:AutOcupacio, dateModified=:dateModified, dateCreated=:dateCreated, slug=:slug";
          $stmt= $conn->prepare($sql);
          $stmt->bindParam(":AutNom", $AutNom, PDO::PARAM_STR);
          $stmt->bindParam(":AutCognom1", $AutCognom1, PDO::PARAM_STR);
          $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
          $stmt->bindParam(":yearBorn", $yearBorn, PDO::PARAM_INT);
          $stmt->bindParam(":yearDie", $yearDie, PDO::PARAM_INT);
          $stmt->bindParam(":paisAutor", $paisAutor, PDO::PARAM_INT);
          $stmt->bindParam(":img", $img, PDO::PARAM_INT);
          $stmt->bindParam(":AutWikipedia", $AutWikipedia, PDO::PARAM_STR);
          $stmt->bindParam(":AutDescrip", $AutDescrip, PDO::PARAM_STR);
          $stmt->bindParam(":AutMoviment", $AutMoviment, PDO::PARAM_INT);
          $stmt->bindParam(":AutOcupacio", $AutOcupacio, PDO::PARAM_INT);
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