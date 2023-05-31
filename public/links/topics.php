<?php

# conectare la base de datos
$activePage = "links";
require_once(APP_ROOT . '/inc/header.php');
global $conn;
?>

<div class="container">
<h2><a href="<?php echo APP_SERVER;?>/links">Links</a> > <a href="<?php echo APP_SERVER;?>/links/topics">Topics </a></h2>

<p><button type='button' class='btn btn-warning btn-sm' id='btnCreateLink' onclick='btnCreateLink()' data-bs-toggle='modal' data-bs-target='#modalCreateLink'>Add link &rarr;</button>

<?php
$data = array();
$stmt = $conn->prepare("SELECT t.id AS idTema, t.topic AS tema, g.genre, g.id AS idGenre
FROM db_topics AS t
INNER JOIN db_library_genres AS g ON t.idGenere = g.id
INNER JOIN db_links AS l ON l.cat = t.id
GROUP BY t.id
ORDER BY t.topic ASC");
$stmt->execute();
    if ($stmt->rowCount() === 0) {
        echo 'No rows';
    } else {
        ?>
        <div class="table-responsive">
            <table class="table table-striped" id="suppliesInvoices">
                <thead class="table-primary">
                <tr>
                <th>Topic &darr;</th>
                <th>Categoria</th>
                <th></th>
                <th></th> 
                </tr>
                </thead>
                <tbody>
                <?php
                $data = $stmt->fetchAll();
                    foreach ($data as $row) {
                        $idTema = $row['idTema'];
                        $topic = $row['tema'];
                        $idGenre = $row['idGenre'];
                        $genre = $row['genre'];
        
                        echo '<tr>';
                        echo '<td><a href="'.APP_SERVER.'/links/topic/'.$idTema.'">'.$topic.'</a></td>';
                        echo '<td><a href="'.APP_SERVER.'/links/categoria/'.$idGenre.'">'.$genre.'</a></td>';
                        echo "<td><a href='&id=".$idTema."' class='btn btn-warning btn-sm' role='button' aria-pressed='true'>Update</a></td>
                        <td><a href='&id=".$idTema."' class='btn btn-danger btn-sm' role='button' aria-pressed='true'>Delete</a></td>";
                    }
                    echo '</tbody>';                            
                    echo '</table>';
                    echo '</div>';
    }

echo '</div>';

include_once('modals-links.php');

# footer
require_once(APP_ROOT . '/inc/footer.php');