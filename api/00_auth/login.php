<?php
// api/login.php

use Controllers\AuthController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $authController = new AuthController();
        $authController->login();

}
