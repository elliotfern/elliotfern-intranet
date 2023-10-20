<?php
/*
 * BACKEND LIBRARY
 * FUNCIONS INSERT BOOK
 * @update_book_ajax
 */

 # conectare la base de datos
 $activePage = "library";
include_once('../../inc/connection.php');

function data_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  // values
  $nomEditorial = data_input($_POST['nomEditorial']);
  $paisEditorial = data_input($_POST['paisEditorial']);
  $linkEditorial = data_input($_POST['linkEditorial']);

  $data = [
    "nomEditorial" => $nomEditorial,
    "paisEditorial" => $paisEditorial,
    "linkEditorial" => $linkEditorial,
  ];
  global $conn;
  $sql = "INSERT INTO db_library_publishers (nomEditorial, paisEditorial, linkEditorial) VALUES (:nomEditorial, :paisEditorial, :linkEditorial)";
  $stmt= $conn->prepare($sql);
  
  if ($stmt->execute($data)) {
    $stmt = $conn->prepare("SELECT idEditorial, nomEditorial
      FROM db_library_publishers
      ORDER BY idEditorial DESC LIMIT 0 , 1");
      $stmt->execute(); 
      $data = $stmt->fetchAll();
      foreach ($data as $row) {
        $idEditorial = $row['idEditorial'];
        $nomEditorial = $row['nomEditorial'];
      }

    // response output
    $response = array(
      'status' => 'success', 
      'id' => $idEditorial,
      'name' => $nomEditorial
  );
    header( "Content-Type: application/json" );
    echo json_encode($response);
  } else {
    // response output - data error
    $response['status'] = 'error';
    header( "Content-Type: application/json" );
    echo json_encode($response);
  }
