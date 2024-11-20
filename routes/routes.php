<?php

// Combinar todas las rutas en un solo arreglo
$routes = array_merge(
    require APP_ROOT . '/routes/auth.php',
    require APP_ROOT . '/routes/api.php',
    require APP_ROOT . '/routes/web.php'
);

return $routes;