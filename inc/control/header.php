<?php
$url_root = $_SERVER['DOCUMENT_ROOT'];
require_once($url_root . '/inc/variables.php');

session_start();
if(!isset($_SESSION['user'])):
	header('Location: '.APP_ROOT.' /login');
	exit();
endif;

require_once(APP_ROOT_CONNECTION . '/pass/connection.php');
require_once(APP_ROOT . '/inc/functions.php');
require_once(APP_ROOT . '/inc/header_html.php');
require_once(APP_ROOT . '/inc/header_nav.php');