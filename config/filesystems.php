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

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],

        'brands' => [
            'driver' => 'local',
            'root' => public_path('assets/images/brands'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],

        'products' => [
            'driver' => 'local',
            'root' => public_path('assets/images/products'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],
        'sliders' => [
            'driver' => 'local',
            'root' => public_path('assets/images/sliders'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'visibility' => 'public',
        ],

        'dropbox' => [
            'driver' => 'dropbox',
            'dropbox_authorization_token' => 'sl.BQp4FlqKgUtNFqmgNL_LcAeR7JvkNKUc70ODDVayaaWazmb7g0oociaNWR24eMPSzoBwFTSibZ7Z14y0p3bJ5sdoxaH5lA6oR3jXPlLULk_8P1cnsL7Bz75jMH4eQLMG9AXIsmohXAI',
            'App folder name' => 'expand.ps',
            'App key' => '0lblk827w2xtgiv',
            'App secret' => 'n04l8yjtmyd72cw',
        ],

        'ftp' => [
            'driver' => 'ftp',
            'host' => env('FTP_HOST', 'u319352.your-storagebox.de'),
            'username' => env('FTP_USERNAME', 'u319352'),
            'password' => env('FTP_PASSWORD', 'QiuJ591eBDbFE5hR'),
            'url' => env('FTP_URl'),
            'visibility' => 'public',
            // Optional FTP Settings...
            // 'port' => env('FTP_PORT', 21),
            // 'root' => env('FTP_ROOT'),
            // 'passive' => true,
            // 'ssl' => true,
            // 'timeout' => 30,
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
