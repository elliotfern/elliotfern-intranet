<?php

namespace App\Controllers;

use App\Models\VaultModel;

class VaultController2
{
    private $passwordModel;
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->passwordModel = new VaultModel($conn);
    }

    // Mostrar contraseñas, el controlador obtiene datos del Modelo
    public function showPasswords($vaultId)
    {
        // Validar conexión y parámetros
        if (!$this->conn) {
            echo json_encode(['error' => 'Database connection failed']);
            return;
        }

        if (!is_numeric($vaultId)) {
            echo json_encode(['error' => 'Invalid ID']);
            return;
        }

        // Delegar la operación al Modelo para obtener las contraseñas
        $passwords = $this->passwordModel->getPasswords($vaultId);

        if ($passwords) {
            // Si hay contraseñas, devolverlas en formato JSON
            return $passwords;
        } else {
            // Si no hay contraseñas, devolver un mensaje de error
            echo json_encode(['error' => 'Passwords not found']);
        }
    }

    // Agregar una nueva contraseña (Delegar operación al Modelo)
    public function addPassword($userId, $serviceName, $password, $type, $url)
    {
        // Delegar la operación al Modelo para guardar la contraseña
        $result = $this->passwordModel->savePassword($userId, $serviceName, $password, $type, $url);

        if ($result) {
            // Redirigir a la página de confirmación o mostrar mensaje
            header("Location: /vault/elliot/31");
        } else {
            echo json_encode(['error' => 'Failed to save password']);
        }
    }

    // Obtener una contraseña específica (Delegar operación al Modelo)
    public function getPassword($vaultId)
    {
        // Obtener la contraseña desde el Modelo
        $password = $this->passwordModel->getPassword($vaultId);

        if ($password) {
            echo json_encode($password);
        } else {
            echo json_encode(['error' => 'Password not found']);
        }
    }
}
