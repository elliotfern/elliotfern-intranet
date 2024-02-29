<?php
/*
 * BACKEND LIBRARY
 * FUNCIONS INSERT BOOK
 * @update_book_ajax
 */

  $tmpfilesize = isset($_FILES["fileToUpload"]["size"]) ? $_FILES["fileToUpload"]["size"] : 0;
  $tmpfilename = isset($_FILES["fileToUpload"]["tmp_name"]) ? $_FILES["fileToUpload"]["tmp_name"] : 0;
  $tmpfiletype = isset($_FILES["fileToUpload"]["type"]) ? $_FILES["fileToUpload"]["type"] : 0;

  $type = $_POST['typeImg'];
  
  if ($type == 1) {
    $typeName = "08_biblioteca_llibres/autors"; 
  } elseif ($type == 2) {
    $typeName = "08_biblioteca_llibres/llibres";
  } elseif ($type == 7) {
    $typeName = "11_cinema_series/series";
  } elseif ($type == 8) {
    $typeName = "11_cinema_series/pelicules";
  } elseif ($type == 9) {
    $typeName = "11_cinema_series/actors";
  } else {
    $typeName = "elliotfern";
  }

  $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/public/00_inc/img/' . $typeName. '/';

  if ( ($_FILES["fileToUpload"]["size"] < 2097152) && ( ($_FILES["fileToUpload"]["type"] == "image/jpeg") || ($_FILES["fileToUpload"]["type"] == "image/jpg") || ($_FILES["fileToUpload"]["type"] == "image/png") || ($_FILES["fileToUpload"]["type"] == "image/gif") ) ) {
     move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_dir . $_FILES['fileToUpload']['name']);
    }
    // insert data to db
    $name = $_FILES['fileToUpload']['name'];
    $nameImg = strstr($name, '.', true);

    $alt = data_input($_POST['alt']);

    $dateCreated = date('Y-m-d');

    global $conn;
    $sql = "INSERT INTO db_img SET nameImg=:nameImg, typeImg=:typeImg, alt=:alt, dateCreated=:dateCreated";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":nameImg", $nameImg, PDO::PARAM_STR);
    $stmt->bindParam(":typeImg", $type, PDO::PARAM_INT);
    $stmt->bindParam(":alt", $alt, PDO::PARAM_STR);
    $stmt->bindParam(":dateCreated", $dateCreated, PDO::PARAM_STR);
  
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

 