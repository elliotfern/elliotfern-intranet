<?php
echo '<div class="container">';
?>

<div class="container text-center" style="background-color:black;padding:25px;margin-top:25px;margin-bottom:50px;">
    <h3 style="margin-bottom:25px">Work tools</h3>
    <div class="row">
        <div class="col">
            <a href="<?php echo APP_SERVER;?>/control/accounting/"><img src="<?php echo APP_SERVER;?>/inc/control/img/accounting.png" alt="Accounting" width="64" height="64" style="filter: invert(1);">
            <h4>01. Accounting</h4></a>
        </div>

        <div class="col">
        <a href="<?php echo APP_SERVER;?>/control/accounting-soletrade/banks"><img src="<?php echo APP_SERVER;?>/inc/control/img/tasks.png" alt="Projects" width="64" height="64" style="filter: invert(1);">
            <h4>02. Payments & Banks</h4></a>
        </div>


        <div class="col">
        <a href="<?php echo APP_SERVER;?>/control/projects"><img src="<?php echo APP_SERVER;?>/inc/control/img/tasks.png" alt="Projects" width="64" height="64" style="filter: invert(1);">
            <h4>03. Projects - to do</h4></a>
        </div>
    </div>

    <div class="row" style="margin-top:100px">

        <div class="col">
            <a href="<?php echo APP_SERVER;?>/control/links"><img src="<?php echo APP_SERVER;?>/inc/control/img/bookmark.png" alt="Links" width="64" height="64" style="filter: invert(1);">
            <h4>04. Links</h4></a>
        </div>


        <div class="col">
            <a href="<?php echo APP_SERVER;?>/control/programming"><img src="<?php echo APP_SERVER;?>/inc/control/img/accounting.png" alt="Programming" width="64" height="64" style="filter: invert(1);">
            <h4>05. Programming library</h4></a>
        </div>
        <div class="col">
        <a href="<?php echo APP_SERVER;?>/control/vault"><img src="<?php echo APP_SERVER;?>/inc/control/img/tasks.png" alt="Vault" width="64" height="64" style="filter: invert(1);">
            <h4>06. Vault</h4></a>
        </div>

    </div>
    
    <div class="row" style="margin-top:100px">
        <div class="col">
            <a href="<?php echo APP_SERVER;?>/control/contacts"><img src="<?php echo APP_SERVER;?>/inc/control/img/bookmark.png" alt="Contacts" width="64" height="64" style="filter: invert(1);">
            <h4>07. Contacts</h4></a>
        </div>

        <div class="col">
            <a href="<?php echo APP_SERVER;?>/control/jobs"><img src="<?php echo APP_SERVER;?>/inc/control/img/job.png" alt="Contacts" width="64" height="64" style="filter: invert(1);">
            <h4>08. Jobs</h4></a>
        </div>

    </div>

    <div class="container text-center" style="background-color:black;padding:25px;margin-top:25px;margin-bottom:50px;">
    <h3 style="margin-bottom:25px">Intranet tools</h3>
    <div class="row">
        <div class="col">
            <a href="<?php echo APP_SERVER;?>/control/users/"><img src="<?php echo APP_SERVER;?>/inc/control/img/accounting.png" alt="Accounting" width="64" height="64" style="filter: invert(1);">
            <h4>01. Users</h4></a>
        </div>
    </div>
    </div>

</div>

<?php
# footer
require_once(APP_ROOT . '/inc/control/footer.php');
