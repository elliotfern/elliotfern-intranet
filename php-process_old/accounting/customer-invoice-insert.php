<?php
/*
 * BACKEND LIBRARY
 * FUNCIONS INSERT BOOK
 * @update_book_ajax
 */

    // insert data to db
    if (empty($_POST["idUser"])) {
      $hasError = true;
    } else {
      $idUser = data_input($_POST['idUser']);
    }

    if (empty($_POST["facConcepte"])) {
      $hasError = true;
    } else {
      $facConcepte = data_input($_POST['facConcepte']);
    }
      
    if (empty($_POST["facData"])) {
      $hasError = true;
    } else {
      $facData = data_input($_POST['facData']);
    }
  
    if (empty($_POST["facDueDate"])) {
      $hasError = true;
    } else {
      $facDueDate = data_input($_POST['facDueDate']);
    }
    
    if (empty($_POST["facSubtotal"])) {
      $hasError = true;
    } else {
      $facSubtotal = data_input($_POST['facSubtotal']);
    }
    
    if (empty($_POST["facFees"])) {
      $hasError = true;
    } else {
      $facFees = data_input($_POST['facFees']);
    }
    
    if (empty($_POST["facTotal"])) {
      $hasError = true;
    } else {
      $facTotal = data_input($_POST['facTotal']);
    }
    
    if (empty($_POST["facVAT"])) {
      $hasError = true;
    } else {
      $facVAT = data_input($_POST['facVAT']);
    }

    if (empty($_POST["facIva"])) {
      $hasError = true;
    } else {
      $facIva = data_input($_POST['facIva']);
    }
    
    if (empty($_POST["facEstat"])) {
      $hasError = true;
    } else {
      $facEstat = data_input($_POST['facEstat']);
    }
    
    if (empty($_POST["facPaymentType"])) {
      $hasError = true;
    } else {
      $facPaymentType = data_input($_POST['facPaymentType']);
    }
  
    if (!isset($hasError)) {
      $sql = "INSERT INTO db_accounting_soletrade_invoices_customers SET idUser=:idUser, facConcepte=:facConcepte, facData=:facData, facDueDate=:facDueDate, facSubtotal=:facSubtotal, facFees=:facFees, facTotal=:facTotal, facVAT=:facVAT, facIva=:facIva, facEstat=:facEstat, facPaymentType=:facPaymentType";
      
      global $conn;
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
      $stmt->execute();

      // response output      
      $response = array(
        'status' => 'success', 
      );
      header( "Content-Type: application/json" );
      echo json_encode($response);

    } else {
      // response output - data error
      $response = array(
        'status' => 'error', 
      );
      echo json_encode($response);
    }