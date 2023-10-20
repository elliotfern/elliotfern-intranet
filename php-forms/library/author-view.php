<?php
# conectare la base de datos
include_once('../../inc/connection.php');
include_once('../../inc/functions.php');

if (isset($_POST['idAuthor'])) {
    $id = $_POST['idAuthor'];
} else {
    $id = $_POST['idAuthor'];
}

$author = selectSingleLibraryAuthor($id);
          $nomAutor = $author['AutNom'];
          $AutCognom1 = $author['AutCognom1'];
          $DataNaix = $author['yearBorn'];
          $DataDef = $author['yearDie'];
          $AutWikipedia = $author['AutWikipedia'];
          $AutOcupacio = $author['nameOc'];
          $AutMoviment = $author['nomMovEng'];
          $pais = $author['nomPaisEng'];
          $idPais = $author['idPais'];
          $idMov = $author['idMov'];
          $AutDescrip = $author['AutDescrip'];
          $nameImg = $author['nameImg'];
          $typeName = "library-author";
          $altCat = $author['alt'];
          $dateCreated = date_create($author['dateCreated']);
          $dateCreated_net = date_format($dateCreated, 'd-m-Y');

          if (!empty($row['dateModified'])) {
            $dateModified = date_create($author['dateModified']);
            $dateModified_net = date_format($dateModified, 'd-m-Y');
          }

echo "<div class='container'>";
echo "<div class='row'>
      <div class='col-sm-8'>";
         if ($nameImg == '') { 
          echo "<img src='".IMG_DEFAULT."' class='img-thumbnail img-fluid rounded mx-auto d-block' style='height:auto;width:auto;max-width:auto' alt='Author' title='Author'>";
        } else {
          echo "<img src='".IMG_URL."".$typeName."/".$nameImg.".jpg' class='img-thumbnail img-fluid rounded mx-auto d-block' style='height:auto;width:auto;max-width:auto' alt='".$altCat."' title='".$altCat."'>";
        }      
   echo "</div>";
          echo '<div class="col-sm-4">';
          echo '<button type="button" onclick="updateAuthor('.$id.')" id="btnUpdateAuthor" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalUpdateAuthor">Update author</button>';
                  echo '<div class="alert alert-primary" role="alert" style="margin-top:10px">
                      <p>'.stripslashes($AutDescrip).'</p>';
                      
                    echo "</p></small>";
                      if ($DataNaix == '') { 
                      echo "";
                       } else {
                       echo "<p><strong>".LIBRARY_YEAR_BIRTH.": </strong>".htmlspecialchars($DataNaix, ENT_QUOTES)."</p>";
                      }

                      if ($DataDef == '0') { 
                      echo "";
                        } else {
                          echo "<p><strong>".LIBRARY_YEAR_DEAD.": </strong>".htmlspecialchars($DataDef, ENT_QUOTES)."</p>";
                      }

                      echo "<p><strong>Country: </strong><a href='".BIBLIOTECA_FITXA_PAIS."&idPais=".$idPais."' title='Country'>".$pais."</a></p>";
                      
                      echo "<p><strong>".LIBRARY_PROFESSION.": </strong>".htmlspecialchars($AutOcupacio, ENT_QUOTES)."</p>";

                      echo "<p><strong>".LIBRARY_MOVEMENT.": </strong><a href='".BIBLIOTECA_FITXA_MOVIMENT."&idMov=".$idMov."' title='Movement'>".htmlspecialchars($AutMoviment, ENT_QUOTES)."</a></p>";

                      if ($AutWikipedia == '') { 
                      echo "";
                       } else {
                       echo "<p><strong>".LIBRARY_WIKIPEDIA.": </strong><a href='".htmlspecialchars($AutWikipedia, ENT_QUOTES)."' target='_blank' title='Wikipedia'>Web</a>";
                      }

                      echo "<p><strong>Created on: </strong> ".$dateCreated_net." ";
                      
                      if (is_null($dateModified) == 1 ) { 
                      } else {
                        echo "<p><strong>Updated on: </strong> ".$dateModified_net." ";
                      }
                 echo "</div>";
                echo "</div>";
           echo "</div>";
 echo "</div>";
  
// books author
$stmt = $conn->prepare("SELECT b.id, b.any, autor.AutCognom1, autor.AutNom, b.titol
FROM db_library_books AS b
INNER JOIN db_library_authors AS autor ON b.nomAutor = autor.id
WHERE autor.id = :id
ORDER BY b.any DESC");
$stmt->execute(['id' => $id]); 
$data = $stmt->fetchAll();
// and somewhere later:
  if (!empty($data)) {
    echo "<hr/>";
    echo "<h2>Books</h2>";
    echo "<p><button type='button' class='btn btn-dark btn-sm' id='btnAddBook' onclick='btnCreateBook(".$id.")' data-bs-toggle='modal' data-bs-target='#modalCreateBook'>".LIBRARY_BOOKS_ADD."</button></p>";

    echo '<div class="'.TABLE_DIV_CLASS.'">
          <table class="'.TABLE_CLASS.'" id="booksAuthor">
          <thead class="'.TABLE_THREAD.'">';     
    echo "<tr>";
    echo "<th>".LIBRARY_PUBLICATION_YEAR." &darr;</th>";
    echo "<th>".LIBRARY_BOOK_TITLE."</th>";
    echo "<th>Actions</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
  foreach ($data as $row) {
      $bookId = $row['id'];
      $bookName = $row['titol'];
      $bookName2 = htmlspecialchars($bookName, ENT_QUOTES);
      $bookNameS = "\"".$bookName2."\"";
      
      echo "<tr>";
      echo "<td>".$row['any']."</td>";
      echo "<td><a href='#' data-bs-toggle='modal' data-bs-target='#modalViewBook' onclick='viewDetailBook(".$bookId.", ".$bookNameS.");return false;'>".$bookName."</a></td>";
      echo "<td>";
      echo '<button type="button" onclick="btnUpdateBook('.$bookId.')" id="btnUpdateBook" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalUpdateBook" data-id="'.$bookId.'">Update</button>

            </td>';
      echo "</tr>";
    }
  echo "</tbody>";                            
  echo "</table>";
  echo "</div>";
} else {
  echo "<hr/>";
    echo "<h2>Books</h2>";
    echo "<button type='button' class='btn btn-dark btn-sm' id='btnAddBook' onclick='btnCreateBook(".$id.")' data-bs-toggle='modal' data-bs-target='#modalCreateBook'>".LIBRARY_BOOKS_ADD."</button>";

}
 
?>