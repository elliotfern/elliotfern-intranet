<?php

return [
    '/registre' => [
        'view' => 'app/Views/auth/registre.php',
        'needs_session' => false,
        'no_header_footer' => true,
    ],
    '/entrada' => [
        'view' => 'app/Views/auth/login.php',
        'needs_session' => false,
        'no_header_footer' => true,
    ],
];