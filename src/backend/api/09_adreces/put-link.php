<?php
/*
 * BACKEND LIBRARY
 * FUNCIONS UPDATE BOOK
 * @update_book_ajax
 */

header("Content-Type: application/json");

// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
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

  // Validar los datos recibidos
  $hasError = false;

  $nom = !empty($data['nom']) ? data_input($data['nom']) : null;
  $web = !empty($data['web']) ? data_input($data['web']) : null;
  $cat = !empty($data['cat']) ? data_input($data['cat']) : null;
  $lang = !empty($data['lang']) ? data_input($data['lang']) : null;
  $tipus = !empty($data['tipus']) ? data_input($data['tipus']) : null;

  // Verificar si alguno de los campos está vacío
  if (!$nom || !$web || !$cat || !$lang || !$tipus) {
    $hasError = true;
    $response['status'] = 'error';
    $response['message'] = 'Faltan datos obligatorios en la solicitud.';
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
  }

  // Asignar valores adicionales
  $timestamp = date('Y-m-d');
  $dateModified = $timestamp;

  // Usar el ID desde el JSON si es que está presente
  $id = isset($data['id']) ? (int)$data['id'] : null;

  // Verificar si el ID es válido
  if ($id === null) {
    $hasError = true;
    $response['status'] = 'error';
    $response['message'] = 'ID no proporcionado o inválido.';
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
  }

  if (!$hasError) {
    $sql = "UPDATE db_links
      SET nom=:nom, web=:web, cat=:cat, lang=:lang, tipus=:tipus, dateModified=:dateModified 
      WHERE id=:id";

    global $conn;
    $stmt = $conn->prepare($sql);

    // Vincular los parámetros
    $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
    $stmt->bindParam(":web", $web, PDO::PARAM_STR);
    $stmt->bindParam(":cat", $cat, PDO::PARAM_INT);
    $stmt->bindParam(":lang", $lang, PDO::PARAM_INT);
    $stmt->bindParam(":tipus", $tipus, PDO::PARAM_INT);
    $stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);

    // Ejecutar la consulta
    if ($stmt->execute()) {
      // Si la ejecución fue exitosa
      $response['status'] = 'success';
      $response['message'] = 'Datos actualizados correctamente.';
    } else {
      // Si hubo un error en la ejecución
      $response['status'] = 'error';
      $response['message'] = 'Hubo un problema al actualizar los datos en la base de datos.';
    }

    // Responder con el resultado
    header("Content-Type: application/json");
    echo json_encode($response);
  } else {
    // Si los datos no son válidos o hubo un error en los datos de entrada
    $response['status'] = 'error';
    $response['message'] = 'Los datos enviados no son válidos o hay errores en el formulario.';

    header("Content-Type: application/json");
    echo json_encode($response);
  }
} else {
  // response output - data error
  $response['status'] = 'error';

  header("Content-Type: application/json");
  echo json_encode($response);
}
