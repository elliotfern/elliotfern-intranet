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
    if (empty($_POST["nomAutor"])) {
      $hasError = true;
    } else {
        $nomAutor = filter_input(INPUT_POST, 'nomAutor', FILTER_SANITIZE_NUMBER_INT);
    }

    if (empty($_POST["titol"])) {
      $hasError = true;
    } else {
      $titol = data_input($_POST["titol"], ENT_NOQUOTES);
    }

    if (empty($_POST["titolEng"])) {
      $titolEng = NULL;
    } else {
      $titolEng = data_input($_POST["titolEng"], ENT_NOQUOTES);
    }

    if (empty($_POST["any"])) {
      $hasError = true;
    } else {
      $any = filter_input(INPUT_POST, 'any', FILTER_SANITIZE_NUMBER_INT);
    }

    if (empty($_POST["idEd"])) {
      $hasError = true;
    } else {
      $idEd = filter_input(INPUT_POST, 'idEd', FILTER_SANITIZE_NUMBER_INT);
    }

    if (empty($_POST["idGen"])) {
      $hasError = true;
    } else {
      $idGen = filter_input(INPUT_POST, 'idGen', FILTER_SANITIZE_NUMBER_INT);
    }

    if (empty($_POST["lang"])) {
      $hasError = true;
    } else {
      $lang = filter_input(INPUT_POST, 'lang', FILTER_SANITIZE_NUMBER_INT);
    }

    if (empty($_POST["img"])) {
      $hasError = true;
    } else {
      $img = filter_input(INPUT_POST, 'img', FILTER_SANITIZE_NUMBER_INT);
    }

    if (empty($_POST["tipus"])) {
      $hasError = true;
    } else {
      $tipus = filter_input(INPUT_POST, 'tipus', FILTER_SANITIZE_NUMBER_INT);
    }

    $dateCreated = ($_POST['dateCreated']);
    $dateModified = ($_POST['dateCreated']);
   
    if (!isset($hasError)) {
      global $conn;
      $sql = "INSERT INTO db_library_books SET nomAutor=:nomAutor, titol=:titol, titolEng=:titolEng, any=:any, idEd=:idEd, lang=:lang, img=:img, tipus=:tipus, idGen=:idGen, dateCreated=:dateCreated, dateModified=:dateModified";
      $stmt= $conn->prepare($sql);
      $stmt->bindParam(":nomAutor", $nomAutor, PDO::PARAM_INT);
      $stmt->bindParam(":titol", $titol, PDO::PARAM_STR);
      $stmt->bindParam(":titolEng", $titolEng, PDO::PARAM_STR);
      $stmt->bindParam(":any", $any, PDO::PARAM_INT);
      $stmt->bindParam(":idEd", $idEd, PDO::PARAM_INT);
      $stmt->bindParam(":lang", $lang, PDO::PARAM_INT);
      $stmt->bindParam(":img", $img, PDO::PARAM_INT);
      $stmt->bindParam(":tipus", $tipus, PDO::PARAM_INT);
      $stmt->bindParam(":idGen", $idGen, PDO::PARAM_INT);
      $stmt->bindParam(":dateCreated", $dateCreated, PDO::PARAM_STR);
      $stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);

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
    } else {
      // response output - data error
      $response['status'] = 'error';
      header( "Content-Type: application/json" );
      echo json_encode($response);
    } 