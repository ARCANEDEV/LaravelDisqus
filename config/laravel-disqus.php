<?php

return [
    'enabled' => false,

    'options' => [
        /* ------------------------------------------------------------------------------------------------
         |  Username
         | ------------------------------------------------------------------------------------------------
         */
        'username'   => '',

        /* ------------------------------------------------------------------------------------------------
         |  Language
         | ------------------------------------------------------------------------------------------------
         | The supported languages: https://help.disqus.com/customer/portal/articles/466249-multi-lingual-websites
         */
        'language'   => null,
    ],

    'middleware' => Arcanedev\LaravelDisqus\Http\Middleware\DisqusMiddleware::class,
];
