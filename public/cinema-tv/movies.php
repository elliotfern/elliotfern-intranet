<?php

echo '<div class="container">';
echo '<h1>Cinema & TV shows Database</h1>';
echo '<h2>Movies</h2>';

echo "<p><button type='button' class='btn btn-dark btn-sm' id='btnAddBook' onclick='btnCreateBook()' data-bs-toggle='modal' data-bs-target='#modalCreateBook'>".LIBRARY_BOOKS_ADD."</button>
        <button type='button' class='btn btn-dark btn-sm' id='btnAddAuthor2' onclick='btnCreateAuthor()' data-bs-toggle='modal' data-bs-target='#modalCreateAuthor'>".LIBRARY_AUTHORS_ADD."</button></p>
        
        <p><button type='button' class='btn btn-secondary btn-sm' id='btnAddBook' onclick='btnCreateBook()' data-bs-toggle='modal' data-bs-target='#modalCreateBook'>".LIBRARY_PUBLISHER_ADD."</button>
        <button type='button' class='btn btn-secondary btn-sm' id='btnAddBook' onclick='btnCreateBook()' data-bs-toggle='modal' data-bs-target='#modalCreateBook'>".LIBRARY_GENRE_ADD."</button>
        <button type='button' class='btn btn-secondary btn-sm' id='btnAddBook' onclick='btnCreateBook()' data-bs-toggle='modal' data-bs-target='#modalCreateBook'>".LIBRARY_TOPIC_ADD."</button></p>";

echo "<hr>";

    echo '<div class="'.TABLE_DIV_CLASS.'">';
    echo '<table class="table table-striped datatable" id="moviesTable">
        <thead class="'.TABLE_THREAD.'">
        <tr>
            <th>Film</th>
            <th>Year</th>
            <th>Director</th>
            <th>Country</th>
            <th></th>
            <th></th>
    </tr>
    </thead>
    
    
    </table>
    </div>

    </div>
</div>';

//include_once('modals-library.php');


# footer
require_once(APP_ROOT . APP_DEV . '/public/php/footer.php');