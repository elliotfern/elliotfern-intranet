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
}

$allowed_origins = ['https://elliot.cat'];

if (isset($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], $allowed_origins)) {
  header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
} else {
  http_response_code(403);
  echo json_encode(['error' => 'Acceso no permitido']);
  exit;
}


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
  $anyNaixement = isset($data['anyNaixement']) ? data_input($data['anyNaixement']) : ($hasError = true);
  $anyDefuncio = isset($data['anyDefuncio']) && $data['anyDefuncio'] !== '' ? data_input($data['anyDefuncio']) : NULL;
  $paisAutor = isset($data['paisAutor']) ? data_input($data['paisAutor']) : ($hasError = true);
  $img = isset($data['img']) ? data_input($data['img']) : ($hasError = true);
  $web = isset($data['web']) ? data_input($data['web']) : ($hasError = true);
  $descripcio = isset($data['descripcio']) ? data_input($data['descripcio']) : ($hasError = true);
  $ocupacio = isset($data['ocupacio']) ? data_input($data['ocupacio']) : ($hasError = true);
  $id = isset($data['id']) ? data_input($data['id']) : ($hasError = true);
  $slug = isset($data['slug']) ? data_input($data['slug']) : ($hasError = true);
  $grup = !empty($data['grup']) ? data_input($data['grup']) : ($hasError = true);

  $timestamp = date('Y-m-d');
  $dateModified = $timestamp;

  if ($hasError == false) {
    global $conn;
    $sql = "UPDATE db_persones SET nom=:nom, cognoms=:cognoms, anyNaixement=:anyNaixement, anyDefuncio=:anyDefuncio, paisAutor=:paisAutor, img=:img, web=:web, descripcio=:descripcio, ocupacio=:ocupacio, dateModified=:dateModified, slug=:slug, grup=:grup WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
    $stmt->bindParam(":cognoms", $cognoms, PDO::PARAM_STR);
    $stmt->bindParam(":anyNaixement", $anyNaixement, PDO::PARAM_INT);
    $stmt->bindParam(":anyDefuncio", $anyDefuncio, PDO::PARAM_INT);
    $stmt->bindParam(":paisAutor", $paisAutor, PDO::PARAM_INT);
    $stmt->bindParam(":img", $img, PDO::PARAM_INT);
    $stmt->bindParam(":web", $web, PDO::PARAM_STR);
    $stmt->bindParam(":descripcio", $descripcio, PDO::PARAM_STR);
    $stmt->bindParam(":ocupacio", $ocupacio, PDO::PARAM_INT);
    $stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
    $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
    $stmt->bindParam(":grup", $grup, PDO::PARAM_INT);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
      // response output
      $response['status'] = 'success';

      header("Content-Type: application/json");
      echo json_encode($response);
    } else {
      // response output - data error
      $response['status'] = 'error bd';

      header("Content-Type: application/json");
      echo json_encode($response);
    }
  } else {
    // response output - data error
    $response['status'] = 'error has error dades';

    header("Content-Type: application/json");
    echo json_encode($response);
  }

  // Ruta actualizació llibre
  // Ruta PUT => "/api/biblioteca/put?llibre"
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
  $hasError = false; // Inicializamos la variable $hasError como false

  $autor = isset($data['autor']) ? data_input($data['autor']) : ($hasError = true);
  $titol = isset($data['titol']) ? data_input($data['titol']) : ($hasError = true);
  $titolEng = isset($data['titolEng']) ? data_input($data['titolEng']) : NULL;
  $slug = isset($data['slug']) ? data_input($data['slug']) : ($hasError = true);
  $any = isset($data['any']) ? data_input($data['any']) : ($hasError = true);
  $tipus = isset($data['tipus']) ? data_input($data['tipus']) : ($hasError = true);
  $idEd = isset($data['idEd']) ? data_input($data['idEd']) : ($hasError = true);
  $idGen = isset($data['idGen']) ? data_input($data['idGen']) : ($hasError = true);
  $subGen = isset($data['subGen']) ? data_input($data['subGen']) : ($hasError = true);
  $lang = isset($data['lang']) ? data_input($data['lang']) : ($hasError = true);
  $img = isset($data['img']) ? data_input($data['img']) : ($hasError = true);
  $lang = isset($data['lang']) ? data_input($data['lang']) : ($hasError = true);
  $estat = isset($data['estat']) ? data_input($data['estat']) : ($hasError = true);

  $id = isset($data['id']) ? data_input($data['id']) : ($hasError = true);

  $timestamp = date('Y-m-d');
  $dateModified = $timestamp;

  if ($hasError == false) {
    global $conn;
    $sql = "UPDATE 08_db_biblioteca_llibres SET autor=:autor, titol=:titol, titolEng=:titolEng, any=:any, idGen=:idGen, subGen=:subGen, idEd=:idEd, lang=:lang, slug=:slug, img=:img, tipus=:tipus, dateModified=:dateModified, estat=:estat WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":autor", $autor, PDO::PARAM_INT);
    $stmt->bindParam(":titol", $titol, PDO::PARAM_STR);
    $stmt->bindParam(":titolEng", $titolEng, PDO::PARAM_STR);
    $stmt->bindParam(":any", $any, PDO::PARAM_INT);
    $stmt->bindParam(":idEd", $idEd, PDO::PARAM_INT);
    $stmt->bindParam(":lang", $lang, PDO::PARAM_INT);
    $stmt->bindParam(":img", $img, PDO::PARAM_INT);
    $stmt->bindParam(":tipus", $tipus, PDO::PARAM_INT);
    $stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
    $stmt->bindParam(":idGen", $idGen, PDO::PARAM_INT);
    $stmt->bindParam(":subGen", $subGen, PDO::PARAM_INT);
    $stmt->bindParam(":estat", $estat, PDO::PARAM_INT);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);

    if ($stmt->execute()) {
      // response output
      $response['status'] = 'success';

      header("Content-Type: application/json");
      echo json_encode($response);
    } else {
      // response output - data error
      $response['status'] = 'error bd';

      header("Content-Type: application/json");
      echo json_encode($response);
    }
  } else {
    // response output - data error
    $response['status'] = 'error has error dades';

    header("Content-Type: application/json");
    echo json_encode($response);
  }
} else {
  // response output - data error
  $response['status'] = 'error 2 url api';
  header("Content-Type: application/json");
  echo json_encode($response);
  exit();
}
