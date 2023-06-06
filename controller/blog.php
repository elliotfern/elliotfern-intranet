<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
$updatedPath = str_replace('/httpdocs', '', $rootDirectory);

require_once($updatedPath . '/pass/connection.php');

// JSON of Links > all categories
if ( (isset($_GET['type']) && $_GET['type'] == 'blog') && (isset($_GET['slug']) ) && (isset($_GET['lang']) ) ) {
  global $conn2;
  $slug = $_GET['slug'];
  $lang = $_GET['lang'];
  $data = array();
  $stmt = $conn2->prepare(
      "SELECT p.ID, p.post_title, p.post_content, p.post_date, p.post_modified, p.post_name, pCat.post_name AS slugCat, pCast.post_name AS slugCast, pEng.post_name AS slugEng, pIt.post_name AS slugIt, pFr.post_name AS slugFr, p.post_excerpt
      FROM xfr_posts AS p
      LEFT JOIN posts_lang AS l ON p.ID = l.$lang
      LEFT JOIN xfr_posts AS pCat ON pCat.ID = l.cat
      LEFT JOIN xfr_posts AS pCast ON pCast.ID = l.esp
      LEFT JOIN xfr_posts AS pEng ON pEng.ID = l.eng
      LEFT JOIN xfr_posts AS pFr ON pFr.ID = l.fr
      LEFT JOIN xfr_posts AS pIt ON pIt.ID = l.it
      WHERE p.post_name='$slug'
      ORDER BY p.ID ASC");
      $stmt->execute([]);
      if($stmt->rowCount() === 0) echo ('No rows');
      while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
          $data[] = $users;
      }
      echo json_encode($data);
} elseif ( (isset($_GET['type']) && $_GET['type'] == 'blog') && (isset($_GET['homepage'])) && (isset($_GET['lang']) )) {
    global $conn2;
    $id = $_GET['homepage'];
    $lang = $_GET['lang'];
    $data = array();
    $stmt = $conn2->prepare(
        "SELECT p.ID, p.post_title, p.post_content, p.post_date, p.post_name, pCat.post_name AS slugCat, pCast.post_name AS slugCast, pEng.post_name AS slugEng, pIt.post_name AS slugIt, pFr.post_name AS slugFr, p.post_excerpt
        FROM xfr_posts AS p
        LEFT JOIN posts_lang AS l ON p.ID = l.$lang
        LEFT JOIN xfr_posts AS pCat ON pCat.ID = l.cat
        LEFT JOIN xfr_posts AS pCast ON pCast.ID = l.esp
        LEFT JOIN xfr_posts AS pEng ON pEng.ID = l.eng
        LEFT JOIN xfr_posts AS pFr ON pFr.ID = l.fr
        LEFT JOIN xfr_posts AS pIt ON pIt.ID = l.it
        WHERE p.ID=$id");
        $stmt->execute([]);
        if($stmt->rowCount() === 0) echo ('No rows');
        while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $data[] = $users;
        }
        echo json_encode($data);
}