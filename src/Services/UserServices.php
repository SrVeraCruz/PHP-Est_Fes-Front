<?php
require_once '../Models/User.php';

class UserService
{
  public static function GET($id = null)
  {
    try {
      if ($id) {
        echo User::getOne($id);
      } else {
        echo User::getAll();
      }
    } catch (Exception $err) {
      self::sendError($err->getMessage());
    }
  }

  public static function POST($data, $file)
  {
    try {
      echo User::insertOne($data, $file);
    } catch (Exception $err) {
      self::sendError($err->getMessage());
    }
  }

  public static function UPDATE($data, $file)
  {
    try {
      echo User::updateOne($data, $file);
    } catch (Exception $err) {
      self::sendError($err->getMessage());
    }
  }

  public static function DELETE($data)
  {
    try {
      echo User::deleteOne($data);
    } catch (Exception $err) {
      self::sendError($err->getMessage());
    }
  }

  public static function LOGIN($email, $password)
  {
    try {
      echo User::authenticate($email, $password);
    } catch (Exception $err) {
      self::sendError($err->getMessage());
    }
  }

  public static function LOGOUT()
  {
    try {
      echo User::logout();
    } catch (Exception $err) {
      self::sendError($err->getMessage());
    }
  }

  private static function sendError($message)
  {
    http_response_code(500);
    echo json_encode(['message' => $message]);
  }
}
