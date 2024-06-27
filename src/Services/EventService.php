<?php
require_once '../Models/Event.php';

class EventService
{
  public static function GET($id = null, $slug = null)
  {
    try {
      if ($id) {
        echo Event::getOne($id, $slug);
      } else if ($slug) {
        echo Event::getOne($id, $slug);
      } else {
        echo Event::getAll();
      }
    } catch (Exception $err) {
      self::sendError($err->getMessage());
    }
  }

  public static function POST($data)
  {
    try {
      echo Event::insertOne($data);
    } catch (Exception $err) {
      self::sendError($err->getMessage());
    }
  }

  public static function UPDATE($data)
  {
    try {
      echo Event::updateOne($data);
    } catch (Exception $err) {
      self::sendError($err->getMessage());
    }
  }

  public static function DELETE($data)
  {
    try {
      echo Event::deleteOne($data);
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
