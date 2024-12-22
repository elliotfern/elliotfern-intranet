<?php

// Cargar librerías externas
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

// En el controlador o en un archivo de configuración
use App\Config\Database;

$conn = Database::getConnection();
