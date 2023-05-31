<?php
/*
 * BACKEND LIBRARY
 * FUNCIONS UPDATE AUTHOR
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

  // values
    // values
    if (empty($_POST["AutNom"])) {;
      $hasError=true;
    } else {
      $AutNom = data_input($_POST['AutNom']);
    }
  
    if (empty($_POST["AutCognom1"])) {;
      $hasError=true;
    } else {
      $AutCognom1 = data_input($_POST['AutCognom1']);
    }
  
    if (empty($_POST["yearBorn"])) {;
      $hasError=true;
    } else {
      $yearBorn = filter_input(INPUT_POST, 'yearBorn', FILTER_SANITIZE_NUMBER_INT);
    }
  
    if (empty($_POST["yearDie"])) {;
      $hasError=true;
    } else {
      $yearDie = filter_input(INPUT_POST, 'yearDie', FILTER_SANITIZE_NUMBER_INT);
    }
  
    if (empty($_POST["paisAutor"])) {;
      $hasError=true;
    } else {
      $paisAutor = filter_input(INPUT_POST, 'paisAutor', FILTER_SANITIZE_NUMBER_INT);
    }
  
    if (empty($_POST["AutWikipedia"])) {;
      $hasError=true;
    } else {
      $AutWikipedia = data_input($_POST['AutWikipedia']);
    }
  
    if (empty($_POST["AutDescrip"])) {;
      $hasError=true;
    } else {
      $AutDescrip = data_input($_POST['AutDescrip']);
    }
  
    if (empty($_POST["AutOcupacio"])) {;
      $hasError=true;
    } else {
      $AutOcupacio = filter_input(INPUT_POST, 'AutOcupacio', FILTER_SANITIZE_NUMBER_INT);
    }
  
    if (empty($_POST["AutMoviment"])) {;
      $hasError=true;
    } else {
      $AutMoviment = filter_input(INPUT_POST, 'AutMoviment', FILTER_SANITIZE_NUMBER_INT);
    }
  
    if (empty($_POST["img"])) {;
      $hasError=true;
    } else {
      $img = filter_input(INPUT_POST, 'img', FILTER_SANITIZE_NUMBER_INT);
    }
  
    $dateCreated = $_POST['dateCreated'];
    $dateModified = $_POST['dateCreated'];
    
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

  global $conn;
  $sql = "UPDATE db_library_authors SET AutNom=:AutNom, AutCognom1=:AutCognom1, yearBorn=:yearBorn, yearDie=:yearDie, paisAutor=:paisAutor, img=:img, AutWikipedia=:AutWikipedia, AutDescrip=:AutDescrip, AutMoviment=:AutMoviment, AutOcupacio=:AutOcupacio, dateModified=:dateModified WHERE id=:id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(":AutNom", $AutNom, PDO::PARAM_STR);
  $stmt->bindParam(":AutCognom1", $AutCognom1, PDO::PARAM_STR);
  $stmt->bindParam(":yearBorn", $yearBorn, PDO::PARAM_INT);
  $stmt->bindParam(":yearDie", $yearDie, PDO::PARAM_INT);
  $stmt->bindParam(":paisAutor", $paisAutor, PDO::PARAM_INT);
  $stmt->bindParam(":img", $img, PDO::PARAM_INT);
  $stmt->bindParam(":AutWikipedia", $AutWikipedia, PDO::PARAM_STR);
  $stmt->bindParam(":AutDescrip", $AutDescrip, PDO::PARAM_STR);
  $stmt->bindParam(":AutMoviment", $AutMoviment, PDO::PARAM_INT);
  $stmt->bindParam(":AutOcupacio", $AutOcupacio, PDO::PARAM_INT);
  $stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
  $stmt->bindParam(":id", $id, PDO::PARAM_INT);

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
