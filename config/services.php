<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    
    'facebook' => [
       'client_id' => '1719301028344035',
       'client_secret' => '3f93c3c6996caa60edc68c7c7c1b085d',
       'redirect' => 'http://apero.dev/social/facebookcallback',
],
    
    'twitter' => [
       'client_id' => 'HSdG7jFo47JMlMLhNz9OXOy4E',
       'client_secret' => 'LzUOGYt7EvxRzya5KkOGgOelN3jjhfKBCr73g1uOjmgNRfboST',
       'redirect' => 'http://apero.dev/social/twittercallback',
],
    
    'paypal' => [
       'client_id' => 'AaT4WDRapzLqr8KRIfOc1sFqvv0qshsmXw67h-taPjL9qDXm27EWvEsEJdZND71W4_2xiFi-qU_WY0sf',
       'secret' => 'EMCoH9iNqMW-MM3JVThjtURFovxSTc4GFzPuW-iRsBIcXzuJl0pYoDU53_msq05cMG7_Ezn8iih7jKCQ'
],

    'mandrill' => [
        'secret' => env('MANDRILL_KEY'),
    ],


];
