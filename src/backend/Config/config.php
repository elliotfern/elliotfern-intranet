<?php

// Definir constantes de configuración
define('BASE_URL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']);
define('APP_ROOT', $_SERVER['DOCUMENT_ROOT']);

$base_url = BASE_URL . "/gestio";
define("APP_INTRANET", $base_url);

// Cargar librerías externas
require_once __DIR__ . '/../../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../../');
$dotenv->load();
require_once __DIR__ . '/../Config/connection.php';

// definicio de url
$url = [
    'biblioteca' => '/biblioteca',
    'adreces' => '/adreces',
    'persona' => '/persona',
    'cinema' => '/cinema',
    'auxiliars' => '/auxiliars',

];
