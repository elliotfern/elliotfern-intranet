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
            $sql = "SELECT v.id, v.servei, v.usuari, t.tipus, v.web, v.dateModified 
            FROM db_vault AS v
            LEFT JOIN db_vault_type AS t ON v.tipus = t.id
            WHERE client = :vaultId
            ORDER BY v.servei ASC";
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

    public function getPasswordDesencrypt(int $serviceId): array
    {
        try {
            $sql = "SELECT v.password, v.iv
            FROM db_vault AS v
            WHERE id = :vaultId";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':vaultId', $serviceId, PDO::PARAM_INT);
            $stmt->execute();
            $data = $stmt->fetch();

            $encryptionToken = $_ENV['ENCRYPTATION_TOKEN'];

            if (!$data) {
                echo json_encode(['error' => 'Password not found']);
                exit;  // Detener la ejecución del script
            }

            $iv2 = base64_decode($data['iv']);
            if (strlen($iv2) !== openssl_cipher_iv_length('aes-256-cbc')) {
                return ['error' => 'Invalid IV length'];
            }

            if ($data) {
                $decryptedPassword = openssl_decrypt($data['password'], 'aes-256-cbc', $encryptionToken, 0, $iv2);
                return ['password' => $decryptedPassword];
            }

            return null;
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
