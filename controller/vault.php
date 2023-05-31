<?php

/*
session_start();
if(!isset($_SESSION['user'])):
	header('Location: /control/login.php');
	exit();
endif;
*/

require_once('../inc/connection.php');
include_once('../inc/functions.php');

// JSON of VAULT
if (isset($_GET['type']) && $_GET['type'] == 'vault' && (isset($_GET['id']) )) {
  global $conn;
  $id = $_GET['id'];
  $data = array();
  $stmt = $conn->prepare(
      "SELECT v.id, v.serveiNom, v.serveiUsuari, v.serveiPas, v.serveiType, v.serveiWeb, v.client, v.project, v.dateCreated, v.dateModified
      FROM db_vault AS v
      WHERE v.id = :id");
      $stmt->execute(['id' => $id]);
      if($stmt->rowCount() === 0) echo ('No rows');
      while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
          $data[] = $users;
      }
      echo json_encode($data);

} 