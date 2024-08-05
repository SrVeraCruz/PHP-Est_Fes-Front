<?php
require_once '../config/db.php';

class Event
{
  private static $table = 'events';

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
    $sql = "SELECT * FROM " . self::$table . " WHERE status = '0'";

    $stmt = self::$pdo->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    } else {
      throw new Exception("No such data!");
    }
  }

  public static function getOne($id, $slug)
  {
    self::initConnection();

    if ($id) {
      $sql = "SELECT * FROM " . self::$table . " WHERE id = :id AND status = '0' LIMIT 1";
      $stmt = self::$pdo->prepare($sql);
      $stmt->bindValue(':id', $id);

    } else if($slug) {
      $sql = "SELECT * FROM " . self::$table . " WHERE slug = :slug AND status = '0' LIMIT 1";
      $stmt = self::$pdo->prepare($sql);
      $stmt->bindValue(':slug', $slug);
    }

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

    // Inputs Verification
    if (!trim($data['title'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the event title']);
    } elseif (!trim($data['meta_title'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the event meta-title']);
    } elseif (!trim($data['date']) || !trim($data['time'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Date and time is required']);
    } elseif (!trim($data['location'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the event location']);
    } elseif (!trim($data['content'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'The content of the event is required']);
    } else {

      $add_event_query = "INSERT INTO " . self::$table . " 
      (title, content, date, time, location, slug, meta_title, file, status) 
      VALUES (:title, :content, :date, :time, :location, :slug, :meta_title, :file, :status) LIMIT 1";

      $stmt = self::$pdo->prepare($add_event_query);

      $stmt->bindValue(':title', $data['title']);
      $stmt->bindValue(':content', $data['content']);
      $stmt->bindValue(':date', $data['date']);
      $stmt->bindValue(':time', $data['time']);
      $stmt->bindValue(':location', $data['location']);
      $stmt->bindValue(':slug', $data['slug']);
      $stmt->bindValue(':meta_title', $data['meta_title']);
      $stmt->bindValue(':file', $data['file']);
      $stmt->bindValue(':status', $data['status']);
      $success = $stmt->execute();

      if ($success) {
        http_response_code(200);
        return json_encode(['message_success' => 'Event added successfully']);
      } else {
        throw new Exception('Sommething went wrong');
      }
    }
  }

  public static function updateOne($data)
  {
    self::initConnection();

    // Inputs Verification
    if (!trim($data['title'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the event title']);
    } elseif (!trim($data['meta_title'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the event meta-title']);
    } elseif (!trim($data['date']) || !trim($data['time'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Date and time is required']);
    } elseif (!trim($data['location'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the event location']);
    } elseif (!trim($data['content'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'The content of the event is required']);
    } else {

      $update_news_query = "UPDATE " . self::$table . " SET title = :title, content = :content, date = :date, time = :time, location = :location, slug = :slug, meta_title = :meta_title, file = :file, status = :status WHERE id = :id LIMIT 1";

      $stmt = self::$pdo->prepare($update_news_query);

      $stmt->bindValue(':title', $data['title']);
      $stmt->bindValue(':content', $data['content']);
      $stmt->bindValue(':date', $data['date']);
      $stmt->bindValue(':time', $data['time']);
      $stmt->bindValue(':location', $data['location']);
      $stmt->bindValue(':slug', $data['slug']);
      $stmt->bindValue(':meta_title', $data['meta_title']);
      $stmt->bindValue(':file', $data['file']);
      $stmt->bindValue(':status', $data['status']);
      $stmt->bindValue(':id', $data['update_event_id']);
      $success = $stmt->execute();

      if ($success) {
        http_response_code(200);
        return json_encode(['message_success' => 'Event updated successfully']);
      } else {
        throw new Exception('Something went wrong');
      }
    }
  }

  public static function deleteOne($data)
  {
    self::initConnection();

    $delete_event_query = "DELETE FROM " . self::$table . " WHERE id = :id LIMIT 1";
    $stmt = self::$pdo->prepare($delete_event_query);
    $stmt->bindValue(':id', $data['delete_event_id']);
    $success = $stmt->execute();

    if ($success) {
      http_response_code(200);
      return json_encode(['message_success' => 'Event deleted successfully']);
    } else {
      throw new Exception('Sommething went wrong');
    }
  }
}
