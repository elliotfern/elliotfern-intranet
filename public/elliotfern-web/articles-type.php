<?php

# conectare la base de datos
$activePage = "elliotfern";
include_once('../inc/header.php');


echo '<div class="container">';
echo '<h1>Elliotfern.com Database</h1>';
echo '<h2>Articles languages and type</h2>';

echo "<p><button type='button' class='btn btn-dark btn-sm' id='btnAddNewCostumer' onclick='btnCreateArticle()' data-bs-toggle='modal' data-bs-target='#modalCreateArticleWp'>Add new Article</button></p>";

echo "<hr>";

echo "<h5>Type code</h5>
<ul>
<li>1 - Elliotfern blog</li>
<li>2 - History article</li>
<li>3 - History course page</li>
<li>4 - History timeline</li>
<li>5 - History homepage</li>
<li>6 - History event</li>
<li>7 - History city</li>
</ul>";

echo "<p></p>";

    echo '<div class="'.TABLE_DIV_CLASS.'">';
    echo '<table class="table table-striped datatable" id="articlesTable">
        <thead class="'.TABLE_THREAD.'">
        <tr>
            <th>ID Wp</th>
            <th>Article</th>
            <th>Language</th>
            <th>Type</th>
            <th></th>
            <th></th>
    </tr>
    </thead>
    <tbody>
    <tr>
       
    </tr>
 </tbody>
    </table>
    </div>

    </div>
</div>';

include_once('modals-elliotfern.php');

# footer
include_once('../inc/footer.php');