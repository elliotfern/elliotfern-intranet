<?php
/*
 * BACKEND LIBRARY
 * FUNCIONS INSERT BOOK
 * @update_book_ajax
 */

 # conectare la base de datos
 $activePage = "library";
include_once('../../inc/connection.php');

    // insert data to db	
    $empresaNom = $_POST['empresaNom'];
    $empresaNIF = $_POST['empresaNIF'];
    $empresaDireccio = $_POST['empresaDireccio'];
    $empresaPais = $_POST['empresaPais'];
    
    $sql = "INSERT INTO db_accounting_hispantic_supplier_companies SET empresaNom=:empresaNom, empresaNIF=:empresaNIF, empresaDireccio=:empresaDireccio, empresaPais=:empresaPais";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":empresaNom", $empresaNom, PDO::PARAM_STR);
    $stmt->bindParam(":empresaNIF", $empresaNIF, PDO::PARAM_STR);
    $stmt->bindParam(":empresaDireccio", $empresaDireccio, PDO::PARAM_STR);
    $stmt->bindParam(":empresaPais", $empresaPais, PDO::PARAM_INT);
  
    if ($stmt->execute()) {
      // response output
      $response = array(
          'status' => 'success', 
      );

      header( "Content-Type: application/json" );
      echo json_encode($response);
    } else {
      // response output - data error
      $response['status'] = 'error';
      header( "Content-Type: application/json" );
      echo json_encode($response);
    }