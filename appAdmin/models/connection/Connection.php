<?php

class Connection
{
    private static $dbServer = "localhost";
    private static $dbName = "kyaaf";
    private static $dbUser = "root";
    private static $dbPassword = "";

    private static PDO $conn;

    public static function connect()
    {
        try
        {
            self::$conn = new PDO("mysql:host=" . self::$dbServer . ";dbname=" . self::$dbName . ";charset=utf8", self::$dbUser, self::$dbPassword);
        }
        catch (\Exception $e)
        {
            die($e->getMessage());
        }
    }

    public static function getConn(): PDO
    {
        return self::$conn;
    }
}