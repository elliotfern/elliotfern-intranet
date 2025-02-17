<?php
/*
 * BACKEND CINEMA
 * FUNCIONS UPDATE
 * @update_book_ajax
 */

use App\Helpers\JwtHelper;

$secretKey = $_ENV['TOKEN'];

// Configuración de cabeceras para aceptar JSON y responder JSON
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: https://gestio.elliotfern.com");
header("Access-Control-Allow-Methods: PUT");

// Obtener el encabezado Authorization
$headers = apache_request_headers();
if (!isset($headers['Authorization'])) {
  header('HTTP/1.1 401 Unauthorized');
  echo json_encode(['error' => 'Missing Authorization header']);
  exit();
}

$authHeader = $headers['Authorization'];
list($jwt) = sscanf($authHeader, 'Bearer %s');

if (!$jwt) {
  header('HTTP/1.1 401 Unauthorized');
  echo json_encode(['error' => 'Invalid Authorization header']);
  exit();
}

$decoded = JwtHelper::verifyJwt($jwt, $secretKey);
if (!$decoded) {
  header('HTTP/1.1 401 Unauthorized');
  echo json_encode(['error' => 'Invalid token']);
  exit();
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
  header('HTTP/1.1 405 Method Not Allowed');
  echo json_encode(['error' => 'Method not allowed']);
  exit();
}

// Dominio permitido (modifica con tu dominio)
$allowed_origin = "https://gestio.elliotfern.com";

// Verificar el encabezado 'Origin'
if (isset($_SERVER['HTTP_ORIGIN'])) {
  if ($_SERVER['HTTP_ORIGIN'] !== $allowed_origin) {
    http_response_code(403); // Respuesta 403 Forbidden
    echo json_encode(["error" => "Acceso denegado. Origen no permitido."]);
    exit;
  }
}

// RUTA PARA ACTUALIZAR PELICULA

// ruta GET => "/api/cinema/put/?type=pelicula"
if (isset($_GET['type']) && $_GET['type'] == 'pelicula') {
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

  $pelicula = isset($data['pelicula']) ? data_input($data['pelicula']) : ($hasError = true);
  $pelicula_es = isset($data['pelicula_es']) ? data_input($data['pelicula_es']) : ($hasError = true);
  $any = isset($data['any']) ? data_input($data['any']) : ($hasError = true);
  $director = isset($data['director']) ? $data['director'] : null;
  $genere = isset($data['genere']) ? $data['genere'] : null;
  $pais = isset($data['pais']) ? $data['pais'] : null;
  $lang = isset($data['lang']) ? $data['lang'] : null;
  $img = isset($data['img']) ? $data['img'] : null;
  $dataVista = isset($data['dataVista']) ? data_input($data['dataVista']) : ($hasError = true);
  $descripcio = isset($data['descripcio']) ? html_entity_decode($data['descripcio']) : ($hasError = true);
  $id = isset($data['id']) ? data_input($data['id']) : ($hasError = true);

  $timestamp = date('Y-m-d');
  $dateModified = $timestamp;


  global $conn;
  $sql = "UPDATE 11_db_pelicules SET pelicula=:pelicula, pelicula_es=:pelicula_es, director=:director, any=:any, genere=:genere, img=:img, pais=:pais, lang=:lang, dataVista=:dataVista, dateModified=:dateModified, descripcio=:descripcio WHERE id=:id";
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

  // Verificación y filtrado para el campo 'name'
  if (empty($data["name"])) {
    $hasError = true;
  } else {
    $name = data_input($data['name']);
  }

  // Verificación y filtrado para el campo 'startYear'
  if (empty($data["startYear"])) {
    $hasError = true;
  } else {
    $startYear = $data['startYear'];
  }

  // Verificación y filtrado para el campo 'endYear'
  if (empty($data["endYear"])) {
    $hasError = true;
  } else {
    $endYear = $data['endYear'];
  }

  // Verificación y filtrado para el campo 'season'
  if (empty($data["season"])) {
    $hasError = true;
  } else {
    $season = $data['season'];
  }

  // Verificación y filtrado para el campo 'chapter'
  if (empty($data["chapter"])) {
    $hasError = true;
  } else {
    $chapter = $data['chapter'];
  }

  // Verificación y filtrado para el campo 'director'
  if (empty($data["director"])) {
    $hasError = true;
  } else {
    $director = $data['director'];
  }

  // Verificación y filtrado para el campo 'lang'
  if (empty($data["lang"])) {
    $hasError = true;
  } else {
    $lang = $data['lang'];
  }

  // Verificación y filtrado para el campo 'img'
  if (empty($data["img"])) {
    $hasError = true;
  } else {
    $img = $data['img'];
  }

  // Verificación y filtrado para el campo 'genre'
  if (empty($data["genre"])) {
    $hasError = true;
  } else {
    $genre = $data['genre'];
  }

  // Verificación y filtrado para el campo 'producer'
  if (empty($data["producer"])) {
    $hasError = true;
  } else {
    $producer = $data['producer'];
  }

  // Verificación y filtrado para el campo 'country'
  if (empty($data["country"])) {
    $hasError = true;
  } else {
    $country = $data['country'];
  }

  // Verificación y filtrado para el campo 'descripcio'
  if (empty($data["descripcio"])) {
    $hasError = true;
  } else {
    $descripcio = html_entity_decode($data['descripcio']);
  }

  $id = $data['id'];
  $dateModified = date('Y-m-d');

  if ($hasError == false) {
    global $conn;
    $sql = "UPDATE 11_db_cinema_series_tv SET name=:name, startYear=:startYear, endYear=:endYear, season=:season, chapter=:chapter, director=:director, lang=:lang, img=:img, genre=:genre, producer=:producer, country=:country, dateModified=:dateModified, descripcio=:descripcio WHERE id=:id";
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

  // si no coincideix cap endopoint, error
} else {
  // response output - data error
  $response['status'] = 'error 2 url api';
  header("Content-Type: application/json");
  echo json_encode($response);
  exit();
}
