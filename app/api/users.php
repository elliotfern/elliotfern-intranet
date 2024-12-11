<?php
$updatedPath = str_replace('control.elliotfern.com', '', $url_root);
require_once($updatedPath . '/pass/connection.php');

// JSON
if ( (isset($_GET['type']) && $_GET['type'] == 'users') ) {
    global $conn;
    $data = array();
    $stmt = $conn->prepare(
        "SELECT u.id, u.username, u.password, u.firstName, u.lastName, u.email
        FROM db_users AS u");
        $stmt->execute();
        if($stmt->rowCount() === 0) echo ('No rows');
        while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $data[] = $users;
        }
    echo json_encode($data);

} elseif (isset($_GET['type']) && $_GET['type'] == 'user' && (isset($_GET['id']) )) {
  global $conn;
  $id = $_GET['id'];
  $data = array();
  $stmt = $conn->prepare(
      "SELECT u.id, u.username, u.password, u.firstName, u.lastName, u.email
      FROM db_users AS u
      WHERE u.id = :id");
      $stmt->execute(['id' => $id]);
      if($stmt->rowCount() === 0) echo ('No rows');
      while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
          $data[] = $users;
      }
      echo json_encode($data);

} 