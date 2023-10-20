<?php
/*
 * BACKEND OPEN HISTORY
 * FUNCIONS UPDATE ARTICLE-COURSE
 * @update_book_ajax
 */

 # conectare la base de datos
 $activePage = "open-history";
include_once('../../inc/connection.php');

function data_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_NOQUOTES);
    return $data;
  }

    // values
    if (empty($_POST["cursId"])) {;
        $hasError=true;
      } else {
        $cursId = filter_input(INPUT_POST, 'cursId', FILTER_SANITIZE_NUMBER_INT);
      }
    
    if (empty($_POST["wpCat"])) {;
      $hasError=true;
    } else {
      $wpCat = filter_input(INPUT_POST, 'wpCat', FILTER_SANITIZE_NUMBER_INT);
    }
  
    if (empty($_POST["wpCast"])) {;
        $wpCast = NULL;
    } else {
        $wpCast = filter_input(INPUT_POST, 'wpCast', FILTER_SANITIZE_NUMBER_INT);
    }

    if (empty($_POST["wpEng"])) {;
        $wpEng = NULL;
      } else {
        $wpEng = filter_input(INPUT_POST, 'wpEng', FILTER_SANITIZE_NUMBER_INT);
      }

    if (empty($_POST["wpIt"])) {;
        $wpIt = NULL;
      } else {
        $wpIt = filter_input(INPUT_POST, 'wpIt', FILTER_SANITIZE_NUMBER_INT);
      }

      if (empty($_POST["wpFr"])) {;
        $wpFr = NULL;
      } else {
        $wpFr = filter_input(INPUT_POST, 'wpFr', FILTER_SANITIZE_NUMBER_INT);
      }

      if (empty($_POST["ordre"])) {;
        $ordre = NULL;
      } else {
        $ordre = filter_input(INPUT_POST, 'ordre', FILTER_SANITIZE_NUMBER_INT);
      }


      if (empty($_POST["idBibl"])) {;
        $idBibl = NULL;
      } else {
        $idBibl = filter_input(INPUT_POST, 'idBibl', FILTER_SANITIZE_NUMBER_INT);
      }
      
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $dateModified = data_input($_POST['dateModified']);
    
    if (!isset($hasError)) {
        global $conn;
        $sql = "UPDATE db_openhistory_articles SET dateModified=:dateModified, cursId=:cursId, wpCat=:wpCat, wpCast=:wpCast, wpEng=:wpEng, wpIt=:wpIt, wpFr=:wpFr, ordre=:ordre, idBibl=:idBibl WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":dateModified", $dateModified, PDO::PARAM_STR);
        $stmt->bindParam(":cursId", $cursId, PDO::PARAM_INT);
        $stmt->bindParam(":wpCat", $wpCat, PDO::PARAM_INT);
        $stmt->bindParam(":wpCast", $wpCast, PDO::PARAM_INT);
        $stmt->bindParam(":wpEng", $wpEng, PDO::PARAM_INT);
        $stmt->bindParam(":wpIt", $wpIt, PDO::PARAM_INT);
        $stmt->bindParam(":wpFr", $wpFr, PDO::PARAM_INT);
        $stmt->bindParam(":ordre", $ordre, PDO::PARAM_INT);
        $stmt->bindParam(":idBibl", $idBibl, PDO::PARAM_INT);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
                    // response output
                    $response['status'] = 'success';

                    header( "Content-Type: application/json" );
                    echo json_encode($response);
        } else {
                    // response output - data error
                    $response['status'] = 'error db';

                    header( "Content-Type: application/json" );
                    echo json_encode($response);
        }
    } else {
        // response output - data error
        $response['status'] = 'error data';

        header( "Content-Type: application/json" );
        echo json_encode($response);
    }