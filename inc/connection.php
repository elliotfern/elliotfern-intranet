<?php

$conn2 = "";
  
try {
    $servername = "localhost:3306";
    $dbname = "bgznlvnh_elliot_wordpress";
    $username = "bgznlvnh_elliot";
    $password = "Az_(Knn#0YD%bPF^[M";
   
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

$conn = "";
  
try {
    $servername = "localhost:3306";
    $dbname = "bgznlvnh_elliot_intranet";
    $username = "bgznlvnh_elliot";
    $password = "Az_(Knn#0YD%bPF^[M";
   
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

?>