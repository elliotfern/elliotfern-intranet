<?php
/*
 * BACKEND LIBRARY
 * FUNCIONS INSERT BOOK
 * @update_book_ajax
 */

 # conectare la base de datos
 $activePage = "library";
include_once('../../inc/connection.php');

    // insert data to db	
    $facEmpresa = $_POST['facEmpresa'];
    $facConcepte = $_POST['facConcepte'];
    $facData = $_POST['facData'];
    $facSubtotal = $_POST['facSubtotal'];
    $facImportIva = $_POST['facImportIva'];
    $facTotal = $_POST['facTotal'];
    $facIva = $_POST['facIva'];
    $facPagament = $_POST['facPagament'];
    $loanDirectors = $_POST['loanDirectors'];
    
    $sql = "INSERT INTO  db_accounting_hispantic_invoices_suppliers  SET facEmpresa=:facEmpresa, facConcepte=:facConcepte, facData=:facData, facSubtotal=:facSubtotal, facImportIva=:facImportIva, facTotal=:facTotal, facIva=:facIva, facPagament=:facPagament, loanDirectors=:loanDirectors";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":facEmpresa", $facEmpresa, PDO::PARAM_STR);
    $stmt->bindParam(":facConcepte", $facConcepte, PDO::PARAM_STR);
    $stmt->bindParam(":facData", $facData, PDO::PARAM_STR);
    $stmt->bindValue(":facSubtotal", $facSubtotal, PDO::PARAM_STR);
    $stmt->bindValue(":facImportIva", $facImportIva, PDO::PARAM_STR);
    $stmt->bindValue(":facTotal", $facTotal, PDO::PARAM_STR);
    $stmt->bindParam(":facIva", $facIva, PDO::PARAM_INT);
    $stmt->bindParam(":facPagament", $facPagament, PDO::PARAM_INT);
    $stmt->bindParam(":loanDirectors", $loanDirectors, PDO::PARAM_INT);
  
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