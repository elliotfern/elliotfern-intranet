<?php

# conectare la base de datos
$activePage = "links";
global $conn;
?>

<div class="container">
<h2><a href="<?php APP_SERVER;?>/links">Links</a> > All links</h2>

<p><button type='button' class='btn btn-warning btn-sm' id='btnCreateLink' onclick='btnCreateLink()' data-bs-toggle='modal' data-bs-target='#modalCreateLink'>Add link &rarr;</button>

<?php
$data = array();
$stmt = $conn->prepare("SELECT l.id, l.nom, l.web AS url, book_genre.genre, book_genre.id AS idGenere, topic.id AS idTema, topic.topic, l.lang, t.type
FROM db_links AS l
INNER JOIN db_topics AS topic ON l.cat = topic.id
INNER JOIN db_library_genres AS book_genre ON topic.idGenere = book_genre.id
LEFT JOIN db_links_type AS t ON l.tipus = t.id
ORDER BY l.nom");
$stmt->execute();
    if ($stmt->rowCount() === 0) {
        echo 'No rows';
    } else {
        ?>
        <div class="table-responsive">
            <table class="table table-striped" id="suppliesInvoices">
                <thead class="table-primary">
                <tr>
                <th>Link &darr;</th>
                <th>Category</th>
                <th>Topic</th>
                <th>Language</th>
                <th>Type</th>
                <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $data = $stmt->fetchAll();
                    foreach ($data as $row) {
                        $idLink = $row['id'];
                        $LinkWeb = $row['url'];
                        $genere = $row['genre'];
                        $idGenere = $row['idGenere'];
                        $LinkNom = $row['nom'];
                        $idTema = $row['idTema'];
                        $topic = $row['topic'];
                        $lang = $row['lang'];
                        $type = $row['type'];

                        echo '<tr>';
                        echo "<td><a href='".$LinkWeb."' target='_blank'>".$LinkNom."</a></td>";
                        echo '<td><a href="idGenere='.$idGenere.'">'.$genere.'</a></td>';
                        echo '<td><a href="&idTema='.$idTema.'">'.$topic.'</a></td>';
                        echo "<td>";
                        if ($lang == 1) { // english
                        echo "English";
                        } elseif ( $lang == 2) { // catalan
                          echo "Catalan";
                        } elseif ( $lang == 3) { //spanish
                          echo "Spanish";
                        } elseif ( $lang == 4) { //italian
                          echo "Italian";
                        } elseif ( $lang == 0) { //none
                          echo "None";
                        }
                        echo "</td>";
                        echo '<td>'.$type.'</td>';
                        echo "<td>
                          <a href='&LinkId=".$idLink."' class='btn btn-warning btn-sm' role='button' aria-pressed='true'></a>
                          <a href='&LinkId=".$idLink."' class='btn btn-danger btn-sm' role='button' aria-pressed='true'></a>
                        </td>";          
                        echo '</tr>';
                    }
                    echo '</tbody>';                            
                    echo '</table>';
                    echo '</div>';
    }

echo '</div>';

include_once('modals-links.php');

# footer
include_once(APP_ROOT . '/inc/footer.php');