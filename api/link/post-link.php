<?php
/*
 * BACKEND LINK
 * FUNCIONS INSERT LINK
 */

// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('HTTP/1.1 405 Method Not Allowed');
  echo json_encode(['error' => 'Method not allowed']);
  exit();
} else {

  // insert data to db
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
      $cat = data_input($_POST['cat'], ENT_COMPAT);
    }

    if (empty($_POST["lang"])) {
      $hasError=true;
    } else {
      $lang = data_input($_POST['lang'], ENT_COMPAT);
    }

    if (empty($_POST["tipus"])) {
      $hasError=true;
    } else {
      $tipus = data_input($_POST['tipus'], ENT_COMPAT);
    }

      $linkCreated = data_input($_POST['linkCreated']);
      $linkUpdated = data_input($_POST['linkCreated']);
    
  if (!isset($hasError)) {
      global $conn;
      $sql = "INSERT INTO db_links SET nom=:nom, web=:web, cat=:cat, lang=:lang, tipus=:tipus, linkCreated=:linkCreated, linkUpdated=:linkUpdated";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(":nom", $nom, PDO::PARAM_STR);
      $stmt->bindParam(":web", $web, PDO::PARAM_STR);
      $stmt->bindParam(":cat", $cat, PDO::PARAM_INT);
      $stmt->bindParam(":lang", $lang, PDO::PARAM_INT);
      $stmt->bindParam(":tipus", $tipus, PDO::PARAM_INT);
      $stmt->bindParam(":linkCreated", $linkCreated, PDO::PARAM_STR);
      $stmt->bindParam(":linkUpdated", $linkUpdated, PDO::PARAM_STR);
      $stmt->execute();
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
}
  