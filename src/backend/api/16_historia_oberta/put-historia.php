<?php
/*
 * BACKEND HISTORIA
 * FUNCIONS INSERT
 * 
 */

// Check if the request method is PUT
if ($_SERVER['REQUEST_METHOD'] !== 'PUT') {
    header('HTTP/1.1 405 Method Not Allowed');
    echo json_encode(['error' => 'Method not allowed']);
    exit();
}

// a) Inserir pelicula
if (isset($_GET['esdeveniment'])) {

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

    $esdeNom       = !empty($data['esdeNom']) ? data_input($data['esdeNom']) : ($hasError = true);
    $esdeNomCast   = !empty($data['esdeNomCast']) ? data_input($data['esdeNomCast']) : '';
    $esdeNomEng    = !empty($data['esdeNomEng']) ? data_input($data['esdeNomEng']) : '';
    $esdeNomIt     = !empty($data['esdeNomIt']) ? data_input($data['esdeNomIt']) : '';
    $slug          = !empty($data['slug']) ? data_input($data['slug']) : ($hasError = true);
    $esdeDataIDia  = isset($data['esdeDataIDia']) ? (int) $data['esdeDataIDia'] : null;
    $esdeDataIMes  = isset($data['esdeDataIMes']) ? (int) $data['esdeDataIMes'] : null;
    $esdeDataIAny  = isset($data['esdeDataIAny']) ? (int) $data['esdeDataIAny'] : ($hasError = true);
    $esdeDataFDia  = isset($data['esdeDataFDia']) ? (int) $data['esdeDataFDia'] : null;
    $esdeDataFMes  = isset($data['esdeDataFMes']) ? (int) $data['esdeDataFMes'] : null;
    $esdeDataFAny  = isset($data['esdeDataFAny']) ? (int) $data['esdeDataFAny'] : null;
    $esSubEtapa    = isset($data['esSubEtapa']) ? (int) $data['esSubEtapa'] : null;
    $esdeCiutat    = !empty($data['esdeCiutat']) ? data_input($data['esdeCiutat']) : '';
    $img           = !empty($data['img']) ? data_input($data['img']) : '';
    $descripcio    = !empty($data['descripcio']) ? data_input($data['descripcio']) : '';

    $id    = !empty($data['id']) ? data_input($data['id']) : ($hasError = true);
    $timestamp = date('Y-m-d');
    $dateModified = $timestamp;

    if (!$hasError) {
        global $conn;

        $sql = "UPDATE db_historia_esdeveniments 
        SET esdeNom = :esdeNom, 
            esdeNomCast = :esdeNomCast, 
            esdeNomEng = :esdeNomEng, 
            esdeNomIt = :esdeNomIt, 
            slug = :slug, 
            esdeDataIDia = :esdeDataIDia, 
            esdeDataIMes = :esdeDataIMes, 
            esdeDataIAny = :esdeDataIAny, 
            esdeDataFDia = :esdeDataFDia, 
            esdeDataFMes = :esdeDataFMes, 
            esdeDataFAny = :esdeDataFAny, 
            esSubEtapa = :esSubEtapa,
            img = :img,
            descripcio = :descripcio,
            esdeCiutat = :esdeCiutat,
            dateModified = :dateModified
        WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":esdeNom", $esdeNom, PDO::PARAM_STR);
        $stmt->bindParam(":esdeNomCast", $esdeNomCast, PDO::PARAM_STR);
        $stmt->bindParam(":esdeNomEng", $esdeNomEng, PDO::PARAM_STR);
        $stmt->bindParam(":esdeNomIt", $esdeNomIt, PDO::PARAM_STR);
        $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
        $stmt->bindParam(":esdeDataIDia", $esdeDataIDia, PDO::PARAM_INT);
        $stmt->bindParam(":esdeDataIMes", $esdeDataIMes, PDO::PARAM_INT);
        $stmt->bindParam(":esdeDataIAny", $esdeDataIAny, PDO::PARAM_INT);
        $stmt->bindParam(":esdeDataFDia", $esdeDataFDia, PDO::PARAM_INT);
        $stmt->bindParam(":esdeDataFMes", $esdeDataFMes, PDO::PARAM_INT);
        $stmt->bindParam(":esdeDataFAny", $esdeDataFAny, PDO::PARAM_INT);
        $stmt->bindParam(":esSubEtapa", $esSubEtapa, PDO::PARAM_INT);
        $stmt->bindParam(":esdeCiutat", $esdeCiutat, PDO::PARAM_STR);
        $stmt->bindParam(":img", $img, PDO::PARAM_INT);
        $stmt->bindParam(":descripcio", $descripcio, PDO::PARAM_STR);
        $stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
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


    // si no hi ha cap endpoint valid, mostrar error:
} else {
    // response output - data error
    $response['status'] = 'error';
    header("Content-Type: application/json");
    echo json_encode($response);
    exit();
}
