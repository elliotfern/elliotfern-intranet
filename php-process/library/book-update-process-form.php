<?php
/*
 * BACKEND LIBRARY
 * FUNCIONS UPDATE BOOK
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
    
     if (empty($_POST["nomAutor"])) {
        $hasError=true;
      } else {
        $nomAutor = filter_input(INPUT_POST, 'nonAutor', FILTER_SANITIZE_NUMBER_INT);
      }
    
      if (empty($_POST["titol"])) {
        $hasError=true;
      } else {
        $titol = data_input($_POST['titol'], ENT_COMPAT);
      }
    
      if (empty($_POST["titolEng"])) {
        $hasError = true;
      } else {
        $titolEng = data_input($_POST['titolEng'], ENT_COMPAT);
      }
    
      if (empty($_POST["any"])) {;
        $hasError=true;
      } else {
        $any = data_input($_POST['any']);
        // check if name only contains letters and whitespace
        if (!preg_match("/^-?[0-9]{1,4}$/",$any)) {
          $hasError=true;
        } else { //Si está correcte, es grava el nom a la base de dades
          $any = filter_input(INPUT_POST, 'any', FILTER_SANITIZE_NUMBER_INT);
        }
      }
    
      if (empty($_POST["idEd"])) {
        $hasError=true;
      } else {
        $idEd = filter_input(INPUT_POST, 'idEd', FILTER_SANITIZE_NUMBER_INT);
      }
    
      if (empty($_POST["idGen"])) {
        $hasError=true;
      } else {
        $idGen = filter_input(INPUT_POST, 'idGen', FILTER_SANITIZE_NUMBER_INT);
      }
    
      if (empty($_POST["lang"])) {;
        $hasError=true;
      } else {
        $lang = filter_input(INPUT_POST, 'lang', FILTER_SANITIZE_NUMBER_INT);
      }
    
      if (empty($_POST["img"])) {
        $img = NULL;
      } else {
        $img = filter_input(INPUT_POST, 'img', FILTER_SANITIZE_NUMBER_INT);
      }
      
      if (empty($_POST["tipus"])) {
        $hasError=true;
      } else {
        $tipus = filter_input(INPUT_POST, 'tipus', FILTER_SANITIZE_NUMBER_INT);
      }
    
      $timestamp = date('Y-m-d');
      $dateModified = $timestamp;

      $id = filter_input(INPUT_POST, 'idBook', FILTER_SANITIZE_NUMBER_INT);

    if (!isset($hasError)) {
    $sql = "UPDATE db_library_books SET nomAutor=:nomAutor, titol=:titol, titolEng=:titolEng, any=:any, idGen=:idGen, idEd=:idEd, lang=:lang, img=:img, tipus=:tipus, dateModified=:dateModified WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":nomAutor", $nomAutor, PDO::PARAM_INT);
    $stmt->bindParam(":titol", $titol, PDO::PARAM_STR);
    $stmt->bindParam(":titolEng", $titolEng, PDO::PARAM_STR);
    $stmt->bindParam(":any", $any, PDO::PARAM_INT);
    $stmt->bindParam(":idEd", $idEd, PDO::PARAM_INT);
    $stmt->bindParam(":lang", $lang, PDO::PARAM_INT);
    $stmt->bindParam(":img", $img, PDO::PARAM_INT);
    $stmt->bindParam(":tipus", $tipus, PDO::PARAM_INT);
    $stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
    $stmt->bindParam(":idGen", $idGen, PDO::PARAM_INT);
    $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
 
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

  
