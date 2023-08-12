<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been set up for each driver as an example of the required values.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
            'throw' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
        ],

        'private_documents' => [
            'driver' => 'local',
            'root' => storage_path('app/uploads/private_documents'),
            'url' => env('APP_URL').'/storage/private_documents',
            'visibility' => 'public',
            'throw' => false,
        ],

        'legal_disclaimers' => [
            'driver' => 'local',
            'root' => storage_path('app/uploads/legal_disclaimers'),
            'url' => env('APP_URL').'/storage/legal_disclaimers',
            'visibility' => 'public',
            'throw' => false,
        ],

        'pitch_deck' => [
            'driver' => 'local',
            'root' => storage_path('app/uploads/pitch_deck'),
            'url' => env('APP_URL').'/storage/uploads/pitch_deck',
            'visibility' => 'public',
        ],
        
        'reports' => [
            'driver' => 'local',
            'root' => storage_path('app/uploads/reports'),
            'url' => env('APP_URL').'/storage/uploads/reports',
            'visibility' => 'public',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
