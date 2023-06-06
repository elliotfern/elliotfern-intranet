<?php
$url_root = $_SERVER['DOCUMENT_ROOT'];
$url_server = "https://" . $_SERVER['HTTP_HOST'] . "/";

/*
session_start();
if(!isset($_SESSION['user'])):
	header('Location: /control/login.php');
	exit();
endif;
*/

require_once($url_root . '/inc/connection.php');

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