<?php
/*
 * BACKEND OPEN HISTORY
 * FUNCIONS UPDATE COURSE
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
    // values
    if (empty($_POST["nameCat"])) {;
      $hasError=true;
    } else {
      $nameCat = data_input($_POST['nameCat'], ENT_NOQUOTES); 
    }
  
    if (empty($_POST["nameCast"])) {;
      $hasError=true;
    } else {
      $nameCast = data_input($_POST['nameCast'], ENT_NOQUOTES);
    }
  
    if (empty($_POST["nameEng"])) {;
      $hasError=true;
    } else {
      $nameEng = data_input($_POST['nameEng'], ENT_NOQUOTES);
    }
  
    if (empty($_POST["nameIt"])) {;
      $hasError=true;
    } else {
      $nameIt = data_input($_POST['nameIt'], ENT_NOQUOTES);
    }
  
    if (empty($_POST["descripCat"])) {;
      $hasError=true;
    } else {
      $descripCat = data_input($_POST['descripCat'], ENT_NOQUOTES);
    }
  
    if (empty($_POST["descripCast"])) {;
      $hasError=true;
    } else {
      $descripCast = data_input($_POST['descripCast'], ENT_NOQUOTES);
    }
  
    if (empty($_POST["descripEng"])) {;
      $hasError=true;
    } else {
      $descripEng = data_input($_POST['descripEng'], ENT_NOQUOTES);
    }
  
    if (empty($_POST["descripIt"])) {;
      $hasError=true;
    } else {
      $descripIt = data_input($_POST['descripIt'], ENT_NOQUOTES);
    }
  
    if (empty($_POST["wpIdCat"])) {;
      $hasError=true;
    } else {
      $wpIdCat = filter_input(INPUT_POST, 'wpIdCat', FILTER_SANITIZE_NUMBER_INT);
    }
  
    if (empty($_POST["wpIdCast"])) {;
      $hasError=true;
    } else {
      $wpIdCast = filter_input(INPUT_POST, 'wpIdCast', FILTER_SANITIZE_NUMBER_INT);
    }

    if (empty($_POST["wpIdEng"])) {;
        $hasError=true;
      } else {
        $wpIdEng = filter_input(INPUT_POST, 'wpIdEng', FILTER_SANITIZE_NUMBER_INT);
      }

    if (empty($_POST["wpIdIt"])) {;
        $hasError=true;
      } else {
        $wpIdIt = filter_input(INPUT_POST, 'wpIdIt', FILTER_SANITIZE_NUMBER_INT);
      }

    if (empty($_POST["img"])) {;
        $hasError=true;
      } else {
        $img = data_input($_POST['img']);
      }
    
      if (empty($_POST["ordre"])) {;
        $hasError=true;
      } else {
        $ordre = filter_input(INPUT_POST, 'ordre', FILTER_SANITIZE_NUMBER_INT);
      }
    
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

  global $conn;
  $sql = "UPDATE db_openhistory_courses SET nameCat=:nameCat, nameCast=:nameCast, nameEng=:nameEng, nameIt=:nameIt, descripCat=:descripCat, descripCast=:descripCast, descripEng=:descripEng, descripIt=:descripIt, wpIdCat=:wpIdCat, wpIdCast=:wpIdCast, wpIdEng=:wpIdEng, wpIdIt=:wpIdIt, img=:img, ordre=:ordre WHERE id=:id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(":nameCat", $nameCat, PDO::PARAM_STR);
  $stmt->bindParam(":nameCast", $nameCast, PDO::PARAM_STR);
  $stmt->bindParam(":nameEng", $nameEng, PDO::PARAM_STR);
  $stmt->bindParam(":nameIt", $nameIt, PDO::PARAM_STR);
  $stmt->bindParam(":descripCat", $descripCat, PDO::PARAM_STR);
  $stmt->bindParam(":descripCast", $descripCast, PDO::PARAM_STR);
  $stmt->bindParam(":descripEng", $descripEng, PDO::PARAM_STR);
  $stmt->bindParam(":descripIt", $descripIt, PDO::PARAM_STR);
  $stmt->bindParam(":wpIdCat", $wpIdCat, PDO::PARAM_INT);
  $stmt->bindParam(":wpIdCast", $wpIdCast, PDO::PARAM_INT);
  $stmt->bindParam(":wpIdEng", $wpIdEng, PDO::PARAM_INT);
  $stmt->bindParam(":wpIdIt", $wpIdIt, PDO::PARAM_INT);
  $stmt->bindParam(":img", $img, PDO::PARAM_STR);
  $stmt->bindParam(":ordre", $ordre, PDO::PARAM_INT);
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