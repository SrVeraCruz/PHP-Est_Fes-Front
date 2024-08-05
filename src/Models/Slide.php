<?php

require_once '../config/db.php';

class Slide
{
  private static $table = "slides";
  private static $pdo = null;

  private static function initConnection()
  {
    if (self::$pdo === null) {
      self::$pdo = Database::getConnection();
    }
  }

  public static function getAll()
  {
    self::initConnection();
    $sql = "SELECT * FROM " . self::$table . " WHERE status = 0";

    $stmt = self::$pdo->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    } else {
      throw new Exception("No such data!");
    }
  }

  public static function getOne($id)
  {
    self::initConnection();
    $sql = "SELECT * FROM " . self::$table . " WHERE id = :id AND status = 0 LIMIT 1";

    $stmt = self::$pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return json_encode($stmt->fetch(PDO::FETCH_ASSOC));
    } else {
      throw new Exception("No such data!");
    }
  }

  public static function insertOne($data)
  {
    self::initConnection();

    if (!trim($data['type'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the slide type']);
    } elseif (!trim($data['image'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the image']);
    } else {

      $add_query = "INSERT INTO " . self::$table . " 
        (title, type, image, status) VALUES 
        (:title, :type, :image, :status) LIMIT 1"
      ;

      $stmt = self::$pdo->prepare($add_query);
      $stmt->bindValue(':type', $data['type']);
      $stmt->bindValue(':title', $data['title']);
      $stmt->bindValue(':image', $data['image']);
      $stmt->bindValue(':status', $data['status']);
      $success = $stmt->execute();

      if ($success) {
        http_response_code(200);
        return json_encode(['message_success' => 'Item added on slide successfully']);
      } else {
        throw new Exception('Sommething went wrong');
      }
    }
  }

  public static function updateOne($data)
  {
    self::initConnection();

    if (!trim($data['type'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the slide type']);
    } elseif (!trim($data['image'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the image']);
    } else {

      $update_query = "UPDATE " . self::$table . " 
        SET title = :title, type = :type, image = :image, status = :status WHERE id = :id LIMIT 1"
      ;

      $stmt = self::$pdo->prepare($update_query);
      $stmt->bindValue(':type', $data['type']);
      $stmt->bindValue(':title', $data['title']);
      $stmt->bindValue(':image', $data['image']);
      $stmt->bindValue(':status', $data['status']);
      $stmt->bindValue(':id', $data['update_id']);
      $success = $stmt->execute();

      if ($success) {
        http_response_code(200);
        return json_encode(['message_success' => 'Item updated in slide successfully']);
      } else {
        throw new Exception('Sommething went wrong');
      }
    }
  }

  public static function deleteOne($data)
  {
    self::initConnection();
    $delete_query = "UPDATE " . self::$table . " 
      SET status = '2' WHERE id = :id LIMIT 1"
    ;

    $stmt = self::$pdo->prepare($delete_query);
    $stmt->bindValue(':id', $data['delete_id']);
    $success = $stmt->execute();

    if ($success) {
      http_response_code(200);
      return json_encode(['message_success' => 'Item Slide deleted successfully']);
    } else {
      throw new Exception('Sommething went wrong');
    }
  }
}
