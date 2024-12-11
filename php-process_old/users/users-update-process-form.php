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
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

    // insert data to db
    if (empty($_POST["username"])) {
        $hasError = true;
    } else {
        $username = data_input($_POST["username"]);
    }

    if (empty($_POST["firstName"])) {
        $hasError=true;
    } else {
        $firstName = data_input($_POST["firstName"]);
    }

    if (empty($_POST["lastName"])) {
        $hasError=true;
    } else {
        $lastName = data_input($_POST["lastName"]);
    }

    if (empty($_POST["password"])) {
        $hasError=true;
    } else {
        $plaintext_password = $_POST["password"];
        $password = password_hash($plaintext_password, PASSWORD_DEFAULT);
    }

    
    if (empty($_POST["email"])) {
        $hasError=true;
    } else {
        $email = data_input($_POST["email"]);
    }

    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    if (!isset($hasError)) {
        $sql = "UPDATE db_users SET username=:username, firstName=:firstName, lastName=:lastName, email=:email, password=:password WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->bindParam(":firstName", $firstName, PDO::PARAM_STR);
        $stmt->bindParam(":lastName", $lastName, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    
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