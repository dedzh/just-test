<?php
declare(strict_types =1);

class database
{
    private static ?PDO $instance = null;

    public static function getConnection(): PDO
    {
        if (self::$instance == null){
            $dbPath = __DIR__ . '/../storage'
        }

    }




}
