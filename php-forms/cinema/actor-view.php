<?php
# conectare la base de datos
include_once('../../inc/connection.php');
include_once('../../inc/functions.php');

if (isset($_POST['idActor'])) {
    $id = filter_input(INPUT_POST, 'idActor', FILTER_SANITIZE_NUMBER_INT);
} else {
    $id = filter_input(INPUT_POST, 'idActor', FILTER_SANITIZE_NUMBER_INT);
}

//  a.id, a.actorLastName, a.actorFirstName, a.actorCountry, a.birthYear, a.deadYear, a.img, c.country, img.nameImg

$actor = selectSingleActor($id);

if (!empty($actor)) {
    $actorLastName = $actor['actorLastName'];
    $actorFirstName = $actor['actorFirstName'];
    $actorCountry = $actor['actorCountry'];
    $birthYear = $actor['birthYear'];
    $deadYear = $actor['deadYear'];
    $nameImg = $actor['nameImg'];
    $country = $actor['country'];
    $typeName = "cinema-actor";
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
                     echo "<img src='".IMG_URL.$typeName."/".$nameImg.".jpg' class='img-thumbnail img-fluid rounded mx-auto d-block' style='height:auto;width:auto;max-width:auto' alt='Actor' title='Actor'>";
                   }          
          echo "</div>";
          echo '<div class="col-sm-4">
                   <div class="alert alert-primary" role="alert" style="margin-top:10px">
                   <h4 class="alert-heading">'.$actorFirstName.' '.$actorLastName.'</h4>';
                   echo "<p>";
                   if ($deadYear == NULL) {
                       $curYear = date('Y');
                       $years = $curYear - $birthYear;
                       echo "<span class='fw-bold'>Birth year: </span> ".$birthYear." (".$years." years)</p>";
                   } else {
                       $years2 = $deadYear - $birthYear;
                       echo "<span class='fw-bold'>Years: </span>".$birthYear." - ".$deadYear." (".$years2." years)</p>";
                   }
                   echo "<p><span class='fw-bold'>Country:</span> ".$country."</p>";
               echo "</div>
              </div>
         </div>
       </div>";

       // CAST TV SHOWS
       echo "<hr>";
       echo "<h3>TV Series:</h3>";
       echo "<p><button type='button' class='btn btn-dark btn-sm' id='btnAssActorTVshow' onclick='btnAssActorTVshow(".$id.")' data-bs-toggle='modal' data-bs-target='#modalAssociateActorTVShow'>Add actor to TV Show &rarr;</button></p>";

       global $conn;
        $stmt = $conn->prepare("SELECT s.name, s.id AS idSerie, sa.role, sa.id AS idCast, s.startYear, s.endYear
        FROM db_tvmovies_tvshows_cast AS sa
        INNER JOIN db_tvmovies_tvshows AS s ON s.id = sa.idtvShow
        WHERE sa.idActor = :id
        ORDER BY s.startYear ASC");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetchAll();
        if (!empty($data)) {
           echo "<div class='".TABLE_DIV_CLASS."'>";
           echo "<table class='".TABLE_CLASS."'>";
           echo "<thead class='".TABLE_THREAD."'>";
           echo "<tr>";
           echo "<th>TV Show</th>";
           echo "<th>Years</th>";
           echo "<th>Role</th>";
           echo "<th>Actions</th>";
           echo "</tr>";
           echo "</thead>";
           echo "<tbody>";
           foreach ($data as $row) {
            $idSerie = $row['idSerie'];
            $startYear = $row['startYear'];
            $endYear = $row['endYear'];
            $idCast = $row['idCast'];
            $role = $row['role'];
            $name = $row['name'];

            $name2 = htmlspecialchars($name, ENT_QUOTES);
            $name22 = "\"".$name2."\"";

               echo "<tr>";
               echo "<td><a href='#' data-bs-toggle='modal' data-bs-target='#modalViewTVShow' onclick='viewDetailTVshow(".$idSerie.", ".$name22.");return false;'>".$name."</a></td>";
               echo "<td>";
                   if ($startYear == $endYear) { 
                     echo " ".$startYear."</p>";
                   } elseif ($endYear == 0) {
                       echo " ".$startYear." - present</p>";
                   } else {
                     echo " ".$startYear." - ".$endYear."</p>";
                   }
                   echo "</td>";
               echo "<td>".$role."</td>";
               echo "<td>
                   <a href='&idCast=".$idCast."' class='btn btn-warning btn-sm' role='button' aria-pressed='true'>Update</a>
                   <a href='&idCast=".$idCast."' class='btn btn-danger btn-sm' role='button' aria-pressed='true'>Remove</a>
                   </td>";
               echo "</tr>";
           }
           echo "</tbody>                           
           </table>
           </div>";
       } else {
           echo "<p>This actor has no tv show associated with him.</p>";     
       }

       // MOVIES
       echo "<hr>";
       echo "<h3>Movies:</h3>";
       echo "<p><a href='&idActor=".$id."' class='btn btn-info' role='button' aria-pressed='true'>Add actor to movie &rarr;</a></p>";

       global $conn;
       $stmt = $conn->prepare("SELECT m.nameMovie, m.id AS idMovie, m.yearMovie, ma.role, ma.idMovieCast
       FROM db_tvmovies_movies AS m
       INNER JOIN db_tvmovies_movies_cast AS ma ON ma.idMovie = m.id
       WHERE ma.idMovieActor = :id");
       $stmt->execute(['id' => $id]);
       $data = $stmt->fetchAll();
       if (!empty($data)) { 
               echo "<div class='".TABLE_DIV_CLASS."'>";
               echo "<table class='".TABLE_CLASS."'>";
               echo "<thead class='".TABLE_THREAD."'>";
               echo "<tr>";
               echo "<th>Movie</th>";
               echo "<th>Role</th>";
               echo "<th>Year</th>";
               echo "<th>Actions</th>";
               echo "</tr>";
               echo "</thead>";
               echo "<tbody>";
               foreach ($data as $row) {
                $idMovie = $row['idMovie'];
                $nameMovie = $row['nameMovie'];
                $role = $row['role'];
                $yearMovie = $row['yearMovie'];
                $idMovieCast = $row['idMovieCast'];


                   echo "<tr>";
                   echo "<td><a href='&idMovie=".$idMovie."'>".$nameMovie."</a></td>";
                   echo "<td>".$role."</td>";
                   echo "<td>".$yearMovie."</td>";
                   echo "<td>
                    <a href='&idMovieCast=".$idMovieCast."' class='btn btn-warning btn-sm' role='button' aria-pressed='true'>Update</a>
                   <a href='&idMovieCast=".$idMovieCast."' class='btn btn-danger btn-sm' role='button' aria-pressed='true'>Remove</a>
                   </td>";
                   echo "</tr>";
               }
               echo "</tbody>                           
               </table>
               </div>";
           } else {
               echo "<p>This actor has no movie associated with him.</p>"; 
         }
} else {
    // nothing to show. ID don't valid.  
}
?>