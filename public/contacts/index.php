<?php

# conectare la base de datos
$activePage = "contacts";

echo '<div class="container">';
echo '<h2>Contacts</h2>';

?>
<div class="container text-center" style="background-color:black;padding:25px;margin-top:25px;margin-bottom:50px;">
    <div class="row">
        <div class="col">
        <a href="<?php APP_SERVER;?>/contacts/personal"><img src="<?php APP_SERVER;?>/inc/img/link.png" alt="Contacts" width="54" height="54" style="filter: invert(1);padding:5px">
            <h4>01. Personal contacts</h4></a>
        </div>

        <div class="col">
            <a href="<?php APP_SERVER;?>/contacts/customers"><img src="<?php APP_SERVER;?>/inc/img/link.png" alt="Contacts" width="54" height="54" style="filter: invert(1);padding:5px">
            <h4>02. Customers contacts</h4></a>
        </div>

        <div class="col">
            <a href="<?php APP_SERVER;?>/contacts/others"><img src="<?php APP_SERVER;?>/inc/img/link.png" alt="Contacts" width="54" height="54" style="filter: invert(1);padding:5px">
            <h4>03. Other contacts</h4></a>
        </div>
    </div>

    </div>


    <?php
echo '</div>';
// include_once('modals-accounting.php');

# footer
include_once(APP_ROOT . '/inc/footer.php');