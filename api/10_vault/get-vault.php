<?php

// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header('HTTP/1.1 405 Method Not Allowed');
    echo json_encode(['error' => 'Method not allowed']);
    exit();
} else {
    // Verificar si se proporciona un token en el encabezado de autorización
    $headers = apache_request_headers();

    if (isset($headers['Authorization'])) {
        $token = str_replace('Bearer ', '', $headers['Authorization']);

        // Verificar el token aquí según tus requerimientos
        if (verificarToken($token)) {
            // Token válido, puedes continuar con el código para obtener los datos del usuario

            // 1) Llistat topics
            // ruta GET => "https://control.elliotfern/api/vault/get/?type=password&id=1"
            if ( (isset($_GET['type']) && $_GET['type'] == 'password') && (is_numeric($_GET['id']) ) ) {
                $id = $_GET['id'];

                global $conn;
                
                $query = "SELECT v.serveiPas
                FROM  epgylzqu_elliotfern_intranet.db_vault AS v
                WHERE v.id = :param";

                 // Preparar la consulta
                 $stmt = $conn->prepare($query);

                 $stmt->bindParam(':param', $id, PDO::PARAM_INT);
                
                 // Ejecutar la consulta
                 $stmt->execute();
                 
                 // Verificar si se encontraron resultados
                 if ($stmt->rowCount() === 0) {
                     echo json_encode(['error' => 'No rows found']);
                     exit;
                 }
 
                 // Recopilar los resultados
                 $data = $stmt->fetch(PDO::FETCH_ASSOC);
                 
                 // Establecer el encabezado de respuesta a JSON
                 header('Content-Type: application/json');
                 
                 // Devolver los datos en formato JSON
                 echo json_encode($data);

            } else {
                // Si 'type', 'id' o 'token' están ausentes o 'type' no es 'user' en la URL
                header('HTTP/1.1 403 Forbidden');
                echo json_encode(['error' => 'Something get wrong']);
                exit();
            }

        } else {
        // Token no válido
        header('HTTP/1.1 403 Forbidden');
        echo json_encode(['error' => 'Invalid token']);
        exit();
        }

    } else {
    // No se proporcionó un token
    header('HTTP/1.1 403 Forbidden');
    echo json_encode(['error' => 'Access not allowed']);
    exit();
    }
}