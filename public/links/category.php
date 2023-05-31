<?php

# conectare la base de datos
$activePage = "links";
global $conn;

if (isset($_GET['id']) ) {
    $id = $_GET['id'];
}

$id = $params['id'];

$stmt = $conn->prepare("SELECT g.genre
FROM db_library_genres AS g
WHERE g.id=?");
$stmt->execute([$id]); 
$result = $stmt->fetch();
    $nomCategoria = $result["genre"];
?>

<div class="container">
<h2><a href="<?php echo APP_SERVER;?>/links/">Links</a> > <a href="<?php echo APP_SERVER;?>/links/categories">Categories </a> > Category: <?php echo $nomCategoria; ?></h2>

<p><button type='button' class='btn btn-warning btn-sm' id='btnCreateLink' onclick='btnCreateLink()' data-bs-toggle='modal' data-bs-target='#modalCreateLink'>Add link &rarr;</button>

<?php
$data = array();
$stmt = $conn->prepare("SELECT t.id AS idTema, t.topic AS tema
FROM db_topics AS t
INNER JOIN db_library_genres AS g ON t.idGenere = g.id
INNER JOIN db_links AS l ON l.cat = t.id
WHERE t.idGenere=?
GROUP BY t.id
ORDER BY t.topic ASC");
$stmt->execute([$id]);
    if ($stmt->rowCount() === 0) {
        echo 'No rows';
    } else {
        ?>
        <div class="table-responsive">
            <table class="table table-striped" id="suppliesInvoices">
                <thead class="table-primary">
                <tr>
                <th>Topic</th>
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
                        echo '<tr>';
                        echo '<td><a href="'.APP_SERVER.'/links/topic/'.$idTema.'">'.$topic.'</a></td>';
                        echo "<td><a href='&LinkId=".$idTema."' class='btn btn-warning btn-sm' role='button' aria-pressed='true'>Update</a></td>
                        <td><a href='&LinkId=".$idTema."' class='btn btn-danger btn-sm' role='button' aria-pressed='true'>Delete</a></td>";
                        echo '</tr>';
                    }
                    echo '</tbody>';                            
                    echo '</table>';
                    echo '</div>';
    }

echo '</div>';

include_once('modals-links.php');

# footer
require_once(APP_ROOT . '/inc/footer.php');