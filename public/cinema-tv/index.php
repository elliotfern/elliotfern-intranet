<?php

# conectare la base de datos
$activePage = "cinema";
include_once('../inc/header.php');


echo '<div class="container">';
echo '<h1>Cinema & television Database</h1>';

echo '<a href="tvshows.php">TV Shows</a>';
echo '<br><a href="movies.php">Movies</a>';
echo '<br><a href="actors.php">Actors</a>';
echo '<br><a href="directors.php">Directors</a>';

echo '</div>
</div>';

# footer
include_once('../inc/footer.php');