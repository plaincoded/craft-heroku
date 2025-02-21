<?php
/**
 * Yii Application Config
 *
 * Edit this file at your own risk!
 *
 * The array returned by this file will get merged with
 * vendor/craftcms/cms/src/config/app.php and app.[web|console].php, when
 * Craft's bootstrap script is defining the configuration for the entire
 * application.
 *
 * You can define custom modules and system components, and even override the
 * built-in system components.
 *
 * If you want to modify the application config for *only* web requests or
 * *only* console requests, create an app.web.php or app.console.php file in
 * your config/ folder, alongside this one.
 */

use craft\helpers\App;

return [
    '*' => [
        'modules' => [
            'my-module' => \modules\Module::class,
        ],
        'bootstrap' => [
            'my-module',
        ],
    ],
    'production' => [
        'components' => [
            'redis' => [
                'class' => yii\redis\Connection::class,
                'hostname' => parse_url(App::env('REDIS_URL'), PHP_URL_HOST),
                'port' => parse_url(App::env('REDIS_URL'), PHP_URL_PORT),
                'password' => parse_url(App::env('REDIS_URL'), PHP_URL_PASS),
            ],
            'session' => [
                'class' => yii\redis\Session::class,
                'as session' => [
                    'class' => \craft\behaviors\SessionBehavior::class,
                ],
            ],
            'cache' => [
                'class' => yii\redis\Cache::class,
                'defaultDuration' => 86400
            ],
        ],
    ],
];
