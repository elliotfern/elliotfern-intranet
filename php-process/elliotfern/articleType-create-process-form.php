<?php
/*
 * BACKEND ELLIOTFERN
 * FUNCIONS UPDATE ARTICLE WP TYPE
 * @update_book_ajax
 */

 # conectare la base de datos
 $activePage = "elliotfern";
include_once('../../inc/connection.php');

function data_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  // values
    if (empty($_POST["type"])) {;
        $hasError=true;
    } else {
       $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_NUMBER_INT);
    }

    if (empty($_POST["lang"])) {;
        $hasError=true;
    } else {
       $lang = filter_input(INPUT_POST, 'lang', FILTER_SANITIZE_NUMBER_INT);
    }

    if (empty($_POST["idPost"])) {;
        $hasError=true;
    } else {
       $idPost = filter_input(INPUT_POST, 'idPost', FILTER_SANITIZE_NUMBER_INT);
    }

    if (!isset($hasError)) {
        global $conn;
        $sql = "INSERT db_elliotfern_posts_lang SET idPost=:idPost, lang=:lang, type=:type";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":idPost", $idPost, PDO::PARAM_INT);
        $stmt->bindParam(":lang", $lang, PDO::PARAM_INT);
        $stmt->bindParam(":type", $type, PDO::PARAM_INT);

        if ($stmt->execute()) {
            // response output
            $response['status'] = 'success';

            header( "Content-Type: application/json" );
            echo json_encode($response);
        } else {
            // response output - data error
            $response['status'] = 'Error with DB';

            header( "Content-Type: application/json" );
            echo json_encode($response);
        }
    } else {
        // response output - data error
        $response['status'] = 'Error with data';
        header( "Content-Type: application/json" );
        echo json_encode($response);
      } 