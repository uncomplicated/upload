<?php

return [


    'disk_name' => env('MEDIA_DISK', 'public'),


    'max_file_size' => 1024 * 1024 * 10, // 10MB

    'mime_default_type' => 'default',

    'route' => [

        'prefix' => env('ADMIN_ROUTE_PREFIX', ''),

        'namespace' => 'Ggss\Upload\\Controllers',

        'middleware' => [],
    ],


];
