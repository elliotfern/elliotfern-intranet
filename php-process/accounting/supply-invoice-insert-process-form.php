<?php
/*
 * BACKEND LIBRARY
 * FUNCIONS INSERT BOOK
 * @update_book_ajax
 */

    // insert data to db	
    if (empty($_POST["empresaNom"])) {
      $hasError = true;
    } else {
      $facEmpresa = $_POST['facEmpresa'];
    }
    

    if (empty($_POST["empresaNom"])) {
      $hasError = true;
    } else {
      $facConcepte = $_POST['facConcepte'];
    }
    
    if (empty($_POST["facData"])) {
      $hasError = true;
    } else {
      $facData = $_POST['facData'];
    }
    
    
    if (empty($_POST["facSubtotal"])) {
      $hasError = true;
    } else {
      $facSubtotal = $_POST['facSubtotal'];
    }
    
    if (empty($_POST["facImportIva"])) {
      $hasError = true;
    } else {
      $facImportIva = $_POST['facImportIva'];
    }
    
    if (empty($_POST["facTotal"])) {
      $hasError = true;
    } else {
      $facTotal = $_POST['facTotal'];
    }
    
    if (empty($_POST["facIva"])) {
      $hasError = true;
    } else {
      $facIva = $_POST['facIva'];;
    }
    
    if (empty($_POST["facPagament"])) {
      $hasError = true;
    } else {
      $facPagament = $_POST['facPagament'];
    }
    
    if (empty($_POST["clientVinculat"])) {
      $hasError = true;
    } else {
      $clientVinculat = $_POST['clientVinculat'];
    }
    
    if (!isset($hasError)) {
      $sql = "INSERT INTO db_accounting_soletrade_invoices_suppliers SET facEmpresa=:facEmpresa, facConcepte=:facConcepte, facData=:facData, facSubtotal=:facSubtotal, facImportIva=:facImportIva, facTotal=:facTotal, facIva=:facIva, facPagament=:facPagament, clientVinculat=:clientVinculat";
      
      global $conn;
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(":facEmpresa", $facEmpresa, PDO::PARAM_STR);
      $stmt->bindParam(":facConcepte", $facConcepte, PDO::PARAM_STR);
      $stmt->bindParam(":facData", $facData, PDO::PARAM_STR);
      $stmt->bindValue(":facSubtotal", $facSubtotal, PDO::PARAM_STR);
      $stmt->bindValue(":facImportIva", $facImportIva, PDO::PARAM_STR);
      $stmt->bindValue(":facTotal", $facTotal, PDO::PARAM_STR);
      $stmt->bindParam(":facIva", $facIva, PDO::PARAM_INT);
      $stmt->bindParam(":facPagament", $facPagament, PDO::PARAM_INT);
      $stmt->bindParam(":clientVinculat", $clientVinculat, PDO::PARAM_INT);
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