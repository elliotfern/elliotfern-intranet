<?php
/*
 * BACKEND LIBRARY
 * FUNCIONS DELETE BOOK
 * @update_book_ajax
 */

 # conectare la base de datos
 $activePage = "library";
include_once('../../inc/connection.php');

if (isset($_POST['idBook'])) {
    $id = $_POST['idBook'];
    $hasError = 1;
} else {
    $response['status'] = 'error id';

    header( "Content-Type: application/json" );
    echo json_encode($response);
}
    if ($hasError === 1) {
        global $conn;
        $sql = "DELETE FROM db_library_books WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

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
