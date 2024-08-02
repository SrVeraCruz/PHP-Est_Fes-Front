<?php

class Database
{
  private static $pdo = null;

  public static function getConnection()
  {
    if (self::$pdo === null) {
      // $host = 'localhost';
      // $db = 'est_fes';
      // $user = 'root';
      // $pass = '';
      // $dsn = "mysql:host=$host;dbname=$db;charset=utf8";
      $host = getenv('DB_HOST');
      $port = getenv('DB_PORT');
      $db = getenv('DB_DATABASE');
      $user = getenv('DB_USERNAME');
      $pass = getenv('DB_PASSWORD');
      $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8";

      try {
        self::$pdo = new PDO($dsn, $user, $pass, [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          PDO::ATTR_EMULATE_PREPARES   => false,
        ]);
      } catch (PDOException $err) {
        die("Database connection failed: " . $err->getMessage());
      }
    }

    return self::$pdo;
  }
}
