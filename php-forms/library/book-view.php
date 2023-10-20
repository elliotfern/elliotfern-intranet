<?php
# conectare la base de datos
include_once('../../inc/connection.php');

if (isset($_POST['idBook'])) {
    $id = $_POST['idBook'];
} else {
    $id = $_POST['idBook'];
}

$stmt = $conn->prepare("SELECT autor.id, autor.AutNom, autor.AutCognom1, book.titol, book.dateCreated, book.dateModified, book.any, editorial.nomEditorial, g.genre AS nomGenEng, l.language, editorial.idEditorial, g.id AS idGenere, img.nameImg, img.alt, type.name AS typeName, bt.nomTipusEng, autor2.id AS idAutor2, autor2.AutNom AS AutNom2, autor2.AutCognom1 AS AutCognom2
FROM db_library_books AS book
LEFT JOIN db_library_authors AS autor ON book.nomAutor = autor.id
LEFT JOIN db_library_books_authors  AS ba ON book.id = ba.idBook
LEFT JOIN db_library_authors AS autor2 ON ba.idAuthor = autor2.id
LEFT JOIN db_library_genres AS g ON book.idGen = g.id
LEFT JOIN db_library_publishers AS editorial ON book.IdEd = editorial.idEditorial
LEFT JOIN db_countries AS pais ON editorial.paisEditorial = pais.id
LEFT JOIN db_library_languages AS l ON book.lang = l.id
LEFT JOIN db_img AS img ON book.img = img.id
LEFT JOIN db_img_type AS type ON img.typeImg = type.id
INNER JOIN db_library_booktype  AS bt ON book.tipus = bt.id
WHERE book.id = :id");
$stmt->execute(['id' => $id]);
$data = $stmt->fetchAll();
// and somewhere later:
foreach ($data as $row) {
    $idAutor = $row['id'];
          $nomAutor = $row['AutNom'];
          $AutCognom1 = $row['AutCognom1'];
          $idAutor2 = $row['idAutor2'];
          $nomAutor2 = $row['AutNom2'];
          $AutCognom2 = $row['AutCognom2'];
          $titol_antic = $row['titol'];
          $any = $row['any'];
          $nomEditorial = $row['nomEditorial'];
          $genere = $row['nomGenEng'];
          $nomIidioma = $row['language'];
          $idEditorial = $row['idEditorial'];
          $idGenere = $row['idGenere'];
          $nameImg = $row['nameImg'];
          $typeName = $row['typeName'];
          $alt = $row['alt'];
          $nomTipusEng = $row['nomTipusEng'];
          $dateCreated = date_create($row['dateCreated']);
          $dateCreated_net = date_format($dateCreated, 'd-m-Y');

          if (!empty($row['dateModified'])) {
            $dateModified = date_create($row['dateModified']);
            $dateModified_net = date_format($dateModified, 'd-m-Y');
          }

          $nomAutor11 = htmlspecialchars($nomAutor ?? '', ENT_QUOTES);
          $nomAutor12 = "\"".$nomAutor11."\"";
          $AutCognom11 = htmlspecialchars($AutCognom1 ?? '', ENT_QUOTES);
          $AutCognom12 = "\"".$AutCognom11."\"";

          $nomAutor22 = htmlspecialchars($nomAutor2 ?? '', ENT_QUOTES);
          $nomAutor23 = "\"".$nomAutor22."\"";
          $AutCognom22 = htmlspecialchars($AutCognom2 ?? '', ENT_QUOTES);
          $AutCognom23 = "\"".$AutCognom22."\"";
}
    // some action goes here under php
    echo "<div class='container'>";
       echo "<div class='row'>
             <div class='col-sm-8'>";
              if (!empty($nameImg)) {
                echo "<img src='".IMG_URL."".$typeName."/".$nameImg.".jpg' class='img-thumbnail img-fluid rounded mx-auto d-block' style='height:auto;width:auto;max-width:auto' alt='".$alt."' title='".$alt."'>";
              } else {
                echo "<img src='".IMG_DEFAULT."' class='img-thumbnail img-fluid rounded mx-auto d-block' style='height:auto;width:auto;max-width:auto' alt='Book Cover' title='Book cover'>";
              }          
       echo "</div>";
       echo '<div class="col-sm-4">';
       echo '<button type="button" onclick="btnUpdateBook('.$id.')" id="btnUpdateBook" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalUpdateBook">Update book</button>';
               echo' <div class="alert alert-primary" role="alert" style="margin-top:10px">';
                
                if (!empty($titolCat_antic)) {  
                  echo "<p><strong>Catalan title: </strong>".$titolCat_antic."</p>";
                }
                if (!empty($AutCognom2)) { 
                  echo "<p><strong>Authors: </strong>";
                  echo "<td><a href='#' title='show author info' data-bs-toggle='modal' data-bs-target='#modalViewAuthor' onclick='viewDetailAuthor(".$idAutor.", ".$nomAutor12.", ".$AutCognom12.");return false;'>".$nomAutor." ".$AutCognom1."</a></td></p>";
                  echo ' / ';
                  echo "<td><a href='#' title='show author info' data-bs-toggle='modal' data-bs-target='#modalViewAuthor' onclick='viewDetailAuthor(".$idAutor.", ".$nomAutor23.", ".$AutCognom23.");return false;'>".$nomAutor2." ".$AutCognom2."</a></td></p>";
                } else {
                  echo "<p><strong>Author: </strong>";
                  echo "<td><a href='#' title='show author info' data-bs-toggle='modal' data-bs-target='#modalViewAuthor' onclick='viewDetailAuthor(".$idAutor.", ".$nomAutor12.", ".$AutCognom12.");return false;'>".$nomAutor." ".$AutCognom1."</a></td></p>";
                }
                echo "<p><strong>Publication date: </strong>".$any."</p>";
                echo "<p><strong>Publisher:</strong> ".$nomEditorial."</p>";
                echo "<p><strong>Type: </strong>".$nomTipusEng."</p>";
                echo "<p><strong>Genre: </strong>".$genere."</p>";
                echo "<p><strong>Language: </strong>".$nomIidioma."</p>";
                echo "<p><strong>Created on: </strong> ".$dateCreated_net." ";
                
                if (!empty($dateModified)) { 
                  echo "<p><strong>Updated on: </strong> ".$dateModified_net." "; 
                } 
            echo "</div>
           </div>
      </div>";
      echo "</div>";

      echo "<hr>
      <h3>Book collection</h3>";
      echo "<p><button type='button' class='btn btn-dark btn-sm' id='btnAddCollection' onclick='addCollectionBook(".$id.")' data-bs-toggle='modal' data-bs-target='#modalCreateBookCollection'>Add new collection</button></p>";

      $stmt = $conn->prepare("SELECT bc.nomCollection, bookc.ordre
      FROM db_library_books AS book
      INNER JOIN db_library_books_collection AS bookc ON book.id = bookc.idBook
      INNER JOIN db_library_collection AS bc ON bookc.idCollection = bc.id
      WHERE book.id = :id");
      $stmt->execute(['id' => $id]); 
      $data = $stmt->fetchAll();
      if (!empty($data)) {
        // and somewhere later:
        echo '<div class="'.TABLE_DIV_CLASS.'">
        <table class="'.TABLE_CLASS.'" id="booksAuthor">
        <thead class="'.TABLE_THREAD.'">';     
        echo "<tr>";
        echo "<th>Collection &darr;</th>";
        echo "<th>Book order</th>";
        echo "<th>Actions</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($data as $row) {
          $nomCollection = $row['nomCollection'];
          $ordre = $row['ordre'];
          echo "<tr>";
          echo "<td>".$row['nomCollection']."</td>";
          echo "<td>".$row['ordre']."</td>";
          echo '<td>
          <button type="button" onclick="btnUpdateBook('.$id.')" id="btnUpdateBook" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalUpdateBook" data-id="'.$id.'">Update</button>
          <button type="button" onclick="btnUpdateBook('.$id.')" id="btnUpdateBook" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalUpdateBook" data-id="'.$id.'">Delete</button>
          </td>';
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

