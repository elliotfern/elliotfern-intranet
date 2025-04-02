<?php
/*
 * BACKEND LINK
 * FUNCIONS INSERT LINK
 */

header("Content-Type: application/json");

// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('HTTP/1.1 405 Method Not Allowed');
  echo json_encode(['error' => 'Method not allowed']);
  exit();
}

// a) Inserir link
if (isset($_GET['link'])) {

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

  $nom = !empty($data['nom']) ? data_input($data['nom']) : ($hasError = true);
  $web = !empty($data['web']) ? data_input($data['web']) : ($hasError = true);
  $cat = !empty($data['cat']) ? data_input($data['cat']) : ($hasError = true);
  $lang = !empty($data['lang']) ? data_input($data['lang']) : ($hasError = true);
  $tipus = !empty($data['tipus']) ? data_input($data['tipus']) : ($hasError = true);

  $timestamp = date('Y-m-d');
  $dateCreated = $timestamp;
  $dateModified = $timestamp;

  if (!$hasError) {
    global $conn;
    $sql = "INSERT INTO db_links SET nom=:nom, web=:web, cat=:cat, lang=:lang, tipus=:tipus, dateCreated=:dateCreated, dateModified=:dateModified";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
    $stmt->bindParam(":web", $web, PDO::PARAM_STR);
    $stmt->bindParam(":cat", $cat, PDO::PARAM_INT);
    $stmt->bindParam(":lang", $lang, PDO::PARAM_INT);
    $stmt->bindParam(":tipus", $tipus, PDO::PARAM_INT);
    $stmt->bindParam(":dateCreated", $dateCreated, PDO::PARAM_STR);
    $stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);

    $stmt->execute();
    // response output
    $response = array(
      'status' => 'success',
    );

    echo json_encode($response);
  } else {
    // response output - data error
    $response['status'] = 'error';

    echo json_encode($response);
  }
} else {
  // response output - data error
  $response['status'] = 'error';

  echo json_encode($response);
}
