<?php

namespace App\Models;

use App\Libraries\SafeMySQL;

abstract class Model
{
    protected static $db;

    /**
     * Connect to database
     *
     * @return object
     */
    protected static function dbConnect(): object
    {
        return new SafeMySQL([
            'user' => getenv('DB_USER'),
            'pass' => getenv('DB_PASS'),
            'db' => getenv('DB_NAME'),
            'host' => getenv('DB_HOST')
        ]);
    }
}