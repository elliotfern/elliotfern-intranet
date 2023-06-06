
<div class="container-fluid text-center" style="padding-bottom:50px">

<hr>

<h5>2023 - HispanTIC</h5>
</div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

<link href="<?php echo APP_SERVER;?>/inc/control/css/style.css" rel="stylesheet">

<?php 
  
  if ($activePage == "library") {
  ?>
    <script src="<?php APP_SERVER;?>/inc/control/js/library/library.js"></script>
  <?php
  } elseif ($activePage == "accounting-hispantic"){
    ?>
    <script src="<?php APP_SERVER;?>/inc/control/js/accounting-hispantic/accounting.js"></script>
  <?php 
   } elseif ($activePage == "accounting"){
    ?>
    <script src="<?php APP_SERVER;?>/inc/control/js/accounting/accounting-elliotfernandez.js"></script>
  <?php 
  } elseif ($activePage == "vault"){
    ?>
    <script src="<?php APP_SERVER;?>/inc/control/js/vault/vault.js"></script>
  <?php 
   } elseif ($activePage == "links"){
    ?>
    <script src="<?php echo APP_SERVER;?>/inc/control/js/links/links.js"></script>
  <?php 
  } elseif ($activePage == "cinema") {
    ?>
    <script src="<?php APP_SERVER;?>/inc/control/js/cinema/cinema.js"></script>
  <?php 
  } elseif ($activePage == "openhistory") {
    ?>
    <script src="<?php APP_SERVER;?>/inc/control/js/history-web/history.js"></script>
  <?php   
  } elseif ($activePage == "elliotfern") {
    ?>
    <script src="<?php APP_SERVER;?>/inc/control/js/elliotfern-web/elliotfern.js"></script>
  <?php
  } elseif ($activePage == "users") {
    ?>
    <script src="<?php APP_SERVER;?>/inc/control/js/users/users.js"></script>
  <?php   
  } else {
    
  }
  ?>
</body>
</html>