<?php

class Database
{
    private static $instance = null;

    public static function getConnection()
    {
        if (self::$instance === null)
        {
            self::$instance = new PDO(
                "mysql:host=localhost:3307;dbname=netflix_db;charset=utf8",
                "root",
                ""
            );

            self::$instance->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        }

        return self::$instance;
    }
}