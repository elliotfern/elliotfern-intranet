<?php
/*
 * BACKEND LIBRARY
 * FUNCIONS INSERT BOOK
 * @update_book_ajax
 */

function data_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

    // insert data to db
    if (empty($_POST["clientNom"])) {
      $hasError = true;
    } else {
      $clientNom = data_input($_POST['clientNom']);
    }

    if (empty($_POST["clientCognoms"])) {
      $hasError = true;
    } else {
      $clientCognoms = data_input($_POST['clientCognoms']);
    }

    if (empty($_POST["clientEmail"])) {
      $hasError = true;
    } else {
      $clientEmail = data_input($_POST['clientEmail']);
    }

    if (empty($_POST["clientWeb"])) {
      $hasError = true;
    } else {
      $clientWeb = data_input($_POST['clientWeb']);
    }

    if (empty($_POST["clientNIF"])) {
      $hasError = true;
    } else {
      $clientNIF = data_input($_POST['clientNIF']);
    }
    
    if (empty($_POST["clientEmpresa"])) {
      $hasError = true;
    } else {
      $clientEmpresa = data_input($_POST['clientEmpresa']);
    }
    
    if (empty($_POST["clientAdreca"])) {
      $hasError = true;
    } else {
      $clientAdreca = data_input($_POST['clientAdreca']);
    }
    
    if (empty($_POST["clientCiutat"])) {
      $hasError = true;
    } else {
      $clientCiutat = data_input($_POST['clientCiutat']);
    }

    if (empty($_POST["clientProvincia"])) {
      $hasError = true;
    } else {
      $clientProvincia = data_input($_POST['clientProvincia']);
    }
    

    if (empty($_POST["clientPais"])) {
      $hasError = true;
    } else {
      $clientPais = data_input($_POST['clientPais']);
    }
    
    if (empty($_POST["clientStatus"])) {
      $hasError = true;
    } else {
      $clientStatus = data_input($_POST['clientStatus']);
    }
    
    if (empty($_POST["clientCP"])) {
      $hasError = true;
    } else {
      $clientCP = data_input($_POST['clientCP']);
    }
    
    if (empty($_POST["clientTelefon"])) {
      $hasError = true;
    } else {
      $clientTelefon = data_input($_POST['clientTelefon']);
    }
    
    if (empty($_POST["clientRegistre"])) {
      $hasError = true;
    } else {
      $clientRegistre = data_input($_POST['clientRegistre']);
    }
    
    if (!isset($hasError)) {
      $sql = "INSERT INTO db_accounting_hispantic_costumers  SET clientNom=:clientNom, clientCognoms=:clientCognoms, clientEmail=:clientEmail, clientWeb=:clientWeb, clientNIF=:clientNIF, clientEmpresa=:clientEmpresa, clientAdreca=:clientAdreca, clientCiutat=:clientCiutat, clientProvincia=:clientProvincia, clientPais=:clientPais, clientStatus=:clientStatus, clientCP=:clientCP, clientTelefon=:clientTelefon, clientRegistre=:clientRegistre";
      
      global $conn;
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(":clientNom", $clientNom, PDO::PARAM_STR);
      $stmt->bindParam(":clientCognoms", $clientCognoms, PDO::PARAM_STR);
      $stmt->bindParam(":clientEmail", $clientEmail, PDO::PARAM_STR);
      $stmt->bindParam(":clientWeb", $clientWeb, PDO::PARAM_STR);
      $stmt->bindParam(":clientNIF", $clientNIF, PDO::PARAM_STR);
      $stmt->bindParam(":clientEmpresa", $clientEmpresa, PDO::PARAM_STR);
      $stmt->bindParam(":clientAdreca", $clientAdreca, PDO::PARAM_STR);
      $stmt->bindParam(":clientCiutat", $clientCiutat, PDO::PARAM_INT);
      $stmt->bindParam(":clientProvincia", $clientProvincia, PDO::PARAM_INT);
      $stmt->bindParam(":clientPais", $clientPais, PDO::PARAM_INT);
      $stmt->bindParam(":clientStatus", $clientStatus, PDO::PARAM_INT);
      $stmt->bindParam(":clientCP", $clientCP, PDO::PARAM_STR);
      $stmt->bindParam(":clientTelefon", $clientTelefon, PDO::PARAM_INT);
      $stmt->bindParam(":clientRegistre", $clientRegistre, PDO::PARAM_STR);
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