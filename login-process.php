<?php

require_once('./inc/connection.php');

if (isset($_POST['userName'])) {
    $username = $_POST['userName'];
    $password = $_POST['password'];
    $hasError = 1;
} else {
    $response['status'] = 'error';

    header( "Content-Type: application/json" );
    echo json_encode($response);
}


global $conn;
$data = array();
$stmt = $conn->prepare(
    "SELECT u.id, u.username, u.password
    FROM db_users AS u
    WHERE u.username = :username");
    $stmt->execute(
      ['username' => $username]
    );
    if ($stmt->rowCount() === 0) {
      $_SESSION['message'] = array('type'=>'danger', 'msg'=>'Your account has not ben enabled.');
    } else {
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $hash = $row['password'];
        $id = $row['id'];
        if(password_verify($password, $hash) AND ($id == 1) ) {
          session_start();
          $_SESSION['user']['id'] = $row['id'];
          $_SESSION['user']['username'] = $row['username'];
          // response output
          $response['status'] = 'success';

          header( "Content-Type: application/json" );
          echo json_encode($response);
        } else {
          // response output
          $response['status'] = 'error';

          header( "Content-Type: application/json" );
          echo json_encode($response);
        }
        
      }
    }
