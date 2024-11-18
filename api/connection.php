<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$conn = "";

try {
    $servername = "localhost:3306";
    $dbname = "epgylzqu_elliotfern_intranet";
    $username = "epgylzqu_user";
    $password = "vf5BW6oX-UT.x^1ZF%";
   
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
    $servername = "localhost:3306";
    $dbname = "epgylzqu_historia_web";
    $username = "epgylzqu_user";
    $password = "vf5BW6oX-UT.x^1ZF%";
   
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