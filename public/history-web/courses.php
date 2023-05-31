<?php

# conectare la base de datos
$activePage = "openhistory";
include_once('../inc/header.php');


echo '<div class="container">';
echo '<h1>Open History Database</h1>';
echo '<h2>Courses</h2>';

echo "<p><button type='button' class='btn btn-dark btn-sm' id='btnAddBook' onclick='btnCreateBook()' data-bs-toggle='modal' data-bs-target='#modalCreateBook'>".LIBRARY_BOOKS_ADD."</button>
        <button type='button' class='btn btn-dark btn-sm' id='btnAddAuthor2' onclick='btnCreateAuthor()' data-bs-toggle='modal' data-bs-target='#modalCreateAuthor'>".LIBRARY_AUTHORS_ADD."</button></p>
        
        <p><button type='button' class='btn btn-secondary btn-sm' id='btnAddBook' onclick='btnCreateBook()' data-bs-toggle='modal' data-bs-target='#modalCreateBook'>".LIBRARY_PUBLISHER_ADD."</button>
        <button type='button' class='btn btn-secondary btn-sm' id='btnAddBook' onclick='btnCreateBook()' data-bs-toggle='modal' data-bs-target='#modalCreateBook'>".LIBRARY_GENRE_ADD."</button>
        <button type='button' class='btn btn-secondary btn-sm' id='btnAddBook' onclick='btnCreateBook()' data-bs-toggle='modal' data-bs-target='#modalCreateBook'>".LIBRARY_TOPIC_ADD."</button></p>";

    echo '<div class="'.TABLE_DIV_CLASS.'">';
    echo '<table class="table table-striped datatable" id="courseTable">
        <thead class="'.TABLE_THREAD.'">
        <tr>
            <th>Course</th>
            <th>Order</th>
            <th>Description</th>
            <th>Web</th>
            <th></th>
            <th></th>
    </tr>
    </thead>

    </table>
    </div>

    </div>
</div>';

include_once('modals-history.php');

# footer
include_once('../inc/footer.php');