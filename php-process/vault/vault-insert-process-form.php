<?php
/*
 * BACKEND VAULT
 * FUNCIONS INSERT VAULT
 * @update_book_ajax
 */

 # conectare la base de datos
 $activePage = "vault";
 global $conn;
 
include_once('../../inc/connection.php');

function data_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

    // insert data to db
    if (empty($_POST["serveiNom"])) {
      $hasError = true;
    } else {
        $serveiNom = data_input($_POST["serveiNom"]);
    }

    if (empty($_POST["serveiUsuari"])) {
        $hasError=true;
    } else {
        $serveiUsuari = data_input($_POST["serveiUsuari"]);
    }

    if (empty($_POST["serveiPas"])) {
        $hasError=true;
    } else {
        $serveiPas = openssl_encrypt($_POST["serveiPas"], "AES-128-ECB", "8X1::HpHVW");
    }

    if (empty($_POST["serveiType"])) {
        $hasError=true;
    } else {
        $serveiType = filter_input(INPUT_POST, 'serveiType', FILTER_SANITIZE_NUMBER_INT);
    }

    if (empty($_POST["serveiWeb"])) {
        $hasError=true;
    } else {
        $serveiWeb = data_input($_POST["serveiWeb"]);
    }

    if (empty($_POST["client"])) {
        $hasError=true;
    } else {
        $client = filter_input(INPUT_POST, 'client', FILTER_SANITIZE_NUMBER_INT);
    }

    if (empty($_POST["project"])) {
        $project = NULL;
    } else {
        $project = filter_input(INPUT_POST, 'project', FILTER_SANITIZE_NUMBER_INT);
    }

    $dateCreated = data_input($_POST['dateCreated']);
    $dateModified = data_input($_POST['dateModified']);

    if (!isset($hasError)) {
      $sql = "INSERT INTO db_vault SET serveiNom=:serveiNom, serveiUsuari=:serveiUsuari, serveiPas=:serveiPas, serveiType=:serveiType, serveiWeb=:serveiWeb, client=:client, project=:project, dateCreated=:dateCreated, dateModified=:dateModified";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(":serveiNom", $serveiNom, PDO::PARAM_STR);
      $stmt->bindParam(":serveiUsuari", $serveiUsuari, PDO::PARAM_STR);
      $stmt->bindParam(":serveiPas", $serveiPas, PDO::PARAM_STR);
      $stmt->bindParam(":serveiType", $serveiType, PDO::PARAM_INT);
      $stmt->bindParam(":serveiWeb", $serveiWeb, PDO::PARAM_STR);
      $stmt->bindParam(":client", $client, PDO::PARAM_INT);
      $stmt->bindParam(":project", $project, PDO::PARAM_INT);
      $stmt->bindParam(":dateCreated", $dateCreated, PDO::PARAM_STR);
      $stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);

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
  
    } else {
      // response output - data error
      $response['status'] = 'error';
      header( "Content-Type: application/json" );
      echo json_encode($response);
    } 