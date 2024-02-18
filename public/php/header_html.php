<?php
$favicon = APP_DEV . "/public/img/icon.png";
?>

<!DOCTYPE html>
<html class="no-js" lang="ca">
<head>
<meta charset="">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="profile" href="https://gmpg.org/xfn/11">
<meta name="robots" content="index, follow, noodp, noydir">
<meta name="yandex-verification" content="23d54f548c9bde46" />
<meta name="locality" content="Dublin, Ireland" />
<meta name="distribution" content="global" />

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="shortcut icon" href="<?php echo $favicon; ?>">
<title>Elliot Fernandez</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<link href="<?php echo  APP_DEV ;?>/public/css/style.css" rel="stylesheet">

<script src="<?php echo APP_DEV;?>/public/js/globals.js"></script>
<script src="<?php echo APP_DEV;?>/public/js/links/links.js"></script>
<script src="<?php echo APP_DEV;?>/public/js/links/links-functions.js"></script>
<script src="<?php echo APP_DEV ;?>/public/js/library/library.js"></script>
<script src="<?php echo APP_DEV;?>/public/js/accounting/accounting-elliotfernandez.js"></script>
<script src="<?php echo APP_DEV;?>/public/js/cinema/cinema.js"></script>
<script src="<?php echo APP_DEV;?>/public/js/vault/vault.js"></script>

</head>
<body>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-2 sticky-md-top fixe" style="background-color:#212529;">
    <?php require_once(APP_ROOT . '/public/php/sidebar.php'); ?>
    </div>

    <div class="col-sm-10">
        <div class="container-fluid p-3">
   
<style>

@media (min-width: 500px) {
  .fixe {
    height: 100vh;
  }
}

  </style>