<?php
/*
 * BACKEND LIBRARY
 * FUNCIONS INSERT BOOK
 * @update_book_ajax
 */

$rootDirectory = $_SERVER['DOCUMENT_ROOT'];

require_once( $rootDirectory . "/inc/php/functions.php");

    // insert data to db
    $clientNom = validateFormField($_POST['clientNom']);
    $clientCognoms = validateFormField($_POST['clientCognoms']);
    $clientEmail = validateFormField($_POST['clientEmail'], false, false, false, true);
    $clientWeb = validateFormField($_POST['clientWeb'], false, false, false, false, true);
    $clientNIF = validateFormField($_POST['clientNIF']);
    $clientEmpresa = validateFormField($_POST['clientEmpresa']);
    $clientAdreca = validateFormField($_POST['clientAdreca']);
    $clientCiutat = validateFormField($_POST['clientCiutat']);
    $clientProvincia = validateFormField($_POST['clientProvincia']);
    $clientPais = validateFormField($_POST['clientPais']);
    $clientStatus = validateFormField($_POST['clientStatus']);
    $clientCP = validateFormField($_POST['clientCP']);
    $clientTelefon = validateFormField($_POST['clientTelefon']);
    $clientRegistre = validateFormField($_POST['clientRegistre']);


    if ($clientNom['hasError'] || $clientCognoms['hasError'] || $clientEmail['hasError'] || $clientWeb['hasError'] || $clientNIF['hasError'] || $clientEmpresa['hasError'] || $clientAdreca['hasError'] || $clientCiutat['hasError'] || $clientProvincia['hasError'] || $clientPais['hasError'] || $clientStatus['hasError'] || $clientCP['hasError'] || $clientTelefon['hasError'] || $clientRegistre['hasError'] ) {

      $response['status'] = 'error';
      header( "Content-Type: application/json" );
      echo json_encode($response);

    } else {
      $sql = "INSERT INTO db_accounting_hispantic_costumers  SET clientNom=:clientNom, clientCognoms=:clientCognoms, clientEmail=:clientEmail, clientWeb=:clientWeb, clientNIF=:clientNIF, clientEmpresa=:clientEmpresa, clientAdreca=:clientAdreca, clientCiutat=:clientCiutat, clientProvincia=:clientProvincia, clientPais=:clientPais, clientStatus=:clientStatus, clientCP=:clientCP, clientTelefon=:clientTelefon, clientRegistre=:clientRegistre";
      
      global $conn;
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(":clientNom", $clientNom['value'], PDO::PARAM_STR);
      $stmt->bindParam(":clientCognoms", $clientCognoms['value'], PDO::PARAM_STR);
      $stmt->bindParam(":clientEmail", $clientEmail['value'], PDO::PARAM_STR);
      $stmt->bindParam(":clientWeb", $clientWeb['value'], PDO::PARAM_STR);
      $stmt->bindParam(":clientNIF", $clientNIF['value'], PDO::PARAM_STR);
      $stmt->bindParam(":clientEmpresa", $clientEmpresa['value'], PDO::PARAM_STR);
      $stmt->bindParam(":clientAdreca", $clientAdreca['value'], PDO::PARAM_STR);
      $stmt->bindParam(":clientCiutat", $clientCiutat['value'], PDO::PARAM_INT);
      $stmt->bindParam(":clientProvincia", $clientProvincia['value'], PDO::PARAM_INT);
      $stmt->bindParam(":clientPais", $clientPais['value'], PDO::PARAM_INT);
      $stmt->bindParam(":clientStatus", $clientStatus['value'], PDO::PARAM_INT);
      $stmt->bindParam(":clientCP", $clientCP['value'], PDO::PARAM_STR);
      $stmt->bindParam(":clientTelefon", $clientTelefon['value'], PDO::PARAM_INT);
      $stmt->bindParam(":clientRegistre", $clientRegistre['value'], PDO::PARAM_STR);
      $stmt->execute();
      
      // response output
      $response = array(
          'status' => 'success', 
      );

      header( "Content-Type: application/json" );
      echo json_encode($response);
    }