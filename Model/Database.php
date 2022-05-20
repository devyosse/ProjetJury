<?php

namespace App\Model;

use PDO;
use PDOException;

class Database
{

    private static ?PDO $pdoObject = null;
    private static string $dsn = "mysql:host=%s;dbname=%s;charset=%s";
    private const DB_CHARSET = 'utf8';
    private const DB_NAME = 'projet_';
    private const DB_HOST = 'localhost';
    private const DB_USERNAME = 'root';
    private const DB_PASSWORD = '';

    /**
     * @return PDO
     */
    public static function getPDO(): PDO
    {
        if(self::$pdoObject === null) {
            try {
                $dsn = sprintf(self::$dsn, self::DB_HOST, self::DB_NAME, self::DB_CHARSET);
                self::$pdoObject = new PDO($dsn, self::DB_USERNAME, self::DB_PASSWORD);
                self::$pdoObject->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (PDOException $err) {
                die();
            }
        }

        return self::$pdoObject;
    }
}
