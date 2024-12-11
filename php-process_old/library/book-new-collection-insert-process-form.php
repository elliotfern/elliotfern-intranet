<?php
/*
 * BACKEND LIBRARY
 * FUNCIONS INSERT NEW COLLECTION
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
        $nomCollection = data_input($_POST['nomCollection']);
        $idPublisher = data_input($_POST['idPublisher']);

        $data = [
          "nomCollection" => $nomCollection,
          "idPublisher" => $idPublisher,
        ];
        
        global $conn;
        $sql = "INSERT INTO db_library_collection (nomCollection, idPublisher) VALUES (:nomCollection, :idPublisher)";
        $stmt= $conn->prepare($sql);

        if ($stmt->execute($data)) {
            $stmt = $conn->prepare("SELECT c.id
            FROM db_library_collection AS c
            ORDER BY c.id DESC LIMIT 0 , 1");
            $stmt->execute(); 
            $data = $stmt->fetchAll();
            foreach ($data as $row) {
                $idCollection = $row['id'];
            }
        // response output
        $response = array(
            'status' => 'success', 
            'nomCollection' => $nomCollection,
            'idCollection' => $idCollection
        );

        header( "Content-Type: application/json" );
        echo json_encode($response);

        } else {
        // response output - data error
        $response['status'] = 'error';

        header( "Content-Type: application/json" );
        echo json_encode($response);
    }