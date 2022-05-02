<?php

class Database extends PDO {

    private static $host = 'localhost';
    private static $dbname = 'users';
    private static $username = 'root';
    private static $password = '';
    private static $conn = null;

    public function __construct()
    {
        die('A função Init nao é permitido!');
    }

    static function connect() {
        try {
            self::$conn = new PDO('mysql:host='. self::$host . ';dbname=' . self::$dbname, self::$username, self::$password);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);            
        } catch (PDOException $error) {
            echo $error->getMessage();
        }
        return self::$conn;
    }

    public static function disconnect()
    {
        self::$conn = null;
    }	

}

