<?php

declare(strict_types=1);

return [
    /*
     * Routes configuration
     */
    'routes' => [
        'web' => [
            'middleware' => ['web', 'auth:web'], //default ['web', 'auth:web']
            'prefix' => 'seo', //default seo
            'as' => 'seo.', // default seo.
        ],
        'api' => [
            'middleware' => ['api'],
            'prefix' => 'api',
            'as' => null,
        ],
    ],

    /*
     * Lifetime for cached data in RedirectMiddleware
     * In seconds
     *
     * Default 300
     */
    'cache_ttl' => 300,

    /*
     * Namespace for where to look for models classes
     * Important: Must be inside "app" directory
     *
     * Default 'Models'
     */
    'model_namespace' => 'Models',

    /*
     * Here you can add custom model paths used in api for templates
     *
     * 'model_name' => {app_path_to_model} (for example 'App\\models\\Products')
     */
    'custom_model_names' => [
    ],

    /*
     * Batch size for pagination when generating xml sitemaps
     * Important: Strongly recommended not to set this value bigger than 50000
     *
     * Default 20000
     */
    'batch_size' => 20000,

    /*
     * Enable metadata from other fields specified in additional_fields,
     * not including special fields for metadata
     *
     * Default true
     */
    'additional_fields_enabled' => true,
    'additional_fields' => [
        'title' => [
            'title',
            'name',
        ],
        'description' => [
            'description',
        ],
        'keywords' => [
            'keywords',
        ],
        'og_image' => [
            'og_image',
        ],
        'og_image_alt' => [
            'og_image_alt',
        ],
        'og_image_title' => [
            'og_image_title',
        ]
    ],

    /*
     * Settings for variables in templates
     * Used as regex, so be careful when changing these values
     *
     */
    'variables' => [
        'prefix' => '{\\$',
        'postfix' => '}'
    ],
];
