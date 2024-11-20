<?php
// api/register.php
 use Controllers\AuthController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $authController = new AuthController();
    $authController->register();
    
}