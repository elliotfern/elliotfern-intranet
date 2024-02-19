<?php
$id = $params['id'];

echo '<h1>Cinema & TV shows Database</h1>';
echo '<h2>TV shows</h2>';

echo "<p><button type='button' class='btn btn-dark btn-sm' id='btnAddtvshow' onclick='btnFAddTVShow()' data-bs-toggle='modal' data-bs-target='#modalCreateTVShow'>Create tv show</button></p>";

echo "<hr>";

?>
<script type="module">
tvshowPageInfo('<?php echo $id; ?>')
</script>

<?php


if (!empty($tvshow)) {
          $name = $tvshow['name'];
          $startYear = $tvshow['startYear'];
          $endYear = $tvshow['endYear'];
          $season = $tvshow['season'];
          $chapter = $tvshow['chapter'];
          $nomDirector = $tvshow['nomDirector'];
          $lastName = $tvshow['lastName'];
          $language = $tvshow['language'];
          $topic = $tvshow['topic'];
          $producer = $tvshow['producer'];
          $country = $tvshow['country'];
          $nameImg = $tvshow['nameImg'];
          $typeName = "cinema-television";
          $idDirector = $tvshow['idDirector'];
          /* $dateCreated = $tvshow['dateCreated'];
          $dateCreated_net = date("d-m-Y", strtotime($dateCreated));
          $dateModified = $tvshow['dateModified'];
          $dateModified_net = date("d-m-Y", strtotime($dateModified)); */

          echo "<div class='container'>";
          echo "<div class='row'>
                <div class='col-sm-8'>";
                 if ($nameImg == '0') { 
                     echo "<img src='".IMG_DEFAULT."' class='img-thumbnail img-fluid rounded mx-auto d-block' style='height:auto;width:auto;max-width:auto' alt='Author' title='Author'>";
                   } else {
                     echo "<img src='".IMG_URL.$typeName."/".$nameImg.".jpg' class='img-thumbnail img-fluid rounded mx-auto d-block' style='height:auto;width:auto;max-width:auto' alt='TV Show' title='TV Show'>";
                   }          
          echo "</div>";
          echo '<div class="col-sm-4">
                   <div class="alert alert-primary" role="alert" style="margin-top:10px">
                   <h4 class="alert-heading" id="authorName">'.$name.'</h4>';
                   echo "<p><span class='fw-bold'>Director:</span> <a href='&idDirector=".$idDirector."' title='Director' data-toggle='tooltip'>".$nomDirector." " .$lastName."</a></p>";
                   echo "<p><span class='fw-bold'>Original Language: </span>" .$language."</p>";
                   echo "<p><span class='fw-bold'>Genre: </span>".$topic."</p>";
                   echo "<p><span class='fw-bold'>TV producer: </span>".$producer."</p>";
                   echo "<p><span class='fw-bold'>Years: </span>";
                       if ($startYear == $endYear) { 
                             echo " ".$startYear."</p>";
                           } elseif ($endYear == 0) {
                               echo " ".$startYear." - present</p>";
                           } else {
                             echo " ".$startYear." - ".$endYear."</p>";
                           }
                   echo "<p><span class='fw-bold'>No. of seasons:</span> ".$season."</p>";
                   echo "<p><span class='fw-bold'>No. of episodes:</span> ".$chapter."</p>";
                   echo "<p><span class='fw-bold'>Country:</span> ".$country."</p>";
               echo "</div>
              </div>
         </div>
       </div>";

       // CAST
       echo "<hr style='margin-top:15px'>";
       echo "<h3>Cast</h3>";
       echo "<p><a href='&idtvShow=".$id."' class='btn btn-info' role='button' aria-pressed='true'>Add actor to TV Show &rarr;</a></p>";
       
       global $conn;
        $stmt = $conn->prepare("SELECT a.actorLastName, a.actorFirstName, a.id AS idActor, sa.role, img.nameImg, sa.id AS idCast
        FROM db_tvmovies_tvshows AS s
        INNER JOIN db_tvmovies_tvshows_cast AS sa on s.id = sa.idtvShow
        INNER JOIN db_tvmovies_actors AS a ON a.id = sa.idActor
        LEFT JOIN db_img AS img ON a.img = img.id
        WHERE s.id = :id
        ORDER BY a.actorLastName ASC");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetchAll();
        if (!empty($data)) {
           echo "<div class='".TABLE_DIV_CLASS."'>";
           echo "<table class='".TABLE_CLASS."'>";
           echo "<thead class='".TABLE_THREAD."'>";
                   echo "<tr>";
                   echo "<th></th>";
                   echo "<th>Actor</th>";
                   echo "<th>Role</th>";
                   echo "<th>Actions</th>";
                   echo "</tr>";
                   echo "</thead>";
                   echo "<tbody>";
        foreach ($data as $row) {
          $typeName = "cinema-actor";
          $actorFirstName = $row['actorFirstName'];
          $actorLastName = $row['actorLastName'];
          $idActor = $row['idActor'];

          $actorFirstName2 = htmlspecialchars($actorFirstName, ENT_QUOTES);
          $actorFirstName22 = "\"".$actorFirstName2."\"";
          $actorLastName2 = htmlspecialchars($actorLastName, ENT_QUOTES);
          $actorLastName22 = "\"".$actorLastName2."\"";
                   echo "<tr>";
                   echo "<td>";
                   if ($row['nameImg'] == '0') { 
                     echo "<img src='".IMG_DEFAULT."' class='img-thumbnail img-fluid rounded mx-auto d-block' style='height:auto;width:auto;max-width:auto' alt='Author' title='Author'>";
                   } else {
                     echo "<a href='#' data-bs-toggle='modal' data-bs-target='#modalViewActor' onclick='viewDetailActor(".$idActor.", ".$actorLastName22.", ".$actorFirstName22.");return false;'><img src='".IMG_URL.$typeName."/".$row['nameImg'].".jpg' class='img-thumbnail img-fluid rounded mx-auto d-block' style='height:auto;width:100%;max-width:100px' alt='Actor' title='Actor'></a>";
                   }  
                   echo "</td>";
                   echo "<td><a href='#' data-bs-toggle='modal' data-bs-target='#modalViewActor' onclick='viewDetailActor(".$idActor.", ".$actorLastName22.", ".$actorFirstName22.");return false;'>".$actorFirstName." ".$actorLastName."</a></td>";
                   echo "<td>".$row['role']."</td>";
                   echo "<td>
                    <a href='&idCast=".$row['idCast']."' class='btn btn-warning btn-sm' role='button' aria-pressed='true'>Update</a>
                   <a href='&idCast=".$row['idCast']."' class='btn btn-danger btn-sm' role='button' aria-pressed='true'>Remove</a>
                   </td>";
                   echo "</tr>";
                   }
                   echo "</tbody>                           
                   </table>
                   </div>";
    } else {
        echo "<hr/>";
          
    }
} else {
  //nothin to show.
}


# footer
require_once(APP_ROOT . '/public/01_inici/footer.php');