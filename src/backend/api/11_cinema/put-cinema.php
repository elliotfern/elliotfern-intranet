<?php
/*
 * BACKEND CINEMA
 * FUNCIONS UPDATE
 * @update_book_ajax
 */


// Configuración de cabeceras para aceptar JSON y responder JSON
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: https://elliot.cat");
header("Access-Control-Allow-Methods: PUT");


// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
  header('HTTP/1.1 405 Method Not Allowed');
  echo json_encode(['error' => 'Method not allowed']);
  exit();
}

// RUTA PARA ACTUALIZAR PELICULA
// ruta GET => "/api/cinema/put/?pelicula"
if (isset($_GET['pelicula'])) {
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

  // Inicializar un array para los errores
  $errors = [];

  // Validación de los datos recibidos


  // Si hay errores, devolver una respuesta con los errores
  if (!empty($errors)) {
    http_response_code(400); // Bad Request
    echo json_encode(["errors" => $errors]);
    exit;
  }

  $id = !empty($data['id']) ? data_input($data['id']) : ($hasError = true);
  $pelicula = !empty($data['pelicula']) ? data_input($data['pelicula']) : ($hasError = true);
  $slug = !empty($data['slug']) ? data_input($data['slug']) : ($hasError = true);
  $pelicula_es = !empty($data['pelicula_es']) ? data_input($data['pelicula_es']) : ($hasError = true);
  $director = !empty($data['director']) ? data_input($data['director']) : ($hasError = true);
  $any = !empty($data['any']) ? data_input($data['any']) : ($hasError = true);
  $genere = !empty($data['genere']) ? data_input($data['genere']) : ($hasError = true);
  $pais = !empty($data['pais']) ? data_input($data['pais']) : ($hasError = true);
  $lang = !empty($data['lang']) ? data_input($data['lang']) : ($hasError = true);
  $img = !empty($data['img']) ? data_input($data['img']) : ($hasError = true);
  $descripcio = !empty($data['descripcio']) ? data_input($data['descripcio']) : ($hasError = true);
  $dataVista = !empty($data['dataVista']) ? data_input($data['dataVista']) : ($hasError = true);

  $timestamp = date('Y-m-d');
  $dateModified = $timestamp;

  if (!$hasError) {

    global $conn;
    $sql = "UPDATE 11_db_pelicules SET pelicula=:pelicula, pelicula_es=:pelicula_es, director=:director, any=:any, genere=:genere, img=:img, pais=:pais, lang=:lang, dataVista=:dataVista, dateModified=:dateModified, descripcio=:descripcio, slug=:slug WHERE id=:id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":pelicula", $pelicula, PDO::PARAM_STR);
    $stmt->bindParam(":pelicula_es", $pelicula_es, PDO::PARAM_STR);
    $stmt->bindParam(":director", $director, PDO::PARAM_INT);
    $stmt->bindParam(":any", $any, PDO::PARAM_STR);
    $stmt->bindParam(":genere", $genere, PDO::PARAM_INT);
    $stmt->bindParam(":pais", $pais, PDO::PARAM_INT);
    $stmt->bindParam(":img", $img, PDO::PARAM_INT);
    $stmt->bindParam(":lang", $lang, PDO::PARAM_STR);
    $stmt->bindParam(":dataVista", $dataVista, PDO::PARAM_STR);
    $stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
    $stmt->bindParam(":descripcio", $descripcio, PDO::PARAM_STR);
    $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
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
    $response['status'] = 'error';

    header("Content-Type: application/json");
    echo json_encode($response);
  }


  // RUTA PARA ACTUALIZAR SERIE TV
  // ruta PUT => "/api/cinema/put/?serie"
} elseif (isset($_GET['serie'])) {

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


  // Ahora puedes acceder a los datos como un array asociativo
  $hasError = false; // Inicializamos la variable $hasError como false

  $name          = !empty($data['name'])         ? data_input($data['name'])         : ($hasError = true);
  $slug          = !empty($data['slug'])         ? data_input($data['slug'])         : ($hasError = true);
  $startYear     = !empty($data['startYear'])    ? data_input($data['startYear'])    : ($hasError = true);
  $endYear       = !empty($data['endYear'])      ? data_input($data['endYear'])      : ($hasError = false);
  $season        = !empty($data['season'])       ? data_input($data['season'])       : ($hasError = true);
  $chapter       = !empty($data['chapter'])      ? data_input($data['chapter'])      : ($hasError = true);
  $director      = !empty($data['director'])     ? data_input($data['director'])     : ($hasError = true);
  $lang          = !empty($data['lang'])         ? data_input($data['lang'])         : ($hasError = true);
  $genre         = !empty($data['genre'])        ? data_input($data['genre'])        : ($hasError = true);
  $producer      = !empty($data['producer'])     ? data_input($data['producer'])     : ($hasError = true);
  $country       = !empty($data['country'])      ? data_input($data['country'])      : ($hasError = true);
  $img           = !empty($data['img'])          ? data_input($data['img'])          : ($hasError = true);
  $descripcio    = !empty($data['descripcio'])   ? data_input($data['descripcio'])   : ($hasError = true);
  $id = !empty($data['id']) ? data_input($data['id']) : ($hasError = true);

  $dateModified = date('Y-m-d');

  if (!$hasError) {

    global $conn;
    $sql = "UPDATE 11_db_cinema_series_tv SET name=:name, startYear=:startYear, endYear=:endYear, season=:season, chapter=:chapter, director=:director, lang=:lang, img=:img, genre=:genre, producer=:producer, country=:country, dateModified=:dateModified, descripcio=:descripcio, slug=:slug WHERE id=:id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":name", $name, PDO::PARAM_STR);
    $stmt->bindParam(":startYear", $startYear, PDO::PARAM_STR);
    $stmt->bindParam(":endYear", $endYear, PDO::PARAM_STR);
    $stmt->bindParam(":season", $season, PDO::PARAM_INT);
    $stmt->bindParam(":chapter", $chapter, PDO::PARAM_INT);
    $stmt->bindParam(":director", $director, PDO::PARAM_INT);
    $stmt->bindParam(":img", $img, PDO::PARAM_INT);
    $stmt->bindParam(":lang", $lang, PDO::PARAM_INT);
    $stmt->bindParam(":genre", $genre, PDO::PARAM_INT);
    $stmt->bindParam(":producer", $producer, PDO::PARAM_INT);
    $stmt->bindParam(":country", $country, PDO::PARAM_INT);
    $stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
    $stmt->bindParam(":descripcio", $descripcio, PDO::PARAM_STR);
    $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
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
    $response['status'] = 'error /hasError/ dades';

    header("Content-Type: application/json");
    echo json_encode($response);
  }

  // a) Inserir Actor en pelicula
} elseif (isset($_GET['actorPelicula'])) {

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

  $idMovie = !empty($data['idMovie']) ? data_input($data['idMovie']) : ($hasError = true);
  $idActor = !empty($data['idActor']) ? data_input($data['idActor']) : ($hasError = true);
  $role = !empty($data['role']) ? data_input($data['role']) : ($hasError = true);
  $id = !empty($data['id']) ? data_input($data['id']) : ($hasError = true);

  if (!$hasError) {

    global $conn;

    $sql = "UPDATE 11_aux_cinema_actors_pelicules SET idActor=:idActor, idMovie=:idMovie, role=:role WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":idActor", $idActor, PDO::PARAM_INT);
    $stmt->bindParam(":idMovie", $idMovie, PDO::PARAM_INT);
    $stmt->bindParam(":role", $role, PDO::PARAM_STR);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
      // response output
      $response['status'] = 'success';

      header("Content-Type: application/json");
      echo json_encode($response);
    } else {
      // response output - data error
      $response['status'] = 'error';

      header("Content-Type: application/json");
      echo json_encode($response);
    }
  }

  // a) Inserir Actor en pelicula
} elseif (isset($_GET['actorSerie'])) {

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

  $idSerie = !empty($data['idSerie']) ? data_input($data['idSerie']) : ($hasError = true);
  $idActor = !empty($data['idActor']) ? data_input($data['idActor']) : ($hasError = true);
  $role = !empty($data['role']) ? data_input($data['role']) : ($hasError = true);
  $id = !empty($data['id']) ? data_input($data['id']) : ($hasError = true);

  if (!$hasError) {

    global $conn;
    $sql = "UPDATE 11_aux_cinema_actors_seriestv SET idActor=:idActor, idSerie=:idSerie, role=:role WHERE id=:id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":idActor", $idActor, PDO::PARAM_INT);
    $stmt->bindParam(":idSerie", $idSerie, PDO::PARAM_INT);
    $stmt->bindParam(":role", $role, PDO::PARAM_STR);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
      // response output
      $response['status'] = 'success';

      header("Content-Type: application/json");
      echo json_encode($response);
    } else {
      // response output - data error
      $response['status'] = 'error';

      header("Content-Type: application/json");
      echo json_encode($response);
    }
  } else {
    // response output - data error
    $response['status'] = 'error';

    header("Content-Type: application/json");
    echo json_encode($response);
  }

  // si no coincideix cap endopoint, error
} else {
  // response output - data error
  $response['status'] = 'error 2 url api';
  header("Content-Type: application/json");
  echo json_encode($response);
  exit();
}
