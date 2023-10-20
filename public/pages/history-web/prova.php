<?php
# conectare la base de datos
include_once('../inc/connection.php');

echo "<h3>Articles course</h3>";
      echo "<p><button type='button' class='btn btn-dark btn-sm' id='btnAddCollection' onclick='addCollectionBook(".$id.")' data-bs-toggle='modal' data-bs-target='#modalCreateBookCollection'>Add new collection</button></p>";

      global $conn;

      $sql = "SELECT wpCat.ID AS idCat, wpCat.post_title AS titleCat, wpCast.ID AS idCast, wpCast.post_title AS titleCast, wpEng.ID AS idEng, wpEng.post_title AS titleEng, wpIt.ID AS idIt, wpIt.post_title AS titleIt 
      FROM db_openhistory_articles AS a
      INNER JOIN kvqphwff_web.xfr_posts AS wpCat ON a.wpCat = wpCat.ID
      LEFT JOIN kvqphwff_web.xfr_posts AS wpCast ON a.wpCast = wpCast.ID
      LEFT JOIN kvqphwff_web.xfr_posts AS wpEng ON a.wpEng = wpEng.ID
      LEFT JOIN kvqphwff_web.xfr_posts AS wpIt ON a.wpIt = wpIt.ID
      WHERE a.cursId = :id
      ORDER BY a.ordre ASC";

          $id = 1;

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
          echo "<tr>";
          echo "<td>".$titleCat."</td>";
          echo "<td>".$titleEng."</td>";
          echo "<td>".$titleCast."</td>";
          echo "<td>".$titleIt."</td>";
          echo '<td>
          <button type="button" onclick="btnUpdateBook('.$id.')" id="btnUpdateBook" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalUpdateBook" data-id="'.$id.'">Update</button></td>';
          echo '<td>
          <button type="button" onclick="btnUpdateBook('.$id.')" id="btnUpdateBook" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalUpdateBook" data-id="'.$id.'">Delete</button></td>';
          echo "</tr>";
        }
      echo "</tbody>";                            
      echo "</table>";
      echo "</div>";
    } else {

    }