<?php
# conectare la base de datos
$activePage = "programming";


echo '<div class="container">';
echo '<h1>Programming resources</h1>';

?>
<div class="container text-center" style="background-color:black;padding:25px;margin-top:25px;margin-bottom:50px;">
<h3 style="margin-bottom:25px">Learning</h3>
    <div class="row">
    <div class="col">
        <a href="<?php echo APP_SERVER;?>/programming/links/110"><img src="<?php echo APP_SERVER;?>/inc/img/tasks.png" alt="Projects" width="64" height="64" style="filter: invert(1);">
            <h4>Code academy / tutorials</h4></a>
        </div>

        <div class="col">
        <a href="<?php APP_SERVER;?>/programming/daw"><img src="<?php APP_SERVER;?>/inc/img/link.png" alt="Contacts" width="54" height="54" style="filter: invert(1);padding:5px">
            <h4>Curriculum DAW</h4></a>
    </div>
    </div>
</div>

<div class="container text-center" style="background-color:black;padding:25px;margin-top:25px;margin-bottom:50px;">
    <h3 style="margin-bottom:25px">Programming languages</h3>
    <div class="row">
        <div class="col">
            <a href="<?php echo APP_SERVER;?>/programming/links/112"><img src="<?php echo APP_SERVER;?>/inc/img/accounting.png" alt="Accounting" width="64" height="64" style="filter: invert(1);">
            <h4>Angular</h4></a>
        </div>

        <div class="col">
        <a href="<?php echo APP_SERVER;?>/programming/links/61"><img src="<?php echo APP_SERVER;?>/inc/img/tasks.png" alt="Projects" width="64" height="64" style="filter: invert(1);">
            <h4>React</h4></a>
        </div>

        <div class="col">
        <a href="<?php echo APP_SERVER;?>/programming/links/41"><img src="<?php echo APP_SERVER;?>/inc/img/tasks.png" alt="Projects" width="64" height="64" style="filter: invert(1);">
            <h4>Ajax</h4></a>
        </div>
     </div>

     <div class="row" style="margin-top:35px">
        <div class="col">
            <a href="<?php echo APP_SERVER;?>/programming/links/7"><img src="<?php echo APP_SERVER;?>/inc/img/accounting.png" alt="Accounting" width="64" height="64" style="filter: invert(1);">
            <h4>PHP</h4></a>
        </div>

        <div class="col">
            <a href="<?php APP_SERVER;?>/programming/links"><img src="<?php APP_SERVER;?>/inc/img/link.png" alt="Contacts" width="54" height="54" style="filter: invert(1);padding:5px">
            <h4>Other links</h4></a>
        </div>
    </div>
    </div>

    <div class="container text-center" style="background-color:black;padding:25px;margin-top:25px;margin-bottom:50px;">
    <h3 style="margin-bottom:25px">Tech Jobs</h3>
    <div class="row">
        <div class="col">
            <a href="<?php echo APP_SERVER;?>/programming/links/120"><img src="<?php echo APP_SERVER;?>/inc/img/accounting.png" alt="Accounting" width="64" height="64" style="filter: invert(1);">
            <h4>Jobs search</h4></a>
        </div>
    </div>
</div>

<?php

echo '</div>';

# footer
include_once(APP_ROOT. '/inc/footer.php');