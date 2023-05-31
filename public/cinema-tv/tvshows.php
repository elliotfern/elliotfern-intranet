<?php

# conectare la base de datos
$activePage = "cinema";
include_once('../inc/header.php');


echo '<div class="container">';
echo '<h1>Cinema & TV shows Database</h1>';
echo '<h2>TV shows</h2>';

echo "<p><button type='button' class='btn btn-dark btn-sm' id='btnAddtvshow' onclick='btnFAddTVShow()' data-bs-toggle='modal' data-bs-target='#modalCreateTVShow'>Create tv show</button></p>";

echo "<hr>";

    echo '<div class="'.TABLE_DIV_CLASS.'">';
    echo '<table class="table table-striped datatable" id="tvshowTable">
        <thead class="'.TABLE_THREAD.'">
        <tr>
            <th>Name</th>
            <th>Years</th>
            <th>Producer</th>
            <th>Country</th>
            <th></th>
            <th></th>
    </tr>
    </thead>
    </table>
    </div>

    </div>
</div>';

include_once('modals-cinema.php');

# footer
include_once('../inc/footer.php');