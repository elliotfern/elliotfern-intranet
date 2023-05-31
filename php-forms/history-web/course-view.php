<?php
# conectare la base de datos
include_once('../../inc/connection.php');

if (isset($_POST['idCourse'])) {
    $id = $_POST['idCourse'];
} else {
    $id = $_POST['idCourse'];
}

      echo "<h3>Articles course</h3>";
      echo "<p><button type='button' class='btn btn-dark btn-sm' id='btnAddCollection' onclick='addCollectionBook(".$id.")' data-bs-toggle='modal' data-bs-target='#modalCreateBookCollection'>Add new collection</button></p>";

          $sql = "SELECT wpCat.ID AS idCat, wpCat.post_title AS titleCat, wpCast.ID AS idCast, wpCast.post_title AS titleCast, wpEng.ID AS idEng, wpEng.post_title AS titleEng, wpIt.ID AS idIt, wpIt.post_title AS titleIt, wpFr.ID AS idFr, wpFr.post_title AS titleFr, a.id AS idArt
          FROM db_openhistory_articles AS a
          INNER JOIN kvqphwff_web.xfr_posts AS wpCat ON a.wpCat = wpCat.ID
          LEFT JOIN kvqphwff_web.xfr_posts AS wpCast ON a.wpCast = wpCast.ID
          LEFT JOIN kvqphwff_web.xfr_posts AS wpEng ON a.wpEng = wpEng.ID
          LEFT JOIN kvqphwff_web.xfr_posts AS wpIt ON a.wpIt = wpIt.ID
          LEFT JOIN kvqphwff_web.xfr_posts AS wpFr ON a.wpFr = wpFr.ID
          WHERE a.cursId = :id
          ORDER BY a.ordre ASC";

        global $conn;
        $statement = $conn->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

      if (!empty($rows)) {
        // and somewhere later:
        echo '<div class="'.TABLE_DIV_CLASS.'">
        <table class="'.TABLE_CLASS.'" id="booksAuthor">
        <thead class="'.TABLE_THREAD.'">';     
        echo "<tr>";
        echo "<th>Catalan &darr;</th>";
        echo "<th>English</th>";
        echo "<th>Spanish</th>";
        echo "<th>Italian</th>";
        echo "<th>French</th>";
        echo "<th></th>";
        echo "<th></th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($rows as $row) {
          $titleCat = $row['titleCat'];
          $titleEng = $row['titleEng'];
          $titleCast = $row['titleCast'];
          $titleIt = $row['titleIt'];
          $titleFr = $row['titleFr'];
          $idCat = $row['idCat'];
          $idCast = $row['idCast'];
          $idEng = $row['idEng'];
          $idIt = $row['idIt'];
          $idFr = $row['idFr'];
          $idArt = $row['idArt'];
          echo "<tr>";
          echo "<td><a href='http://elliotfern.com/?p=".$idCat."' target=_blank>".$titleCat."</a></td>";
          echo "<td><a href='http://elliotfern.com/?p=".$idEng."' target=_blank>".$titleEng."</a></td>";
          echo "<td><a href='http://elliotfern.com/?p=".$idCast."' target=_blank>".$titleCast."</a></td>";
          echo "<td><a href='http://elliotfern.com/?p=".$idIt."' target=_blank>".$titleIt."</a></td>";
          echo "<td><a href='http://elliotfern.com/?p=".$idFr."' target=_blank>".$titleFr."</a></td>";
          echo '<td>
          <button type="button" onclick="btnUpdateHistoryArticle('.$idArt.')" id="botonUpdateHistoryArticle" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#updateHistoryArticle" data-id="'.$idArt.'">Update</button></td>';
          echo '<td>
          <button type="button" onclick="btnUpdateBook('.$idArt.')" id="btnUpdateBook" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalUpdateBook" data-id="'.$idArt.'">Delete</button></td>';
          echo "</tr>";
        }
      echo "</tbody>";                            
      echo "</table>";
      echo "</div>";
    } else {

    }
   
// en div
    echo '</div>';

?>

