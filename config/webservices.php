<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Directory web service url
    |--------------------------------------------------------------------------
    |
    | As mentioned this is the url for the media web service
    |
    */

    'directory_url' => env('DIRECTORY_URL', ''),

    /*
    |--------------------------------------------------------------------------
    | Media web service url
    |--------------------------------------------------------------------------
    |
    | As mentioned this is the url for the media web service
    |
    */

    'media_url' => env('MEDIA_URL', ''),

    /*
    |--------------------------------------------------------------------------
    | Application secret key
    |--------------------------------------------------------------------------
    |
    | This is a secret key shared between alpha and directory.
    |
    */

    'secret_key' => env('DIRECTORY_SECRET_KEY', ''),
];
