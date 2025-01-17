<?php

namespace App\Models;

use Dotenv\Dotenv;
use App\Models\Tables\CommonTable;

class VaultModel {
   
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Función para encriptar la contraseña
    private function encryptPassword($password)
    {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encryptedPassword = openssl_encrypt($password, 'aes-256-cbc', $_ENV['ENCRYPTATION_TOKEN'], 0, $iv);
        return ['password' => $encryptedPassword, 'iv' => base64_encode($iv)];
    }

    // Obtener contraseñas desde la base de datos
    public function getPasswords($vaultId)
        {
            try {
                // Obtén las configuraciones de las tablas y campos
                $fields = CommonTable::VAULT['fields'];
                $fields2 = CommonTable::VAULT_TYPE['fields'];
                $tableName = CommonTable::VAULT['tableName'];
                $tableName2 = CommonTable::VAULT_TYPE['tableName'];
                $clientField = $fields['client'];
        
                // Construye la consulta SQL
                $sql = "SELECT
                    t1.{$fields['id']} AS id,
                    t1.{$fields['servei']} AS servei,
                    t1.{$fields['usuari']} AS usuari,
                    t1.{$fields['password']} AS password,
                    t1.{$fields['tipus']} AS tipus_vault,
                    t1.{$fields['web']} AS web,
                    t1.{$fields['client']} AS client,
                    t1.{$fields['dateCreated']} AS date_created,
                    t1.{$fields['dateModified']} AS date_modified,
                    t2.{$fields2['tipus']} AS tipus_type
                FROM $tableName AS t1
                LEFT JOIN $tableName2 AS t2 ON t1.{$fields['tipus']} = t2.{$fields2['id']}
                WHERE t1.$clientField = :vaultId
                ORDER BY t1.{$fields['servei']}";

                // Preparar la consulta
                $stmt = $this->conn->prepare($sql);
        
                // Vincular el parámetro
                $stmt->bindParam(':vaultId', $vaultId, \PDO::PARAM_INT);
        
                // Ejecutar la consulta
                $stmt->execute();
        
                // Obtener los resultados
                $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
                // Retorna los resultados o null si no hay datos
                return $result ?: null;
            } catch (\PDOException $e) {
                // Manejo de errores
                error_log('Error en getPasswords: ' . $e->getMessage());
                return null;
            }
        }
        


    // Función para guardar la contraseña en la base de datos
    public function savePassword($userId, $serviceName, $password, $type, $url)
    {
        $encryptedData = $this->encryptPassword($password);
        $tableName = CommonTable::VAULT['tableName'];
        $fields = CommonTable::VAULT['fields'];

        $stmt = $this->conn->prepare(
            "INSERT INTO $tableName 
            ({$fields['client']}, {$fields['serveiNom']}, {$fields['serveiUsuari']}, {$fields['password']}, {$fields['serveiType']}, {$fields['serveiWeb']}, {$fields['iv']}) 
            VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bindParam(1, $userId);
        $stmt->bindParam(2, $serviceName);
        $stmt->bindParam(3, $serviceName);
        $stmt->bindParam(4, $encryptedData['password']);
        $stmt->bindParam(5, $type);
        $stmt->bindParam(6, $url);
        $stmt->bindParam(7, $encryptedData['iv']);
        $stmt->execute();
    }

    // Función para obtener una contraseña desencriptada
    public function getPassword($vaultId)
    {
        $encryptionToken = $_ENV['ENCRYPTATION_TOKEN'];

        if (!$encryptionToken) {
            return ['error' => 'Encryption token not defined'];
        }

        $tableName = CommonTable::VAULT['tableName'];
        $fields = CommonTable::VAULT['fields'];

        $stmt = $this->conn->prepare(
            "SELECT {$fields['password']}, {$fields['iv']} FROM $tableName WHERE {$fields['id']} = ?"
        );
        $stmt->bindParam(1, $vaultId, \PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch();

        if (!$data) {
            echo json_encode(['error' => 'Password not found']);
            exit;  // Detener la ejecución del script
        }

        $iv2 = base64_decode($data[$fields['iv']]);
        if (strlen($iv2) !== openssl_cipher_iv_length('aes-256-cbc')) {
            return ['error' => 'Invalid IV length'];
        }

        if ($data) {
            $decryptedPassword = openssl_decrypt($data[$fields['password']], 'aes-256-cbc', $encryptionToken, 0, $iv2);
            return ['password' => $decryptedPassword];
        }

        return null;
    }
}
