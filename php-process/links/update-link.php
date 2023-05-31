<?php
/*
 * BACKEND LIBRARY
 * FUNCIONS UPDATE BOOK
 * @update_book_ajax
 */

 # conectare la base de datos

 function data_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

     if (empty($_POST["nom"])) {
        $hasError=true;
      } else {
        $nom = data_input($_POST['nom'], ENT_COMPAT);
      }
    
      if (empty($_POST["web"])) {
        $hasError=true;
      } else {
        $web = data_input($_POST['web'], ENT_COMPAT);
      }
    
      if (empty($_POST["cat"])) {
        $hasError=true;
      } else {
        $cat = filter_input(INPUT_POST, 'cat', FILTER_SANITIZE_NUMBER_INT);
      }
    
      if (empty($_POST["lang"])) {
        $hasError=true;
      } else {
        $lang = filter_input(INPUT_POST, 'lang', FILTER_SANITIZE_NUMBER_INT);
      }
    
      if (empty($_POST["tipus"])) {;
        $hasError=true;
      } else {
        $tipus = filter_input(INPUT_POST, 'tipus', FILTER_SANITIZE_NUMBER_INT);
      }

      $linkCreated = $_POST['linkCreated'];

      $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    if (!isset($hasError)) {
    $sql = "UPDATE db_links SET nom=:nom, web=:web, cat=:cat, lang=:lang, lang=:lang, tipus=:tipus, linkCreated=:linkCreated WHERE id=:id";
    global $conn;
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
    $stmt->bindParam(":web", $web, PDO::PARAM_STR);
    $stmt->bindParam(":cat", $cat, PDO::PARAM_INT);
    $stmt->bindParam(":lang", $lang, PDO::PARAM_INT);
    $stmt->bindParam(":tipus", $tipus, PDO::PARAM_INT);
    $stmt->bindParam(":linkCreated", $linkCreated, PDO::PARAM_STR);
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

  
