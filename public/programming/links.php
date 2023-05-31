<?php

# conectare la base de datos
$activePage = "programming";
global $conn;

echo '<div class="container">';
echo '<h1>Programming resources</h1>';
echo '<h3>Links</h3>';

$stmt = $conn->prepare("SELECT t.id, t.topic 
FROM db_topics AS t
INNER JOIN db_links AS l ON t.id = l.cat
WHERE t.idGenere=18
GROUP BY t.id
ORDER BY t.topic ASC");
$stmt->execute(); 
$data = $stmt->fetchAll();
    foreach ($data as $row) {
        echo "<a href='".APP_SERVER."/programming/links/".$row['id']."' class='btn btn-info' role='button' aria-pressed='true' style='margin:15px'>".$row['topic']." &rarr;</a>";
        }


echo '</div>
</div>';

# footer
include_once(APP_ROOT. '/inc/footer.php');