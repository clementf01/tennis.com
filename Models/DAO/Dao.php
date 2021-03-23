<?php
// page de connexion à la base de données
namespace Models\DAO;

use PDOException;

class Dao
{
    private static $db = null;
    public static function getConnection()
    {
        if (self::$db === null) {
            try {
                self::$db = new \PDO('mysql:host=127.0.0.1;port=3306;dbname=tennis_blog;charset=utf8', 'root', '');
            } catch (PDOException $ex) {
                $ex->getMessage();
            }
            return self::$db;
        }
    }
}
