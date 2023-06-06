<?php

$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
$web = '/public/control/login.php';

session_start();
if(!isset($_SESSION['user'])):
	header('Location: ' . $web);
	exit();
endif;

