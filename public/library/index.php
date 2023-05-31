<?php
# conectare la base de datos
$activePage = "library";


echo '<div class="container">';
echo '<h1>Library Database</h1>';

echo '<a href="'.APP_SERVER.'/library/books">Books</a>';
echo '<br><a href="'.APP_SERVER.'/library/authors">Authors</a>';

echo '</div>
</div>';

# footer
include_once(APP_ROOT . '/inc/footer.php');