<?php

/*
 * This file is part of Laravel Hashids.
 *
 * (c) Vincent Klaiber <hello@doubledip.se>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'to_user_id',

    /*
    |--------------------------------------------------------------------------
    | Hashids Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        'to_user_id' => [
            'salt' => env('HASHIDS_SALT_USER', 'l0Yf3BND6m5Dp7oyO9HsaPpCodlxihxQ'),
            'length' => 16,
        ],

        'letter_id' => [
            'salt' => env('HASHIDS_SALT_LETTER', 'Ut6yMUCIknVtr9rLa0liKFt8BKgKC2Mc'),
            'length' => 16,
        ],

    ],

];
