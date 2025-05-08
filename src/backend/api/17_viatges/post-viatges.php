<?php
/*
 * BACKEND VIATGES
 * FUNCIONS INSERT
 * 
 */

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.1 405 Method Not Allowed');
    echo json_encode(['error' => 'Method not allowed']);
    exit();
}

// a) Inserir espai
if (isset($_GET['espai'])) {

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

    $nom               = !empty($data['nom']) ? data_input($data['nom']) : ($hasError = true);
    $EspNomCast        = !empty($data['EspNomCast']) ? data_input($data['EspNomCast']) : ($hasError = false);
    $EspNomEng         = !empty($data['EspNomEng']) ? data_input($data['EspNomEng']) : ($hasError = false);
    $EspNomIt          = !empty($data['EspNomIt']) ? data_input($data['EspNomIt']) : ($hasError = false);
    $slug              = !empty($data['slug']) ? data_input($data['slug']) : ($hasError = true);
    $EspFundacio       = !empty($data['EspFundacio']) ? data_input($data['EspFundacio']) : ($hasError = false);
    $EspDescripcio     = !empty($data['EspDescripcio']) ? data_input($data['EspDescripcio']) : ($hasError = true);
    $EspDescripcioCast = !empty($data['EspDescripcioCast']) ? data_input($data['EspDescripcioCast']) : ($hasError = false);
    $EspDescripcioEng  = !empty($data['EspDescripcioEng']) ? data_input($data['EspDescripcioEng']) : ($hasError = false);
    $EspDescripcioIt   = !empty($data['EspDescripcioIt']) ? data_input($data['EspDescripcioIt']) : ($hasError = false);
    $EspTipus          = !empty($data['EspTipus']) ? data_input($data['EspTipus']) : ($hasError = true);
    $EspWeb            = !empty($data['EspWeb']) ? data_input($data['EspWeb']) : ($hasError = true);
    $idCiutat          = !empty($data['idCiutat']) ? data_input($data['idCiutat']) : ($hasError = true);
    $img               = !empty($data['img']) ? data_input($data['img']) : ($hasError = true);
    $coordinades_latitud = !empty($data['coordinades_latitud']) ? data_input($data['coordinades_latitud']) : ($hasError = false);
    $coordinades_longitud = !empty($data['coordinades_longitud']) ? data_input($data['coordinades_longitud']) : ($hasError = false);

    $timestamp = date('Y-m-d');
    $dateCreated = $timestamp;
    $dateModified = $timestamp;

    if (!$hasError) {
        global $conn;
        $sql = "INSERT INTO db_travel_places 
        SET nom = :nom,
            EspNomCast = :EspNomCast,
            EspNomEng = :EspNomEng,
            EspNomIt = :EspNomIt,
            slug = :slug,
            EspFundacio = :EspFundacio,
            EspDescripcio = :EspDescripcio,
            EspDescripcioCast = :EspDescripcioCast,
            EspDescripcioEng = :EspDescripcioEng,
            EspDescripcioIt = :EspDescripcioIt,
            EspTipus = :EspTipus,
            EspWeb = :EspWeb,
            idCiutat = :idCiutat,
            img = :img,
            coordinades_latitud = :coordinades_latitud,
            coordinades_longitud = :coordinades_longitud,
            dateCreated = :dateCreated,
            dateModified = :dateModified";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
        $stmt->bindParam(":EspNomCast", $EspNomCast, PDO::PARAM_STR);
        $stmt->bindParam(":EspNomEng", $EspNomEng, PDO::PARAM_STR);
        $stmt->bindParam(":EspNomIt", $EspNomIt, PDO::PARAM_STR);
        $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
        $stmt->bindParam(":EspFundacio", $EspFundacio, PDO::PARAM_STR);
        $stmt->bindParam(":EspDescripcio", $EspDescripcio, PDO::PARAM_STR);
        $stmt->bindParam(":EspDescripcioCast", $EspDescripcioCast, PDO::PARAM_STR);
        $stmt->bindParam(":EspDescripcioEng", $EspDescripcioEng, PDO::PARAM_STR);
        $stmt->bindParam(":EspDescripcioIt", $EspDescripcioIt, PDO::PARAM_STR);
        $stmt->bindParam(":EspTipus", $EspTipus, PDO::PARAM_INT);
        $stmt->bindParam(":EspWeb", $EspWeb, PDO::PARAM_STR);
        $stmt->bindParam(":idCiutat", $idCiutat, PDO::PARAM_INT);
        $stmt->bindParam(":img", $img, PDO::PARAM_INT);
        $stmt->bindParam(":coordinades_latitud", $coordinades_latitud, PDO::PARAM_STR);
        $stmt->bindParam(":coordinades_longitud", $coordinades_longitud, PDO::PARAM_STR);
        $stmt->bindParam(":dateCreated", $dateCreated, PDO::PARAM_STR);
        $stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);

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
}
