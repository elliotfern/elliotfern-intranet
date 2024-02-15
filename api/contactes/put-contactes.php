<?php
/*
 * BACKEND CONTACTES
 * FUNCIONS MODIFICAR CONTACTE
 */

// Check if the request method is PUT
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

        // RUTA PARA ACTUALIZAR AUTOR
        if (isset($params['contacte'])) {
            // values
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

            if (empty($_POST["tel_1"])) {;
                $hasError=true;
            } else {
                $tel_1 = data_input($_POST['tel_1']);
            }

            if (empty($_POST["tel_2"])) {;
                $tel_2 = NULL;
            } else {
                $tel_2 = data_input($_POST['tel_2']);
            }

            if (empty($_POST["tel_3"])) {;
                $tel_3 = NULL;
            } else {
                $tel_3 = data_input($_POST['tel_3']);
            }

            if (empty($_POST["adreca"])) {;
                $adreca = NULL;
            } else {
                $adreca = data_input($_POST['adreca']);
            }
          
            if (empty($_POST["data_naixement"])) {;
              $data_naixement = NULL;
            } else {
              $data_naixement = data_input($_POST['data_naixement']);
            }

            if (empty($_POST["web"])) {;
                $web = NULL;
            } else {
                $web = data_input($_POST['web']);
            }
            
            if (empty($_POST["tipus"])) {;
              $hasError=true;
            } else {
              $tipus = filter_input(INPUT_POST, 'tipus', FILTER_SANITIZE_NUMBER_INT);
            }
          
            if (empty($_POST["pais"])) {;
              $hasError=true;
            } else {
              $pais = filter_input(INPUT_POST, 'pais', FILTER_SANITIZE_NUMBER_INT);
            }
            
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

          global $conn;
          $sql = "UPDATE db_contactes SET nom=:nom, cognoms=:cognoms, email=:email, tel_1=:tel_1, tel_2=:tel_2, tel_3=:tel_3, adreca=:adreca, data_naixement=:data_naixement, web=:web, tipus=:tipus, pais=:pais WHERE id=:id";
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
          $stmt->bindParam(":cognoms", $cognoms, PDO::PARAM_STR);
          $stmt->bindParam(":email", $email, PDO::PARAM_STR);
          $stmt->bindParam(":tel_1", $tel_1, PDO::PARAM_STR);
          $stmt->bindParam(":tel_2", $tel_2, PDO::PARAM_STR);
          $stmt->bindParam(":tel_3", $tel_3, PDO::PARAM_STR);
          $stmt->bindParam(":adreca", $adreca, PDO::PARAM_STR);
          $stmt->bindParam(":data_naixement", $data_naixement, PDO::PARAM_STR);
          $stmt->bindParam(":web", $web, PDO::PARAM_STR);
          $stmt->bindParam(":tipus", $tipus, PDO::PARAM_INT);
          $stmt->bindParam(":pais", $pais, PDO::PARAM_INT);
          $stmt->bindParam(":id", $id, PDO::PARAM_INT);

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
