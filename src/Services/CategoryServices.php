<?php

require_once '../Models/Category.php';

class CategoryService
{
  public static function GET($id = null, $slug = null)
  {
    try {
      if ($id) {
        echo Category::getOne($id, $slug);
      } else if ($slug) {
        echo Category::getOne($id, $slug);
      } else {
        echo Category::getAll();
      }
    } catch (Exception $err) {
      self::sendError($err->getMessage());
    }
  }

  public static function POST($data, $file)
  {
    try {
      echo Category::insertOne($data, $file);
    } catch (Exception $err) {
      self::sendError($err->getMessage());
    }
  }

  public static function UPDATE($data, $file)
  {
    try {
      echo Category::updateOne($data, $file);
    } catch (Exception $err) {
      self::sendError($err->getMessage());
    }
  }

  public static function DELETE($data)
  {
    try {
      echo Category::deleteOne($data);
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
