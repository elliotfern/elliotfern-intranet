<?php

use App\Vault\Adapters\Inbound\VaultController;
use App\Vault\Core\Services\VaultService;
use App\Vault\Adapters\Outbound\DatabasePasswordRepository;
use App\Config\Database;

// Configuración de cabeceras para aceptar JSON y responder JSON
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: https://elliot.cat");
header("Access-Control-Allow-Methods: GET");

// Verificar si se ha recibido un parámetro válido
if (isset($_GET['llistat_serveis'])) {

    // Conectar a la base de datos
    $conn = Database::getConnection();

    // Crear el repositorio
    $passwordRepository = new DatabasePasswordRepository($conn);

    // Pasar el repositorio a VaultService
    $vaultService = new VaultService($passwordRepository);

    // Pasar el servicio correctamente a VaultController
    $passwordController = new VaultController($vaultService);

    // Llamar al método getPasswords con el ID dinámico
    $passwords = $passwordController->getPasswords();

    // Verificar que hemos obtenido un array de datos
    header('Content-Type: application/json');
    if (is_array($passwords)) {
        // Devolver los datos como un array JSON
        echo json_encode($passwords, JSON_PRETTY_PRINT);
    } else {
        // Si no se ha obtenido un array, devolver un error en formato JSON
        echo json_encode(["error" => "No se encontraron contraseñas"]);
    }
} elseif (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Conectar a la base de datos
    $conn = Database::getConnection();

    // Crear el repositorio
    $passwordRepository = new DatabasePasswordRepository($conn);

    // Pasar el repositorio a VaultService
    $vaultService = new VaultService($passwordRepository);

    // Pasar el servicio correctamente a VaultController
    $passwordController = new VaultController($vaultService);

    // Obtener el user_id
    $userId = isset($_GET['id']) ? (int)$_GET['id'] : 1;

    // Llamar al método getPasswords con el ID dinámico
    $passwords = $passwordController->getPasswordDesencrypt($userId);

    // Verificar que hemos obtenido un array de datos
    header('Content-Type: application/json');
    if (is_array($passwords)) {
        // Devolver los datos como un array JSON
        echo json_encode($passwords, JSON_PRETTY_PRINT);
    } else {
        // Si no se ha obtenido un array, devolver un error en formato JSON
        echo json_encode(["error" => "No se encontraron contraseñas"]);
    }

    // Verificar si se ha recibido un parámetro válido
} else if (isset($_GET['serveiId'])) {
    $id = $_GET['serveiId'];

    $query = "SELECT v.id, v.servei, v.usuari, v.tipus, v.web, v.notes
    FROM db_vault AS v
    WHERE v.id = :id";

    // Preparar la consulta
    $stmt = $conn->prepare($query);

    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Ejecutar la consulta
    $stmt->execute();

    // Verificar si se encontraron resultados
    if ($stmt->rowCount() === 0) {
        echo json_encode(['error' => 'No rows found']);
        exit;
    }

    // Recopilar los resultados
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    // Devolver los datos en formato JSON
    echo json_encode($data);


    // Verificar si se ha recibido un parámetro válido
} else if (isset($_GET['tipusServeis'])) {

    $query = "SELECT v.id, v.tipus
    FROM db_vault_type AS v
    ORDER BY v.tipus";

    // Preparar la consulta
    $stmt = $conn->prepare($query);

    // Ejecutar la consulta
    $stmt->execute();

    // Verificar si se encontraron resultados
    if ($stmt->rowCount() === 0) {
        echo json_encode(['error' => 'No rows found']);
        exit;
    }

    // Recopilar los resultados
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Devolver los datos en formato JSON
    echo json_encode($data);
} else {
    echo json_encode(['error' => 'Invalid ID']);
}
