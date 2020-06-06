<?php declare(strict_types=1);

namespace App\Database;

use PDO;

class Database
{
    private static $connection = null;

    // private constructor for singleton pattern
    private function __construct()
    {
    }

    // Get the existing instance or generate a new one
    public static function getConnection(): PDO
    {
        if (self::$connection) {
            return self::$connection;
        }

        self::$connection = new PDO('mysql:host=db;dbname=oclock', 'admin', 'admin');

        return self::getConnection();
    }
}
