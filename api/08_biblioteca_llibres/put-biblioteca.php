<?php
/*
 * BACKEND LIBRARY
 * FUNCIONS UPDATE AUTHOR
 * @update_book_ajax
 */

// Check if the request method is PUT
if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
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

        // RUTA PARA ACTUALIZAR AUTOR
        // ruta PUT => "/api/biblioteca/put?autor"
        if (isset($_GET['autor'])) {

          // Obtener el cuerpo de la solicitud PUT
          $input_data = file_get_contents("php://input");

          // Decodificar los datos JSON
          $data = json_decode($input_data, true);

          // Verificar si se recibieron datos
          if ($data === null) {
              // Error al decodificar JSON
              header('HTTP/1.1 400 Bad Request');
              echo json_encode(['error' => 'Error decoding JSON data']);
              exit();
          }

          // Ahora puedes acceder a los datos como un array asociativo
          $hasError = false; // Inicializamos la variable $hasError como false
          
          $nom = isset($data['nom']) ? data_input($data['nom']) : NULL;
          $cognoms = isset($data['cognoms']) ? data_input($data['cognoms']) : ($hasError = true);
          $yearBorn = isset($data['yearBorn']) ? data_input($data['yearBorn']) : ($hasError = true);
          $yearDie = isset($data['yearDie']) ? data_input($data['yearDie']) : NULL;
          $paisAutor = isset($data['paisAutor']) ? data_input($data['paisAutor']) : ($hasError = true);
          $img = isset($data['img']) ? data_input($data['img']) : ($hasError = true);
          $AutWikipedia = isset($data['AutWikipedia']) ? data_input($data['AutWikipedia']) : ($hasError = true);
          $AutDescrip = isset($data['AutDescrip']) ? data_input($data['AutDescrip']) : ($hasError = true);
          $moviment = isset($data['moviment']) ? data_input($data['moviment']) : ($hasError = true);
          $ocupacio = isset($data['ocupacio']) ? data_input($data['ocupacio']) : ($hasError = true);
          $id = isset($data['id']) ? data_input($data['id']) : ($hasError = true);
          $slug = isset($data['slug']) ? data_input($data['slug']) : ($hasError = true);

          $timestamp = date('Y-m-d');
          $dateModified = $timestamp;
          
          if ($hasError == false) {
                global $conn;
                $sql = "UPDATE db_biblioteca_autors SET nom=:nom, cognoms=:cognoms, yearBorn=:yearBorn, yearDie=:yearDie, paisAutor=:paisAutor, img=:img, AutWikipedia=:AutWikipedia, AutDescrip=:AutDescrip, moviment=:moviment, ocupacio=:ocupacio, dateModified=:dateModified, slug=:slug WHERE id=:id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
                $stmt->bindParam(":cognoms", $cognoms, PDO::PARAM_STR);
                $stmt->bindParam(":yearBorn", $yearBorn, PDO::PARAM_INT);
                $stmt->bindParam(":yearDie", $yearDie, PDO::PARAM_INT);
                $stmt->bindParam(":paisAutor", $paisAutor, PDO::PARAM_INT);
                $stmt->bindParam(":img", $img, PDO::PARAM_INT);
                $stmt->bindParam(":AutWikipedia", $AutWikipedia, PDO::PARAM_STR);
                $stmt->bindParam(":AutDescrip", $AutDescrip, PDO::PARAM_STR);
                $stmt->bindParam(":moviment", $moviment, PDO::PARAM_INT);
                $stmt->bindParam(":ocupacio", $ocupacio, PDO::PARAM_INT);
                $stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
                $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);

                if ($stmt->execute()) {
                          // response output
                          $response['status'] = 'success';

                          header( "Content-Type: application/json" );
                          echo json_encode($response);
                } else {
                          // response output - data error
                          $response['status'] = 'error bd';

                          header( "Content-Type: application/json" );
                          echo json_encode($response);
                }
          } else {
                // response output - data error
                $response['status'] = 'error has error dades';

                header( "Content-Type: application/json" );
                echo json_encode($response);
          }
        
        // Ruta actualizació llibre
        // Ruta PUT => "/api/biblioteca/put?llibre"
        } elseif (isset($_GET['llibre'])) {

        } else {
          // response output - data error
          $response['status'] = 'error 2 url api';
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
