<?php
/*
 * BACKEND LIBRARY
 * FUNCIONS INSERT BOOK
 * @update_book_ajax
 */

    // insert data to db
    if (empty($_POST["empresaNom"])) {
      $hasError = true;
    } else {
      $empresaNom = $_POST['empresaNom'];
    }

    if (empty($_POST["empresaNIF"])) {
      $hasError = true;
    } else {
      $empresaNIF = $_POST['empresaNIF'];
    }

    if (empty($_POST["empresaDireccio"])) {
      $hasError = true;
    } else {
      $empresaDireccio = $_POST['empresaDireccio'];
    }
    
    if (empty($_POST["empresaPais"])) {
      $hasError = true;
    } else {
      $empresaPais = $_POST['empresaPais'];
    }

    if (!isset($hasError)) {
      $sql = "INSERT INTO db_accounting_hispantic_supplier_companies SET empresaNom=:empresaNom, empresaNIF=:empresaNIF, empresaDireccio=:empresaDireccio, empresaPais=:empresaPais";

      global $conn;
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(":empresaNom", $empresaNom, PDO::PARAM_STR);
      $stmt->bindParam(":empresaNIF", $empresaNIF, PDO::PARAM_STR);
      $stmt->bindParam(":empresaDireccio", $empresaDireccio, PDO::PARAM_STR);
      $stmt->bindParam(":empresaPais", $empresaPais, PDO::PARAM_INT);
      $stmt->execute();

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