<?php
/*
 * BACKEND LIBRARY
 * FUNCIONS INSERT BOOK
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

  // insert data to db	
    $clientNom = data_input($_POST['clientNom']);
    $clientCognoms = data_input($_POST['clientCognoms']);
    $clientEmail = data_input($_POST['clientEmail']);
    $clientWeb = data_input($_POST['clientWeb']);
    $clientNIF = data_input($_POST['clientNIF']);
    $clientEmpresa = data_input($_POST['clientEmpresa']);
    $clientAdreca = data_input($_POST['clientAdreca']);
    $clientCiutat = data_input($_POST['clientCiutat']);
    $clientProvincia = data_input($_POST['clientProvincia']);
    $clientPais = data_input($_POST['clientPais']);
    $clientStatus = data_input($_POST['clientStatus']);
    $clientCP = data_input($_POST['clientCP']);
    $clientTelefon = data_input($_POST['clientTelefon']);
    $clientRegistre = data_input($_POST['clientRegistre']);

    $sql = "INSERT INTO db_accounting_hispantic_costumers  SET clientNom=:clientNom, clientCognoms=:clientCognoms, clientEmail=:clientEmail, clientWeb=:clientWeb, clientNIF=:clientNIF, clientEmpresa=:clientEmpresa, clientAdreca=:clientAdreca, clientCiutat=:clientCiutat, clientProvincia=:clientProvincia, clientPais=:clientPais, clientStatus=:clientStatus, clientCP=:clientCP, clientTelefon=:clientTelefon, clientRegistre=:clientRegistre";
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