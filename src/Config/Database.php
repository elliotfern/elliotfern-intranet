<?php
// src/Config/Database.php

namespace Config;
use PDO;

class Database
{
    private static $conn;

    public static function getConnection()
    {
        if (self::$conn === null) {
            $host = $_ENV['DB_HOST'];
            $dbname = $_ENV['DB_DBNAME'];
            $username = $_ENV['DB_USER'];
            $password = $_ENV['DB_PASS'];

            self::$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$conn;
    }
}