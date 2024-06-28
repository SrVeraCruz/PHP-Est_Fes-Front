<?php
require_once '../Models/Newsletter.php';

class NewsletterService
{
  public static function GET($id = null)
  {
    try {
      if ($id) {
        echo Newsletter::getOne($id);
      } else {
        echo Newsletter::getAll();
      }
    } catch (Exception $err) {
      self::sendError($err->getMessage());
    }
  }

  public static function POST($data)
  {
    try {
      echo Newsletter::insertOne($data);
    } catch (Exception $err) {
      self::sendError($err->getMessage());
    }
  }

  public static function UPDATE($data)
  {
    try {
      echo Newsletter::updateOne($data);
    } catch (Exception $err) {
      self::sendError($err->getMessage());
    }
  }

  public static function DELETE($data)
  {
    try {
      echo Newsletter::deleteOne($data);
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
