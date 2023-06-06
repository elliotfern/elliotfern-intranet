<?php

# conectare la base de datos
$activePage = "users";


echo '<div class="container">';
?>

<div class="container text-center" style="background-color:black;padding:25px;margin-top:25px;margin-bottom:50px;">
    <h3 style="margin-bottom:25px">Users</h3>
    <div class="row">
        <div class="col">
            <a href="<?php echo APP_SERVER;?>/users/"><img src="<?php echo APP_SERVER;?>/inc/img/accounting.png" alt="Accounting" width="64" height="64" style="filter: invert(1);">
            <h4>New user</h4></a>
        </div>

        <div class="col">
        <a href="<?php echo APP_SERVER;?>/users/list"><img src="<?php echo APP_SERVER;?>/inc/img/tasks.png" alt="Projects" width="64" height="64" style="filter: invert(1);">
            <h4>Edit user</h4></a>
        </div>

    </div>



    </div>

</div>

<?php
# footer
require_once(APP_ROOT . '/inc/footer.php');
