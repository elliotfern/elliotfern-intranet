<?php
// api/register.php
use App\Controllers\AuthController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $authController = new AuthController();
    $authController->register();
}
