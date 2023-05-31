<?php

/*
session_start();
if(!isset($_SESSION['user'])):
	header('Location: /control/login.php');
	exit();
endif;
*/

require_once('../inc/connection.php');

// JSON of Links > all categories
if (isset($_GET['type']) && $_GET['type'] == 'topics' ) {
  global $conn;
  $data = array();
  $stmt = $conn->prepare(
      "SELECT id, topic
      FROM db_topics
      ORDER BY topic ASC");
      $stmt->execute();
      if($stmt->rowCount() === 0) echo ('No rows');
      while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
          $data[] = $users;
      }
      echo json_encode($data);
} elseif (isset($_GET['type']) && $_GET['type'] == 'books' ) {
    global $conn;
    $data = array();
    $stmt = $conn->prepare(
        "SELECT book.titol, book.titolEng, book.any, book.img, book.idEd, book.idGen, book.lang, book.nomAutor, book.tipus, book.id, a.id AS idAutor, a.AutCognom1, a.AutNom, g.genre AS nomGenEng, g.id AS idGenere, bc.nomCollection
        FROM db_library_books AS book
        INNER JOIN db_library_authors AS a ON book.nomAutor = a.id
        INNER JOIN db_library_genres AS g ON book.idGen = g.id
        LEFT JOIN  db_library_books_collection AS bookc ON book.id = bookc.idBook
        LEFT JOIN  db_library_collection AS bc ON bookc.idCollection = bc.id");
        $stmt->execute();
        if($stmt->rowCount() === 0) echo ('No rows');
        while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $data[] = $users;
        }
        echo json_encode($data);
}