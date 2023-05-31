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
    $idAuthor = $_POST['idAuthor'];
    $idBook = $_POST['idBook'];
    
    $sql = "INSERT INTO db_library_books_authors  SET idAuthor=:idAuthor, idBook=:idBook";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":idAuthor", $idAuthor, PDO::PARAM_INT);
    $stmt->bindParam(":idBook", $idBook, PDO::PARAM_INT);
  
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

 