<?php

// Al principio de tu archivo public/index.php, asegúrate de que Slim muestre los errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../vendor/autoload.php';

// Incluir configuraciones y rutas
require_once __DIR__ . '/../app/Config/constants.php';
require_once __DIR__ . '/../app/Config/config.php';
require_once __DIR__ . '/../app/Config/funcions.php';
require_once __DIR__ . '/../app/Routes/routes.php';

// Normalizar la ruta solicitada
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Quitar barras finales y manejar la raíz
$requestUri = rtrim($requestUri, '/');
if ($requestUri === '') {
    $requestUri = '/';
}

// Buscar la ruta en el arreglo
$routeFound = false;
foreach ($routes as $route => $routeInfo) {
    $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_-]+)', $route);

    // Permitir coincidencia con o sin barra final
    if (preg_match('#^' . $pattern . '/?$#', $requestUri, $matches)) {
        $routeFound = true;
        $view = $routeInfo['view'];
        $needsSession = $routeInfo['needs_session'] ?? false;
        $noHeaderFooter = $routeInfo['no_header_footer'] ?? false;
        break;
    }
}

// Si la ruta no es encontrada, asignamos la página 404
if (!$routeFound) {
    $view = 'app/Views/404.php';
    $noHeaderFooter = false;
} else {
    // Verificar si la ruta requiere sesión
    $needsSession = $routeInfo['needs_session'] ?? false;
    if ($needsSession) {
        verificarSesion(); // Llamada a la función de verificación de sesión
    }

    // Determinar si la vista necesita encabezado y pie de página
    $noHeaderFooter = $routeInfo['no_header_footer'] ?? false;
}

// Incluir encabezado y pie de página si no se especifica que no lo tenga
if (!$noHeaderFooter) {
    include 'app/Views/01_inici/header.php';
}

// Incluir la vista asociada a la ruta
include $view;

// Incluir pie de página si no se especifica que no lo tenga
if (!$noHeaderFooter) {
    include 'app/Views/01_inici/footer.php';
}