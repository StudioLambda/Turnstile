<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Turnstyle Site Key
    |--------------------------------------------------------------------------
    |
    | This value is the site key found in the Cloudflare dashboard.
    | It is used to output the correct script for the Turnstyle challenge.
    |
    */

    'site_key' => env('TURNSTILE_SITE_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Turnstyle Secret Key
    |--------------------------------------------------------------------------
    |
    | This value is the secret key found in the Cloudflare dashboard.
    | It is used to perform the HTTP request to the Turnstile API.
    |
    */

    'secret_key' => env('TURNSTILE_SECRET_KEY'),
];
