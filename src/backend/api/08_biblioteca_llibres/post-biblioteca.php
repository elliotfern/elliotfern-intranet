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
}

$allowed_origins = ['https://elliot.cat'];

if (isset($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], $allowed_origins)) {
  header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
} else {
  http_response_code(403);
  echo json_encode(['error' => 'Acceso no permitido']);
  exit;
}

// a) Inserir autor
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
  $hasError = false;

  $grup = !empty($data['grup']) ? data_input($data['grup']) : ($hasError = true);
  $nom = !empty($data['nom']) ? data_input($data['nom']) : ($hasError = true);
  $cognoms = isset($data['cognoms']) ? data_input($data['cognoms']) : ($hasError = false);
  $slug = !empty($data['slug']) ? data_input($data['slug']) : ($hasError = true);
  $ocupacio = !empty($data['ocupacio']) ? data_input($data['ocupacio']) : ($hasError = true);
  $anyNaixement = !empty($data['anyNaixement']) ? data_input($data['anyNaixement']) : ($hasError = true);
  $anyDefuncio = isset($data['anyDefuncio']) ? data_input($data['anyDefuncio']) : ($hasError = false);
  $paisAutor = !empty($data['paisAutor']) ? data_input($data['paisAutor']) : ($hasError = true);
  $img = !empty($data['img']) ? data_input($data['img']) : ($hasError = true);
  $web = !empty($data['web']) ? data_input($data['web']) : ($hasError = false);
  $descripcio = !empty($data['descripcio']) ? data_input($data['descripcio']) : ($hasError = true);

  $timestamp = date('Y-m-d');
  $dateCreated = $timestamp;
  $dateModified = $timestamp;

  if (!$hasError) {
    try {
      global $conn;
      $sql = "INSERT INTO db_persones 
                            (nom, cognoms, anyNaixement, anyDefuncio, paisAutor, img, web, descripcio, ocupacio, dateModified, dateCreated, slug, grup) 
                            VALUES 
                            (:nom, :cognoms, :anyNaixement, :anyDefuncio, :paisAutor, :img, :web, :descripcio, :ocupacio, :dateModified, :dateCreated, :slug, :grup)";
      $stmt = $conn->prepare($sql);

      $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
      $stmt->bindParam(":cognoms", $cognoms, PDO::PARAM_STR);
      $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
      $stmt->bindParam(":anyNaixement", $anyNaixement, PDO::PARAM_INT);
      $stmt->bindParam(":anyDefuncio", $anyDefuncio, PDO::PARAM_INT);
      $stmt->bindParam(":paisAutor", $paisAutor, PDO::PARAM_INT);
      $stmt->bindParam(":img", $img, PDO::PARAM_INT);
      $stmt->bindParam(":web", $web, PDO::PARAM_STR);
      $stmt->bindParam(":descripcio", $descripcio, PDO::PARAM_STR);
      $stmt->bindParam(":ocupacio", $ocupacio, PDO::PARAM_INT);
      $stmt->bindParam(":dateCreated", $dateCreated, PDO::PARAM_STR);
      $stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
      $stmt->bindParam(":grup", $grup, PDO::PARAM_STR);

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
} elseif (isset($_GET['llibre'])) {

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
  $hasError = false; // Inicializamos la variable $hasError como fa

  $autor = !empty($data['autor']) ? data_input($data['autor']) : ($hasError = true);
  $titol = !empty($data['titol']) ? data_input($data['titol']) : ($hasError = true);
  $titolEng = isset($data['titolEng']) ? data_input($data['titolEng']) : ($hasError = true);
  $any = !empty($data['any']) ? data_input($data['any']) : ($hasError = true);
  $idEd = !empty($data['idEd']) ? data_input($data['idEd']) : ($hasError = true);
  $lang = !empty($data['lang']) ? data_input($data['lang']) : ($hasError = true);
  $img = !empty($data['img']) ? data_input($data['img']) : ($hasError = true);
  $tipus = !empty($data['tipus']) ? data_input($data['tipus']) : ($hasError = true);
  $idGen = !empty($data['idGen']) ? data_input($data['idGen']) : ($hasError = true);
  $subGen = !empty($data['subGen']) ? data_input($data['subGen']) : ($hasError = true);
  $slug = !empty($data['slug']) ? data_input($data['slug']) : ($hasError = true);
  $estat = !empty($data['estat']) ? data_input($data['estat']) : ($hasError = true);

  $dateCreated = date('Y-m-d');
  $dateModified = date('Y-m-d');

  if (!$hasError) {
    global $conn;
    $sql = "INSERT INTO 08_db_biblioteca_llibres SET autor=:autor, titol=:titol, titolEng=:titolEng, any=:any, idEd=:idEd, lang=:lang, img=:img, tipus=:tipus, idGen=:idGen, subGen=:subGen, dateCreated=:dateCreated, slug=:slug, estat=:estat, dateModified=:dateModified";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":autor", $autor, PDO::PARAM_INT);
    $stmt->bindParam(":titol", $titol, PDO::PARAM_STR);
    $stmt->bindParam(":titolEng", $titolEng, PDO::PARAM_STR);
    $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
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

    if ($stmt->execute()) {
      // response output
      $response['status'] = 'success';

      header("Content-Type: application/json");
      echo json_encode($response);
    } else {
      // response output - data error
      $response['status'] = 'error db';

      header("Content-Type: application/json");
      echo json_encode($response);
    }
  } else {
    // response output - data error
    $response['status'] = 'error dades';

    header("Content-Type: application/json");
    echo json_encode($response);
  }
} else {
  // response output - data error
  $response['status'] = 'error ruta';
  header("Content-Type: application/json");
  echo json_encode($response);
  exit();
}
