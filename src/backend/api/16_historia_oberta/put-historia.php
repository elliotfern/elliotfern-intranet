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


    // b) Inserir esdeveniment/persona
} else if (isset($_GET['esdevenimentPersona'])) {

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

    $idEsdev     = !empty($data['idEsdev']) ? data_input($data['idEsdev']) : ($hasError = true);
    $idPersona   = !empty($data['idPersona']) ? data_input($data['idPersona']) : ($hasError = true);
    $id          = !empty($data['id']) ? data_input($data['id']) : ($hasError = true);

    if (!$hasError) {

        global $conn;
        $sql = "UPDATE db_historia_esdeveniment_persones 
        SET  idEsdev = :idEsdev, 
            idPersona = :idPersona
        WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":idEsdev", $idEsdev, PDO::PARAM_INT);
        $stmt->bindParam(":idPersona", $idPersona, PDO::PARAM_INT);
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

    // b) modificar esdeveniment/organitzacio
} else if (isset($_GET['esdevenimentOrganitzacio'])) {

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

    $idEsde  = !empty($data['idEsde']) ? data_input($data['idEsde']) : ($hasError = true);
    $idOrg   = !empty($data['idOrg']) ? data_input($data['idOrg']) : ($hasError = true);
    $id      = !empty($data['id']) ? data_input($data['id']) : ($hasError = true);

    if (!$hasError) {
        global $conn;
        $sql = "UPDATE db_historia_esdeveniment_organitzacio 
        SET idEsde = :idEsde, 
            idOrg = :idOrg
        WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":idEsde", $idEsde, PDO::PARAM_INT);
        $stmt->bindParam(":idOrg", $idOrg, PDO::PARAM_INT);
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

    // b) modificar persona / carrec
} else if (isset($_GET['personaCarrec'])) {

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

    $idPersona = !empty($data['idPersona']) ? data_input($data['idPersona']) : ($hasError = true);
    $carrecNom = !empty($data['carrecNom']) ? data_input($data['carrecNom']) : ($hasError = true);
    $carrecNomCast = !empty($data['carrecNomCast']) ? data_input($data['carrecNomCast']) : ($hasError = false);
    $carrecNomEng = !empty($data['carrecNomEng']) ? data_input($data['carrecNomEng']) : ($hasError = false);
    $carrecNomIt = !empty($data['carrecNomIt']) ? data_input($data['carrecNomIt']) : ($hasError = false);
    $carrecInici = !empty($data['carrecInici']) ? data_input($data['carrecInici']) : ($hasError = true);
    $carrecFi = !empty($data['carrecFi']) ? data_input($data['carrecFi']) : ($hasError = false);
    $idOrg = !empty($data['idOrg']) ? data_input($data['idOrg']) : ($hasError = true);
    $id = !empty($data['id']) ? data_input($data['id']) : ($hasError = true);

    if (!$hasError) {
        global $conn;
        $sql = "UPDATE aux_persones_carrecs
        SET idOrg = :idOrg,
            idPersona = :idPersona,
            carrecNom = :carrecNom,
            carrecNomCast = :carrecNomCast,
            carrecNomEng = :carrecNomEng,
            carrecNomIt = :carrecNomIt,
            carrecInici = :carrecInici,
            carrecFi = :carrecFi
             WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":idPersona", $idPersona, PDO::PARAM_INT);
        $stmt->bindParam(":carrecNom", $carrecNom, PDO::PARAM_STR);
        $stmt->bindParam(":carrecNomCast", $carrecNomCast, PDO::PARAM_STR);
        $stmt->bindParam(":carrecNomEng", $carrecNomEng, PDO::PARAM_STR);
        $stmt->bindParam(":carrecNomIt", $carrecNomIt, PDO::PARAM_STR);
        $stmt->bindParam(":carrecInici", $carrecInici, PDO::PARAM_STR);
        $stmt->bindParam(":carrecFi", $carrecFi, PDO::PARAM_STR);
        $stmt->bindParam(":idOrg", $idOrg, PDO::PARAM_INT);
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

    // b) Inserir organitzacio
} else if (isset($_GET['organitzacio'])) {

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

    $nomOrg = !empty($data['nomOrg']) ? data_input($data['nomOrg']) : ($hasError = true);
    $nomOrgCast = !empty($data['nomOrgCast']) ? data_input($data['nomOrgCast']) : ($hasError = false);
    $nomOrgEng = !empty($data['nomOrgEng']) ? data_input($data['nomOrgEng']) : ($hasError = false);
    $nomOrgIt = !empty($data['nomOrgIt']) ? data_input($data['nomOrgIt']) : ($hasError = false);
    $slug = !empty($data['slug']) ? data_input($data['slug']) : ($hasError = true);
    $orgSig = !empty($data['orgSig']) ? data_input($data['orgSig']) : ($hasError = false);
    $dataFunda = !empty($data['dataFunda']) ? data_input($data['dataFunda']) : ($hasError = true);
    $dataDiss = !empty($data['dataDiss']) ? data_input($data['dataDiss']) : ($hasError = false);
    $orgPais = !empty($data['orgPais']) ? data_input($data['orgPais']) : ($hasError = true);
    $orgCiutat = !empty($data['orgCiutat']) ? data_input($data['orgCiutat']) : ($hasError = true);
    $orgSubEtapa = !empty($data['orgSubEtapa']) ? data_input($data['orgSubEtapa']) : ($hasError = true);
    $orgTipus = !empty($data['orgTipus']) ? data_input($data['orgTipus']) : ($hasError = true);
    $orgIdeologia = !empty($data['orgIdeologia']) ? data_input($data['orgIdeologia']) : ($hasError = false);
    $img = !empty($data['img']) ? data_input($data['img']) : ($hasError = true);
    $id = !empty($data['id']) ? data_input($data['id']) : ($hasError = true);

    $timestamp = date('Y-m-d');
    $dateModified = $timestamp;

    if (!$hasError) {
        global $conn;
        $sql = "UPDATE db_historia_organitzacions
        SET nomOrg = :nomOrg,
            nomOrgCast = :nomOrgCast,
            nomOrgEng = :nomOrgEng,
            nomOrgIt = :nomOrgIt,
            slug = :slug,
            orgSig = :orgSig,
            dataFunda = :dataFunda,
            dataDiss = :dataDiss,
            orgPais = :orgPais,
            orgCiutat = :orgCiutat,
            orgSubEtapa = :orgSubEtapa,
            orgTipus = :orgTipus,
            orgIdeologia = :orgIdeologia,
            img = :img,
            dateModified = :dateModified
            WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(":nomOrg", $nomOrg, PDO::PARAM_STR);
        $stmt->bindParam(":nomOrgCast", $nomOrgCast, PDO::PARAM_STR);
        $stmt->bindParam(":nomOrgEng", $nomOrgEng, PDO::PARAM_STR);
        $stmt->bindParam(":nomOrgIt", $nomOrgIt, PDO::PARAM_STR);
        $stmt->bindParam(":slug", $slug, PDO::PARAM_STR);
        $stmt->bindParam(":orgSig", $orgSig, PDO::PARAM_STR);
        $stmt->bindParam(":dataFunda", $dataFunda, PDO::PARAM_STR);
        $stmt->bindParam(":dataDiss", $dataDiss, PDO::PARAM_STR);
        $stmt->bindParam(":orgPais", $orgPais, PDO::PARAM_INT);
        $stmt->bindParam(":orgCiutat", $orgCiutat, PDO::PARAM_INT);
        $stmt->bindParam(":orgSubEtapa", $orgSubEtapa, PDO::PARAM_INT);
        $stmt->bindParam(":orgTipus", $orgTipus, PDO::PARAM_INT);
        $stmt->bindParam(":orgIdeologia", $orgIdeologia, PDO::PARAM_INT);
        $stmt->bindParam(":img", $img, PDO::PARAM_INT);
        $stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);

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
