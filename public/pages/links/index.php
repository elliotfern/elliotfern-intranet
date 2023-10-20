<?php

echo '<div class="container">';
echo '<h1>Links</h1>';

?>
<div class="container text-center" style="background-color:black;padding:25px;margin-top:25px;margin-bottom:50px;">
    <div class="row">
        <div class="col">
        <a href="<?php echo APP_DEV;?>/links/categories"><img src="<?php APP_DEV;?>/inc/img/link.png" alt="Contacts" width="54" height="54" style="filter: invert(1);padding:5px">
            <h4>01. Links categories</h4></a>
        </div>

        <div class="col">
            <a href="<?php echo APP_DEV;?>/links/topics"><img src="<?php APP_DEV;?>/inc/img/link.png" alt="Contacts" width="54" height="54" style="filter: invert(1);padding:5px">
            <h4>02. Links topics</h4></a>
        </div>
    </div>


    <div class="row" style="margin-top:100px">
    <hr>
        <h3 style="margin-bottom:25px">Programming</h3>
        <div class="col">
            <a href="<?php echo APP_DEV;?>/programming/links"><img src="<?php APP_DEV;?>/inc/img/link.png" alt="Contacts" width="54" height="54" style="filter: invert(1);padding:5px">
            <h4>01. Programming links</h4></a>
        </div>

        <div class="col">
            <a href="<?php echo APP_DEV;?>/inks/topic/42"><img src="<?php APP_DEV;?>/inc/img/link.png" alt="Contacts" width="54" height="54" style="filter: invert(1);padding:5px">
            <h4>01. Programming links</h4></a>
        </div>

    </div>

    <div class="row" style="margin-top:100px">
    <hr>
    <h3 style="margin-bottom:25px">Direct links: media</h3>
        <div class="col">
            <a href="<?php echo APP_DEV;?>/links/topic/88"><img src="<?php APP_DEV;?>/inc/img/link.png" alt="Contacts" width="54" height="54" style="filter: invert(1);padding:5px">
            <h4>Economics media</h4></a>
        </div>
        <div class="col">
        <a href="<?php echo APP_DEV;?>/links/topic/64"><img src="<?php echo APP_DEV;?>/inc/img/link.png" alt="Contacts" width="54" height="54" style="filter: invert(1);padding:5px">
            <h4>Progressive media</h4></a>
        </div>
        <div class="col">
            <a href="<?php echo APP_DEV;?>/links/topic/19"><img src="<?php echo APP_DEV;?>/inc/img/link.png" alt="Contacts" width="54" height="54" style="filter: invert(1);padding:5px">
            <h4>Catalonia media</h4></a>
        </div>
    </div>

    <div class="row" style="margin-top:100px">
        <div class="col">
            <a href="<?php echo APP_DEV;?>/links/topic/57"><img src="<?php echo APP_DEV;?>/inc/img/link.png" alt="Contacts" width="54" height="54" style="filter: invert(1);padding:5px">
            <h4>Technology media</h4></a>
        </div>
        <div class="col">
        <a href="<?php echo APP_DEV;?>/links/topic/9"><img src="<?php echo APP_DEV;?>/inc/img/link.png" alt="Contacts" width="54" height="54" style="filter: invert(1);padding:5px">
            <h4>Public radio</h4></a>
        </div>
        <div class="col">
            <a href="<?php echo APP_DEV;?>/links/topic/21"><img src="<?php echo APP_DEV;?>/inc/img/link.png" alt="Contacts" width="54" height="54" style="filter: invert(1);padding:5px">
            <h4>Spain media</h4></a>
        </div>
    </div>

    <div class="row" style="margin-top:100px">
        <div class="col">
            <a href="<?php echo APP_DEV;?>/links/topic/47"><img src="<?php echo APP_DEV;?>/inc/img/link.png" alt="Contacts" width="54" height="54" style="filter: invert(1);padding:5px">
            <h4>Ireland media</h4></a>
        </div>
        <div class="col">
        <a href="<?php echo APP_DEV;?>/links/topic/13"><img src="<?php echo APP_DEV;?>/inc/img/link.png" alt="Contacts" width="54" height="54" style="filter: invert(1);padding:5px">
            <h4>United States media</h4></a>
        </div>
        <div class="col">
            <a href="<?php echo APP_DEV;?>/links/topic/20"><img src="<?php echo APP_DEV;?>/inc/img/link.png" alt="Contacts" width="54" height="54" style="filter: invert(1);padding:5px">
            <h4>Italy media</h4></a>
        </div>
    </div>
    
    </div>
</div>

<?php

# footer
require_once(APP_ROOT . APP_DEV . '/public/php/footer.php');