<?php
namespace Core;

use PDO;
use PDOException;

class Database
{
    private static $pdo;

    public static function connect(): PDO
    {
        if (!self::$pdo) {
            $config = require __DIR__ . '/../config/config.php';

            try {
                self::$pdo = new PDO(
                    "mysql:host={$config['db']['host']};dbname={$config['db']['name']};charset=utf8",
                    $config['db']['user'],
                    $config['db']['pass'],
                    [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]
                );
            } catch (PDOException $e) {
                dir('Erro de conexão: '.$e->getMessage());
            }
        }
        return self::$pdo;
    }
}
?>