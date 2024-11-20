<?php

return [
    '/registre' => [
        'view' => 'public/auth/registre.php',
        'needs_session' => false,
        'no_header_footer' => true,
    ],
    '/entrada' => [
        'view' => 'public/auth/login.php',
        'needs_session' => false,
        'no_header_footer' => true,
    ],
];