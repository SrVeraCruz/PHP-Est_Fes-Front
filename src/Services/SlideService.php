<?php

require_once '../Models/Slide.php';

class SlideService
{
  public static function GET($id = null)
  {
    try {
      if ($id) {
        echo Slide::getOne($id);
      } else {
        echo Slide::getAll();
      }
    } catch (Exception $err) {
      self::sendError($err->getMessage());
    }
  }

  public static function POST($data)
  {
    try {
      echo Slide::insertOne($data);
    } catch (Exception $err) {
      self::sendError($err->getMessage());
    }
  }

  public static function UPDATE($data)
  {
    try {
      echo Slide::updateOne($data);
    } catch (Exception $err) {
      self::sendError($err->getMessage());
    }
  }

  public static function DELETE($data)
  {
    try {
      echo Slide::deleteOne($data);
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
