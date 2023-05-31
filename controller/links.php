<?php

require_once('../inc/connection.php');

// JSON of Links > all categories
if (isset($_GET['type']) && $_GET['type'] == 'categories' ) {
  global $conn;
  $data = array();
  $stmt = $conn->prepare(
      "SELECT g.id, g.genre
      FROM db_library_genres AS g
      INNER JOIN db_topics AS t ON g.id = t.idGenere
      INNER JOIN db_links AS l ON l.cat = t.id
      GROUP BY g.id
      ORDER BY g.genre ASC");
      $stmt->execute();
      if($stmt->rowCount() === 0) echo ('No rows');
      while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
          $data[] = $users;
      }
      echo json_encode($data);

} elseif (isset($_GET['type']) && $_GET['type'] == 'type' ) {
    global $conn;
    $data = array();
    $stmt = $conn->prepare(
        "SELECT t.id, t.type
        FROM db_links_type AS t
        ORDER BY t.type ASC");
        $stmt->execute();
        if($stmt->rowCount() === 0) echo ('No rows');
        while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
            $data[] = $users;
        }
        echo json_encode($data);
} elseif ( (isset($_GET['type']) && $_GET['type'] == 'topic') && (isset($_GET['id']) ) ) {
                $id = $_GET['id'];
                global $conn;
                $data = array();
                $stmt = $conn->prepare(
                    "SELECT l.web AS url, l.nom, t.id AS idTema, t.topic AS tema, l.id AS linkId, l.lang, ty.id AS idType, ty.type
                    FROM db_topics AS t
                    INNER JOIN db_library_genres AS g ON t.idGenere = g.id
                    INNER JOIN db_links AS l ON l.cat = t.id
                    LEFT JOIN db_links_type AS ty ON ty.id = l.tipus
                    WHERE t.id=?
                    ORDER BY l.nom ASC");
                    $stmt->execute([$id]);
                    if($stmt->rowCount() === 0) echo ('No rows');
                    while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                        $data[] = $users;
                    }
                    echo json_encode($data);
} elseif ( (isset($_GET['type']) && $_GET['type'] == 'link') && (isset($_GET['id']) ) ) {
                    $id = $_GET['id'];
                    global $conn;
                    $data = array();
                    $stmt = $conn->prepare(
                        "SELECT l.id, l.web, l.nom, l.cat, l.tipus, l.lang, l.linkCreated, l.linkUpdated
                        FROM db_links AS l
                        WHERE l.id=?");
                        $stmt->execute([$id]);
                        if($stmt->rowCount() === 0) echo ('No rows');
                        while($users = $stmt->fetch(PDO::FETCH_ASSOC) ){
                            $data[] = $users;
                        }
                        echo json_encode($data);
}