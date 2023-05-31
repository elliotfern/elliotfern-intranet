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
    $idUser = data_input($_POST['idUser']);
    $facConcepte = data_input($_POST['facConcepte']);
    $facData = data_input($_POST['facData']);
    $facDueDate = data_input($_POST['facDueDate']);
    $facSubtotal = data_input($_POST['facSubtotal']);
    $facFees = data_input($_POST['facFees']);
    $facTotal = data_input($_POST['facTotal']);
    $facVAT = data_input($_POST['facVAT']);
    $facIva = data_input($_POST['facIva']);
    $facEstat = data_input($_POST['facEstat']);
    $facPaymentType = data_input($_POST['facPaymentType']);

    $sql = "INSERT INTO db_accounting_hispantic_invoices_customers SET idUser=:idUser, facConcepte=:facConcepte, facData=:facData, facDueDate=:facDueDate, facSubtotal=:facSubtotal, facFees=:facFees, facTotal=:facTotal, facVAT=:facVAT, facIva=:facIva, facEstat=:facEstat, facPaymentType=:facPaymentType";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":idUser", $idUser, PDO::PARAM_INT);
    $stmt->bindParam(":facConcepte", $facConcepte, PDO::PARAM_STR);
    $stmt->bindParam(":facData", $facData, PDO::PARAM_STR);
    $stmt->bindParam(":facDueDate", $facDueDate, PDO::PARAM_STR);
    $stmt->bindParam(":facSubtotal", $facSubtotal, PDO::PARAM_STR);
    $stmt->bindParam(":facFees", $facFees, PDO::PARAM_STR);
    $stmt->bindParam(":facTotal", $facTotal, PDO::PARAM_STR);
    $stmt->bindParam(":facVAT", $facVAT, PDO::PARAM_STR);
    $stmt->bindParam(":facIva", $facIva, PDO::PARAM_INT);
    $stmt->bindParam(":facEstat", $facEstat, PDO::PARAM_INT);
    $stmt->bindParam(":facPaymentType", $facPaymentType, PDO::PARAM_INT);

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