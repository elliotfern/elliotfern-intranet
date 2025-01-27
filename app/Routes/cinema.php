<?php

return [
    '/cinema' => [
        'view' => 'app/Views/11_cinema_series/index.php',
        'needs_session' => true,
        'no_header_footer' => false,
    ],

    '/cinema/pelicules/llistat' => [
        'view' => 'app/Views/11_cinema_series/vista-llistat-pelicules.php',
        'needs_session' => true,
        'no_header_footer' => false, // No incluir header/footer
    ],

    '/cinema/series' => [
        'view' => 'app/Views/11_cinema_series/vista-llistat-series.php',
        'needs_session' => true,
        'no_header_footer' => false, // No incluir header/footer
    ],

    '/cinema/nova-pelicula' => [
        'view' => 'app/Views/11_cinema_series/form-inserir-pelicula.php',
        'needs_session' => true,
        'no_header_footer' => false, // No incluir header/footer
    ],

    '/cinema/modifica-pelicula/{id}' => [
        'view' => 'app/Views/11_cinema_series/form-inserir-pelicula.php',
        'needs_session' => true,
        'no_header_footer' => false, // No incluir header/footer
    ],

    '/cinema/fitxa-pelicula/{id}' => [
        'view' => 'app/Views/11_cinema_series/vista-pelicula.php',
        'needs_session' => true,
        'no_header_footer' => false, // No incluir header/footer
    ],
];
