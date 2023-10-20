<?php

/*
session_start();
if(!isset($_SESSION['user'])):
	header('Location: /control/login.php');
	exit();
endif;
*/

$updatedPath = str_replace('control.elliotfern.com', '', $url_root);
require_once($updatedPath . '/pass/connection.php');
include_once('../inc/functions.php');

// JSON of Links > all categories
if ( (isset($_GET['type']) && $_GET['type'] == 'blog') && (isset($_GET['slug']) ) ) {
  global $conn2;
  $slug = $_GET['slug'];
  $data = array();
  $stmt = $conn2->prepare(
      "SELECT ID, post_title, post_content, post_date, post_name
      FROM xfr_posts
      WHERE post_name='$slug'
      ORDER BY ID ASC");
      $stmt->execute([]);
      if($stmt->rowCount() === 0) echo ('No rows');
      while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
          $data[] = $users;
      }
      echo json_encode($data);
} elseif ( (isset($_GET['type']) && $_GET['type'] == 'blog') && (isset($_GET['lang']) ) ) {
        global $conn2;
        $data = array();
        $stmt = $conn2->prepare(
            "SELECT p.ID, p.post_title, p.post_content, p.post_date, p.post_name, pCat.post_name AS slugCat, pCast.post_name AS slugCast, pEng.post_name AS slugEng, pIt.post_name AS slugIt, pFr.post_name AS slugFr, l.lang
            FROM xfr_posts AS p
            LEFT JOIN posts_lang AS l ON p.ID = l.art
            LEFT JOIN xfr_posts AS pCat ON pCat.ID = l.cat
            LEFT JOIN xfr_posts AS pCast ON pCast.ID = l.esp
            LEFT JOIN xfr_posts AS pEng ON pEng.ID = l.eng
            LEFT JOIN xfr_posts AS pFr ON pFr.ID = l.fr
            LEFT JOIN xfr_posts AS pIt ON pIt.ID = l.it
            ORDER BY p.ID ASC");
            $stmt->execute([]);
            if($stmt->rowCount() === 0) echo ('No rows');
            while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                $data[] = $users;
            }
            echo json_encode($data);
     
    }