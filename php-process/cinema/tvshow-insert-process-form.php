<?php
/*
 * BACKEND CINEMA
 * FUNCIONS INSERT TV SHOW
 * @update_book_ajax
 */

 # conectare la base de datos
 $activePage = "cinema";
include_once('../../inc/connection.php');

    function data_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    // insert data to db
    if (empty($_POST["name"])) {
      $hasError = true;
    } else {
        $name = data_input($_POST["name"], ENT_NOQUOTES);
    }

    if (empty($_POST["startYear"])) {
      $hasError = true;
    } else {
      $startYear = filter_input(INPUT_POST, 'startYear', FILTER_SANITIZE_NUMBER_INT);
    }

    if (empty($_POST["endYear"])) {
      $endYear = NULL;
    } else {
      $endYear = filter_input(INPUT_POST, 'endYear', FILTER_SANITIZE_NUMBER_INT);
    }

    if (empty($_POST["season"])) {
      $hasError = true;
    } else {
      $season = filter_input(INPUT_POST, 'season', FILTER_SANITIZE_NUMBER_INT);
    }

    if (empty($_POST["chapter"])) {
      $hasError = true;
    } else {
      $chapter = filter_input(INPUT_POST, 'chapter', FILTER_SANITIZE_NUMBER_INT);
    }

    if (empty($_POST["director"])) {
      $hasError = true;
    } else {
      $director = filter_input(INPUT_POST, 'director', FILTER_SANITIZE_NUMBER_INT);
    }

    if (empty($_POST["lang"])) {
      $hasError = true;
    } else {
      $lang = filter_input(INPUT_POST, 'lang', FILTER_SANITIZE_NUMBER_INT);
    }

    if (empty($_POST["genre"])) {
      $hasError = true;
    } else {
      $genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_NUMBER_INT);
    }

    if (empty($_POST["producer"])) {
      $hasError = true;
    } else {
      $producer = filter_input(INPUT_POST, 'producer', FILTER_SANITIZE_NUMBER_INT);
    }

    if (empty($_POST["country"])) {
        $hasError = true;
      } else {
        $country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_NUMBER_INT);
      }

      if (empty($_POST["img"])) {
        $hasError = true;
      } else {
        $img = filter_input(INPUT_POST, 'img', FILTER_SANITIZE_NUMBER_INT);
      }
   
    if (!isset($hasError)) {
      global $conn;
      $sql = "INSERT INTO db_tvmovies_tvshows SET name=:name, startYear=:startYear, endYear=:endYear, season=:season, chapter=:chapter, director=:director, lang=:lang, img=:img, genre=:genre, producer=:producer, country=:country";
      $stmt= $conn->prepare($sql);
      $stmt->bindParam(":name", $name, PDO::PARAM_STR);
      $stmt->bindParam(":startYear", $startYear, PDO::PARAM_INT);
      $stmt->bindParam(":endYear", $endYear, PDO::PARAM_INT);
      $stmt->bindParam(":season", $season, PDO::PARAM_INT);
      $stmt->bindParam(":chapter", $chapter, PDO::PARAM_INT);
      $stmt->bindParam(":director", $director, PDO::PARAM_INT);
      $stmt->bindParam(":lang", $lang, PDO::PARAM_INT);
      $stmt->bindParam(":img", $img, PDO::PARAM_INT);
      $stmt->bindParam(":genre", $genre, PDO::PARAM_INT);
      $stmt->bindParam(":producer", $producer, PDO::PARAM_INT);
      $stmt->bindParam(":country", $country, PDO::PARAM_INT);

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