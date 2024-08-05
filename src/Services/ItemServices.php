<?php
require_once '../Models/Item.php';

class ItemService
{
  public static function GET($id = null, $slug = null)
  {
    try {
      if ($id) {
        echo Item::getOne($id, $slug);
      } else if ($slug) {
        echo Item::getOne($id, $slug);
      } else {
        echo Item::getAll();
      }
    } catch (Exception $err) {
      self::sendError($err->getMessage());
    }
  }

  public static function POST($data, $file)
  {
    try {
      echo Item::insertOne($data, $file);
    } catch (Exception $err) {
      self::sendError($err->getMessage());
    }
  }

  public static function UPDATE($data, $file)
  {
    try {
      echo Item::updateOne($data, $file);
    } catch (Exception $err) {
      self::sendError($err->getMessage());
    }
  }

  public static function DELETE($data)
  {
    try {
      echo Item::deleteOne($data);
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
