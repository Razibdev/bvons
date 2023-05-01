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

    'default' => env('FILESYSTEM_DRIVER', 'public'),

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

        'db' => [
            'driver' => 'local',
            'root' => base_path('database'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'default' => [
            'driver' => 'local',
            'root' => public_path('default_upload_folder'),
            'url' => env('DEFAULT_STORAGE_URL' , 'http://localhost/public/default_upload_folder'),
            'visibility' => 'public',
        ],

        'user' => [
            'driver' => 'local',
            'root' => public_path('media/user'),
            'url' => env('USER_STORAGE_URL' , 'http://localhost/public/media/user'),
            'visibility' => 'public',
        ],

        'user_profile' => [
            'driver' => 'local',
            'root' => public_path('media/user/profile_pic'),
            'url' => env('USER_PROFILE_URL' , 'http://localhost/public/media/user/profile_pic'),
            'visibility' => 'public',
        ],

        'user_cover' => [
            'driver' => 'local',
            'root' => public_path('media/user/cover_pic'),
            'url' => env('USER_COVER_URL' , 'http://localhost/public/media/user/cover_pic'),
            'visibility' => 'public',
        ],

        'user_upload' => [
            'driver' => 'local',
            'root' => storage_path('app/public/user'),
            'url' => env('USER_UPLOAD_URL',env('APP_URL').'/storage/user'),
            'visibility' => 'public',
        ],

        'img_not_found' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('IMAGE_NOT_FOUND',env('APP_URL').'/storage/img-not-found'),
            'visibility' => 'public',
        ],

        'post' => [
            'driver' => 'local',
            'root' => public_path('media/post'),
            'url' => env('POST_MEDIA_URL' , 'http://localhost/media/post'),
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
