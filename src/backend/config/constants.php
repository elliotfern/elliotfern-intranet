<?php

// PER USAR EN LES URLS
define('APP_URL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']); // https://gestio.elliotfern.com

define('APP_ROOT', dirname(__DIR__));

// Missatges
define('ADD_OK_MESSAGE_SHORT', 'Dades afegidades correctament!');
define('ADD_OK_MESSAGE', 'Les dades s\'han afegit correctament a la base de dades.');
define('ERROR_TYPE_MESSAGE_SHORT', 'Error!');
define('ERROR_TYPE_MESSAGE', 'Verifica que les dades siguin correctes');
