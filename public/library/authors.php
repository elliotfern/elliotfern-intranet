<?php

# conectare la base de datos
$activePage = "library";

echo '<div class="container">';
echo '<h1>Database</h1>';
echo '<h2>Authors</h2>';

echo "<p><button type='button' class='btn btn-dark btn-sm' id='btnAddBook' onclick='btnCreateBook()' data-bs-toggle='modal' data-bs-target='#modalCreateBook'>".LIBRARY_BOOKS_ADD."</button>
        <button type='button' class='btn btn-dark btn-sm' id='btnAddAuthor2' onclick='btnCreateAuthor()' data-bs-toggle='modal' data-bs-target='#modalCreateAuthor'>".LIBRARY_AUTHORS_ADD."</button></p>
        
        <p><button type='button' class='btn btn-secondary btn-sm' id='btnAddBook' onclick='btnCreateBook()' data-bs-toggle='modal' data-bs-target='#modalCreateBook'>".LIBRARY_PUBLISHER_ADD."</button>
        <button type='button' class='btn btn-secondary btn-sm' id='btnAddBook' onclick='btnCreateBook()' data-bs-toggle='modal' data-bs-target='#modalCreateBook'>".LIBRARY_GENRE_ADD."</button>
        <button type='button' class='btn btn-secondary btn-sm' id='btnAddBook' onclick='btnCreateBook()' data-bs-toggle='modal' data-bs-target='#modalCreateBook'>".LIBRARY_TOPIC_ADD."</button></p>";

echo "<hr>";
echo "<p><a href='".BIBLIOTECA_LLISTAT_EDITORIALS."' class='btn btn-info btn-sm' role='button' aria-pressed='true'>".LIBRARY_PUBLISHER_LIST."</a>
    <a href='".BIBLIOTECA_LLISTAT_GENERES."' class='btn btn-info btn-sm' role='button' aria-pressed='true'>".LIBRARY_GENRE_LIST."</a>
    <a href='".BIBLIOTECA_LLISTAT_TEMES."' class='btn btn-info btn-sm' role='button' aria-pressed='true'>".LIBRARY_TOPIC_LIST."</a>
    <a href='".BIBLIOTECA_LLISTAT_LLIBRES_SENSE_TEMA."' class='btn btn-info btn-sm' role='button' aria-pressed='true'>".LIBRARY_BOOKS_WITHOUT_TOPIC."</a>
    <a href='books.php' class='btn btn-primary btn-sm' role='button' aria-pressed='true'>Books</a></p>";


    echo '<div class="'.TABLE_DIV_CLASS.'">';
    echo '<table class="table table-striped datatable" id="authorsTable">
        <thead class="'.TABLE_THREAD.'">
        <tr>
            <th>Author</th>
            <th>Country</th>
            <th>Profession</th>
            <th>Years</th>
            <th></th>
            <th></th>
    </tr>
    </thead>

    </table>
    </div>

    </div>
</div>';

include_once('modals-library.php');

# footer
include_once(APP_ROOT . '/inc/footer.php');