<?php
// src/Models/UserModel.php

namespace Models;
require_once __DIR__ . '/../../src/Config/Database.php';
use PDO;
use Config\Database;

class UserModel
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function findUserByUsername($username)
    {
        $query = "SELECT id, username, password FROM db_users WHERE username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Nueva función para registrar un usuario
    public function register($username, $password, $firstName, $lastName, $email) {
        try {
            // Usar password_hash para crear un hash seguro de la contraseña
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Preparar la consulta SQL para insertar los datos
            $stmt = $this->db->prepare("INSERT INTO db_users (username, password, firstName, lastName, email) VALUES (:username, :password, :firstName, :lastName, :email)");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
            $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
            $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);

            // Ejecutar la consulta
            $stmt->execute();

            return ['success' => true, 'message' => 'Usuario registrado exitosamente'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }
}