<?php

require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dbHost = $_ENV['DB_HOST'];
$dbUser = $_ENV['DB_USER'];
$dbPass = $_ENV['DB_PASS'];
$dbname = $_ENV['DB_DBNAME'];
$dbname2 = $_ENV['DB_DBNAME2'];

$conn = "";
  
try {
    $servername = $dbHost;
    $dbname = $dbname;
    $username = $dbUser;
    $password = $dbPass;
   
    $conn = new PDO(
        "mysql:host=$servername; dbname=$dbname;charset=utf8",
        $username, $password
    );
      
    $conn->setAttribute(PDO::ATTR_ERRMODE, 
                PDO::ERRMODE_EXCEPTION);
      
} catch(PDOException $e) {
    echo "Connection failed: " 
        . $e->getMessage();
}

try {
    $servername = $dbHost;
    $dbname = $dbname2;
    $username = $dbUser;
    $password = $dbPass;
   
    $conn2 = new PDO(
        "mysql:host=$servername; dbname=$dbname;charset=utf8",
        $username, $password
    );
      
    $conn2->setAttribute(PDO::ATTR_ERRMODE, 
                PDO::ERRMODE_EXCEPTION);
      
} catch(PDOException $e) {
    echo "Connection failed: " 
        . $e->getMessage();
}

?>