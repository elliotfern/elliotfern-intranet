<?php

// Combinar todas las rutas en un solo arreglo
$routes = array_merge(
    require APP_ROOT . '/Routes/auth.php',
    require APP_ROOT . '/Routes/api.php',
    require APP_ROOT . '/Routes/web.php',
    require APP_ROOT . '/Routes/vault.php'
);

return $routes;