<?php

class Database
{
  private static $pdo = null;

  public static function getConnection()
  {
    if (self::$pdo === null) {
      $host = $_ENV['DB_HOST'];
      $db = $_ENV['DB_NAME'];
      $user = $_ENV['DB_USER'];
      $pass = $_ENV['DB_PASS'];
      $dsn = "mysql:host=$host;dbname=$db;charset=utf8";

      try {
        self::$pdo = new PDO($dsn, $user, $pass, [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
      } catch (PDOException $err) {
        die("Database connection failed: " . $err->getMessage());
      }
    }

    return self::$pdo;
  }
}
