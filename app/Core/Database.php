<?php

namespace App\Core;

use PDO;

class Database extends PDO {

    private static $host = DBHOST;
    private static $dbname = DBNAME;
    private static $username = DBUSER;
    private static $password = DBPASS;
    private static $conn = null;

    public function __construct()
    {
        die('A função Init nao é permitido!');
    }

    static function connect() 
    {
        try {
            self::$conn = new PDO('mysql:host='. self::$host . ';dbname=' . self::$dbname, self::$username, self::$password);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);            
        } catch (\PDOException $error) {
            echo $error->getMessage();
        }
        return self::$conn;
    }

    public static function disconnect()
    {
        self::$conn = null;
    }	

}

