<?php

namespace App\Auth\Adapters\Outbound;

use App\Auth\Core\Ports\Out\AuthRepositoryInterface;
use App\Helpers\JwtHelper;
use PDO;

class DatabaseAuthRepository implements AuthRepositoryInterface
{
    private $conn;

    // Constructor para recibir la conexión PDO
    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function loginAuth(string $username, string $password): array
    {
        try {
            $sql = "SELECT id, username, password FROM db_users WHERE username = :username";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                return ['success' => false, 'message' => 'Usuario no encontrado'];
            }

            // Verificar contraseña
            if (password_verify($password, $user['password'])) {
                // Crear el payload para el JWT
                $payload = [
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'kid' => 'key_api'
                ];

                $jwt = JwtHelper::generateJwt($payload, $_ENV['TOKEN']); // Obtener la clave desde .env
                $expiration = time() + (10 * 24 * 60 * 60); // 10 días

                $arr_cookie_options = array(
                    'expires' => $expiration,
                    'path' => '/',
                    'domain' => 'elliot.cat',
                    'secure' => true,     // or false
                    'httponly' => true,    // or false
                    'samesite' => 'Strict' // None || Lax  || Strict
                );

                setcookie('user_id', $user['id'], $arr_cookie_options);
                setcookie('token', $jwt, $arr_cookie_options);
                setcookie('user_type', "1", $arr_cookie_options);

                return [
                    'success' => true,
                    'message' => 'Login exitoso',
                    'token' => $jwt
                ];
            }

            return ['success' => false, 'message' => 'Contraseña incorrecta'];
        } catch (\PDOException $e) {
            error_log('Error al obtener las contraseñas: ' . $e->getMessage());
            return [];
        }
    }
}
