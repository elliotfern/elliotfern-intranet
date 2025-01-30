<?php
// src/Config/Database.php

namespace App\Config;

use PDO;
use Exception;

class Database
{
    private static $conn;

    public static function getConnection()
    {
        if (self::$conn === null) {
            try {
                $host = $_ENV['DB_HOST'];
                $dbname = $_ENV['DB_NAME'];
                $username = $_ENV['DB_USER'];
                $password = $_ENV['DB_PASS'];

                // Configuración del DSN con charset utf8mb4
                $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

                // Opciones para la conexión PDO
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'"
                ];

                self::$conn = new PDO($dsn, $username, $password, $options);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Verificar que la conexión esté activa
                if (!self::$conn) {
                    throw new Exception("La conexión a la base de datos no se pudo establecer.");
                }
            } catch (Exception $e) {
                // Si hay un error, registrar el error completo
                error_log('Error de conexión a la base de datos: ' . $e->getMessage());
                return null; // Retorna null si la conexión falla
            }
        }

        return self::$conn;
    }
}
