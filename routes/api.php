<?php

return [
    // API: Registre usuari / Login
    '/api/auth/login' => [
        'view' => 'api/00_auth/login.php',
        'needs_session' => false,
        'no_header_footer' => true,
    ],

    '/api/auth/registre' => [
        'view' => 'api/00_auth/registre.php',
        'needs_session' => false,
        'no_header_footer' => true, // No incluir header/footer
    ],
];