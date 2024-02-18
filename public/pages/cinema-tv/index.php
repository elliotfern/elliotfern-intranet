<?php


echo '<div class="container p-3">';
echo '<h1>Cinema & television Database</h1>';

echo '<a href="'.APP_DEV.'/cinema/tvshows">TV Shows</a>';
echo '<br><a href="'.APP_DEV.'/cinema/movies">Movies</a>';
echo '<br><a href="'.APP_DEV.'/cinema/actors">Actors</a>';
echo '<br><a href="'.APP_DEV.'/cinema/directors">Directors</a>';

echo '</div>
</div>';

# footer
require_once(APP_ROOT . APP_DEV . '/public/php/footer.php');