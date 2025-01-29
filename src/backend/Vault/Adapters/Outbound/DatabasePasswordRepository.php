<?php

namespace App\Vault\Adapters\Outbound;

use App\Vault\Core\Ports\Out\PasswordRepositoryInterface;
use PDO;

class DatabasePasswordRepository implements PasswordRepositoryInterface
{
    private $conn;

    // Constructor para recibir la conexión PDO
    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function getPasswords(int $vaultId): array
    {
        try {
            $sql = "SELECT v.id, v.servei, v.usuari, v.password, t.tipus, v.web, v.dateModified 
            FROM db_vault AS v
            LEFT JOIN db_vault_type AS t ON v.tipus = t.id
            WHERE client = :vaultId";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':vaultId', $vaultId, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (\PDOException $e) {
            error_log('Error al obtener las contraseñas: ' . $e->getMessage());
            return [];
        }
    }

    public function savePassword(int $userId, string $serviceName, string $password, string $type, string $url): void
    {
        try {
            $sql = "INSERT INTO passwords (user_id, service_name, password, type, url) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$userId, $serviceName, $password, $type, $url]);
        } catch (\PDOException $e) {
            error_log('Error al guardar la contraseña: ' . $e->getMessage());
        }
    }
}
