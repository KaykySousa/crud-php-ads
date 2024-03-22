<?php

namespace App\Database;

use PDO;

class Database {

    private static $driver = "mysql";
    private static $host = "127.0.0.1";
    private static $db_name = "a01_teste";
    private static $username = "root";
    private static $password = "";
    private static $instance;

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new PDO(
                self::$driver . ":host=" . self::$host . ";dbname=" . self::$db_name,
                self::$username,
                self::$password
            );
        }

        return self::$instance;
    }
}
