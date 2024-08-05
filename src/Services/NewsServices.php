<?php
require_once '../Models/News.php';

class NewsService
{
  public static function GET($id = null, $slug = null)
  {
    try {
      if ($id) {
        echo News::getOne($id, $slug);
      } else if ($slug) {
        echo News::getOne($id, $slug);
      } else {
        echo News::getAll();
      }
    } catch (Exception $err) {
      self::sendError($err->getMessage());
    }
  }

  public static function POST($data)
  {
    try {
      echo News::insertOne($data);
    } catch (Exception $err) {
      self::sendError($err->getMessage());
    }
  }

  public static function UPDATE($data)
  {
    try {
      echo News::updateOne($data);
    } catch (Exception $err) {
      self::sendError($err->getMessage());
    }
  }

  public static function DELETE($data)
  {
    try {
      echo News::deleteOne($data);
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
