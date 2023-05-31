<?php
/*
 * BACKEND LIBRARY
 * FUNCIONS INSERT BOOK COLLECTION
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
        $ordre = data_input($_POST['ordre']);
        $idCollection = data_input($_POST['idCollection']);
        $idBook = data_input($_POST['idBook']);

        $data = [
          "ordre" => $ordre,
          "idCollection" => $idCollection,
          "idBook" => $idBook,
        ];
        
        global $conn;
        $sql = "INSERT INTO db_library_books_collection (ordre, idCollection, idBook) VALUES (:ordre, :idCollection, :idBook)";
        $stmt= $conn->prepare($sql);

        if ($stmt->execute($data)) {
        // response output
        $response['status'] = 'success';

        header( "Content-Type: application/json" );
        echo json_encode($response);

        } else {
        // response output - data error
        $response['status'] = 'error';

        header( "Content-Type: application/json" );
        echo json_encode($response);
    }