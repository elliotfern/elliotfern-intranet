<?php
/*
 * BACKEND LIBRARY
 * FUNCIONES INSERTAR LIBRO
 * @update_book_ajax
 */

$servidorMedia = '/home/epgylzqu/media.elliotfern.com/img/';

$tmpfilesize = isset($_FILES["fileToUpload"]["size"]) ? $_FILES["fileToUpload"]["size"] : 0;
$tmpfilename = isset($_FILES["fileToUpload"]["tmp_name"]) ? $_FILES["fileToUpload"]["tmp_name"] : 0;
$tmpfiletype = isset($_FILES["fileToUpload"]["type"]) ? $_FILES["fileToUpload"]["type"] : 0;

$type = $_POST['typeImg'];

if ($type == 1) {
    $typeName = "library-author"; 
} elseif ($type == 2) {
    $typeName = "library-book";
} elseif ($type == 7) {
    $typeName = "cinema-television";
} elseif ($type == 8) {
    $typeName = "cinema-movie";
} elseif ($type == 9) {
    $typeName = "cinema-actor";
} else {
    $typeName = "elliotfern";
}

// Ruta donde se guardarán las imágenes en el servidor
$target_dir =  $servidorMedia . '/' . $typeName . '/';

// Verificar si el directorio existe, si no, crearlo
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true); // Crear el directorio con permisos de escritura
}

// Verificar el tipo y tamaño del archivo antes de moverlo
if ( ($_FILES["fileToUpload"]["size"] < 2097152) && 
    (in_array($_FILES["fileToUpload"]["type"], ["image/jpeg", "image/jpg", "image/png", "image/gif"])) ) {

    // Generar un nombre único para evitar sobrescribir archivos
    $uniqueName = basename($_FILES['fileToUpload']['name']);
    $targetFile = $target_dir . $uniqueName;

    // Mover el archivo al servidor
    if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetFile)) {

        // Insertar los datos en la base de datos
        $nameImg = pathinfo($uniqueName, PATHINFO_FILENAME);  // Obtener solo el nombre sin la extensión
        $alt = data_input($_POST['alt']);
        $dateCreated = date('Y-m-d');

        // Realizar la inserción en la base de datos
        global $conn;
        $sql = "INSERT INTO db_img SET nameImg=:nameImg, typeImg=:typeImg, alt=:alt, dateCreated=:dateCreated";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":nameImg", $nameImg, PDO::PARAM_STR);
        $stmt->bindParam(":typeImg", $type, PDO::PARAM_INT);
        $stmt->bindParam(":alt", $alt, PDO::PARAM_STR);
        $stmt->bindParam(":dateCreated", $dateCreated, PDO::PARAM_STR);

        if ($stmt->execute()) {
            // Respuesta en caso de éxito
            $response = array(
                'status' => 'success',
                'message' => 'El archivo se ha subido y registrado correctamente.'
            );
        } else {
            // Respuesta en caso de error al insertar en la base de datos
            $response = array(
                'status' => 'error',
                'message' => 'Hubo un problema al insertar en la base de datos.'
            );
        }
    } else {
        // Respuesta en caso de error al mover el archivo
        $response = array(
            'status' => 'error',
            'message' => 'Hubo un problema al mover el archivo al servidor.'
        );
    }
} else {
    // Respuesta si el archivo no cumple con los requisitos
    $response = array(
        'status' => 'error',
        'message' => 'El archivo es demasiado grande o no es un tipo de imagen permitido.'
    );
}

header("Content-Type: application/json");
echo json_encode($response);
?>
