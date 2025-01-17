<?php

return [
    '/biblioteca' => [
        'view' => 'app/Views/08_biblioteca_llibres/index.php',
        'needs_session' => true,
        'no_header_footer' => false,
    ],

    // Llibres
    '/biblioteca/llibres' => [
        'view' => 'app/Views/08_biblioteca_llibres/books.php',
        'needs_session' => true,
        'no_header_footer' => false, // No incluir header/footer
    ],

    '/biblioteca/llibre/fitxa/{llibreSlug}' => [
        'view' => 'app/Views/08_biblioteca_llibres/vista-llibre.php',
        'needs_session' => true,
        'no_header_footer' => false, // No incluir header/footer
    ],

<<<<<<< HEAD
    '/biblioteca/llibre/modifica/{llibreId}' => [
        'view' => 'app/Views/08_biblioteca_llibres/form-modifica-llibre.php',
        'needs_session' => true,
        'no_header_footer' => false, // No incluir header/footer
    ],

=======
>>>>>>> 9a73a7e249f477a8924ef753dfb8d632661ce007
    '/biblioteca/llibre/nou' => [
        'view' => 'app/Views/08_biblioteca_llibres/biblioteca-llibre-inserir.php',
        'needs_session' => true,
        'no_header_footer' => false, // No incluir header/footer
    ],

    // Autors
    '/biblioteca/autors' => [
        'view' => 'app/Views/08_biblioteca_llibres/authors.php',
        'needs_session' => true,
        'no_header_footer' => false, // No incluir header/footer
    ],

    '/biblioteca/autor/fitxa/{autorSlug}' => [
        'view' => 'app/Views/08_biblioteca_llibres/vista-autor.php',
        'needs_session' => true,
        'no_header_footer' => false, // No incluir header/footer
    ],

    '/biblioteca/autor/modifica/{autorId}' => [
        'view' => 'app/Views/08_biblioteca_llibres/form-modifica-autor.php',
        'needs_session' => true,
        'no_header_footer' => false, // No incluir header/footer
    ],

    '/biblioteca/autor/nou' => [
        'view' => 'app/Views/08_biblioteca_llibres/biblioteca-autor-inserir.php',
        'needs_session' => true,
        'no_header_footer' => false, // No incluir header/footer
    ],
];
