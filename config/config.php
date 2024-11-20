<?php

// Cargar librerías externas
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$token = $_ENV['TOKEN'];
$encryptoken = $_ENV['ENCRYPTATION_TOKEN'];
define("APP_TOKEN",$token );
define("APP_ENCRYPTOKEN",$encryptoken );

//require_once APP_ROOT . '/config/connection.php';