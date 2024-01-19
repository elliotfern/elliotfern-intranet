<?php

echo '<div class="container">';
echo '<h1>Cinema & TV shows Database</h1>';
echo '<h2>Actors</h2>';

echo "<p><button type='button' class='btn btn-dark btn-sm' id='btnAddActor' onclick='btnFAddActor()' data-bs-toggle='modal' data-bs-target='#modalCreateActor'>Create new Actor</button></p>";

echo "<hr>";

    echo '<div class="'.TABLE_DIV_CLASS.'">';
    echo '<table class="table table-striped datatable" id="actorsTable">
        <thead class="'.TABLE_THREAD.'">
        <tr>
            <th>Name</th>
            <th>Years</th>
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
require_once(APP_ROOT . APP_DEV . '/public/php/footer.php');