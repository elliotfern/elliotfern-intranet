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
    if (empty($_POST["actorLastName"])) {
      $hasError = true;
    } else {
        $actorLastName = data_input($_POST["actorLastName"], ENT_NOQUOTES);
    }

    if (empty($_POST["actorFirstName"])) {
        $hasError = true;
      } else {
          $actorFirstName = data_input($_POST["actorFirstName"], ENT_NOQUOTES);
      }
  
    if (empty($_POST["actorCountry"])) {
      $hasError = true;
    } else {
      $actorCountry = filter_input(INPUT_POST, 'actorCountry', FILTER_SANITIZE_NUMBER_INT);
    }

    if (empty($_POST["deadYear"])) {
      $deadYear = NULL;
    } else {
      $deadYear = filter_input(INPUT_POST, 'deadYear', FILTER_SANITIZE_NUMBER_INT);
    }

    if (empty($_POST["birthYear"])) {
      $hasError = true;
    } else {
      $birthYear = filter_input(INPUT_POST, 'birthYear', FILTER_SANITIZE_NUMBER_INT);
    }

      if (empty($_POST["img"])) {
        $hasError = true;
      } else {
        $img = filter_input(INPUT_POST, 'img', FILTER_SANITIZE_NUMBER_INT);
      }

    if (!isset($hasError)) {
      global $conn;
      $sql = "INSERT INTO db_tvmovies_actors SET actorLastName=:actorLastName, actorFirstName=:actorFirstName, actorCountry=:actorCountry, birthYear=:birthYear, deadYear=:deadYear, img=:img";
      $stmt= $conn->prepare($sql);
      $stmt->bindParam(":actorLastName", $actorLastName, PDO::PARAM_STR);
      $stmt->bindParam(":actorFirstName", $actorFirstName, PDO::PARAM_STR);
      $stmt->bindParam(":actorCountry", $actorCountry, PDO::PARAM_INT);
      $stmt->bindParam(":birthYear", $birthYear, PDO::PARAM_INT);
      $stmt->bindParam(":deadYear", $deadYear, PDO::PARAM_INT);
      $stmt->bindParam(":img", $img, PDO::PARAM_INT);

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