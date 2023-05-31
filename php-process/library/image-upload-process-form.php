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
  
  $tmpfilesize = isset($_FILES["fileToUpload"]["size"]) ? $_FILES["fileToUpload"]["size"] : 0;
  $tmpfilename = isset($_FILES["fileToUpload"]["tmp_name"]) ? $_FILES["fileToUpload"]["tmp_name"] : 0;
  $tmpfiletype = isset($_FILES["fileToUpload"]["type"]) ? $_FILES["fileToUpload"]["type"] : 0;

  $type = $_POST['type'];
  
  if ($type == 1) {
    $typeName = "library-author"; 
  } elseif ($type == 2) {
    $typeName = "library-book";
  } else {
    $typeName = "elliotfern";
  }

  $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/elliotfern/app/img/' . $typeName. '/';

  if ( ($_FILES["fileToUpload"]["size"] < 2097152) && ( ($_FILES["fileToUpload"]["type"] == "image/jpeg") || ($_FILES["fileToUpload"]["type"] == "image/jpg") || ($_FILES["fileToUpload"]["type"] == "image/png") || ($_FILES["fileToUpload"]["type"] == "image/gif") ) ) {
     move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_dir . $_FILES['fileToUpload']['name']);
    }
    // insert data to db
    $name = $_FILES['fileToUpload']['name'];
    $nameImg = strstr($name, '.', true);

    $alt = data_input($_POST['alt']);
    $dateCreated = $_POST['dateCreated'];
    
    $sql = "INSERT INTO db_img SET nameImg=:nameImg, typeImg=:typeImg, alt=:alt, dateCreated=:dateCreated";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":nameImg", $nameImg, PDO::PARAM_STR);
    $stmt->bindParam(":typeImg", $type, PDO::PARAM_INT);
    $stmt->bindParam(":alt", $alt, PDO::PARAM_STR);
    $stmt->bindParam(":dateCreated", $dateCreated, PDO::PARAM_STR);
  
    if ($stmt->execute()) {
      $stmt = $conn->prepare("SELECT i.id, i.alt
      FROM db_img AS i
      ORDER BY i.id DESC LIMIT 0 , 1");
      $stmt->execute(); 
      $data = $stmt->fetchAll();
      foreach ($data as $row) {
        $idImg = $row['id'];
        $alt2 = $row['alt'];
      }

      // response output
      $response = array(
          'status' => 'success', 
          'id' => $idImg,
          'name' => $alt2
      );

      header( "Content-Type: application/json" );
      echo json_encode($response);
    } else {
      // response output - data error
      $response['status'] = 'error';
      header( "Content-Type: application/json" );
      echo json_encode($response);
    }

 