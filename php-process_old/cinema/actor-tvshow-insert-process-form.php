<?php
/*
 * BACKEND CINEMA
 * FUNCIONS INSERT actor
 * @update_book_ajax
 */

 # conectare la base de datos
 $activePage = "cinema";
include_once('../../inc/connection.php');

    function data_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    // insert data to db    
    if (empty($_POST["role"])) {
        $hasError = true;
      } else {
          $role = data_input($_POST["role"], ENT_NOQUOTES);
      }

    if (empty($_POST["idActor"])) {
      $hasError = true;
    } else {
      $idActor = filter_input(INPUT_POST, 'idActor', FILTER_SANITIZE_NUMBER_INT);
    }

      if (empty($_POST["idtvShow"])) {
        $hasError = true;
      } else {
        $idtvShow = filter_input(INPUT_POST, 'idtvShow', FILTER_SANITIZE_NUMBER_INT);
      }

    if (!isset($hasError)) {
      global $conn;
      $sql = "INSERT INTO db_tvmovies_tvshows_cast SET idtvShow=:idtvShow, idActor=:idActor, role=:role";
      $stmt= $conn->prepare($sql);
      $stmt->bindParam(":idtvShow", $idtvShow, PDO::PARAM_INT);
      $stmt->bindParam(":idActor", $idActor, PDO::PARAM_INT);
      $stmt->bindParam(":role", $role, PDO::PARAM_STR);

      if ($stmt->execute()) {
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
    } else {
      // response output - data error
      $response['status'] = 'error';
      header( "Content-Type: application/json" );
      echo json_encode($response);
    } 