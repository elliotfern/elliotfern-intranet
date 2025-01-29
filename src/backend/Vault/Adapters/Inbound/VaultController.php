<?php

namespace App\Vault\Adapters\Inbound;

use App\Vault\Core\Services\VaultService;

class VaultController
{
    private $vaultService;

    // Constructor donde inyectamos el servicio VaultService
    public function __construct(VaultService $vaultService)
    {
        $this->vaultService = $vaultService; // Almacenamos el servicio en una propiedad
    }

    // Método para obtener las contraseñas de un "vault" (bóveda)
    public function getPasswords(int $vaultId)
    {
        // Llamamos al servicio VaultService para obtener las contraseñas
        $passwords = $this->vaultService->getPasswords($vaultId);

        // Verificar que estamos recibiendo un array
        if (!is_array($passwords)) {
            // Si no es un array, devolver un array vacío
            return [];
        }

        return $passwords;
    }

    // Método para guardar una nueva contraseña en la bóveda
    public function savePassword(int $userId, string $serviceName, string $password, string $type, string $url)
    {
        // Llamamos al servicio VaultService para guardar la nueva contraseña
        $this->vaultService->savePassword($userId, $serviceName, $password, $type, $url);

        // Respondemos con un mensaje de éxito en formato JSON
        echo json_encode(['status' => 'success']);
    }
}
