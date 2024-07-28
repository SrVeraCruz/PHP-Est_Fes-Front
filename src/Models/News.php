<?php
require_once '../config/db.php';

class News
{
  private static $table = 'news';

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
      return json_encode(['message_warning' => 'Please enter the news title']);
    } elseif (!trim($data['content'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'The content of the news is required']);
    } elseif (!trim($data['slug'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the slug of the news']);
    } elseif (!trim($data['meta_title'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the news meta-title']);
    } elseif (!trim($data['thumbnail'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'The thumbnail of the news is required']);
    } else {

      $add_item_query = "INSERT INTO " . self::$table . " 
      (title, content, slug, meta_title, thumbnail, file, status) 
      VALUES (:title, :content, :slug, :meta_title, :thumbnail, :file, :status) LIMIT 1";

      $stmt = self::$pdo->prepare($add_item_query);

      $stmt->bindValue(':title', $data['title']);
      $stmt->bindValue(':content', $data['content']);
      $stmt->bindValue(':slug', $data['slug']);
      $stmt->bindValue(':meta_title', $data['meta_title']);
      $stmt->bindValue(':thumbnail', $data['thumbnail']);
      $stmt->bindValue(':file', $data['file']);
      $stmt->bindValue(':status', $data['status']);
      $success = $stmt->execute();

      if ($success) {
        http_response_code(200);
        return json_encode(['message_success' => 'Item added successfully']);
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
      return json_encode(['message_warning' => 'Please enter the news title']);
    } elseif (!trim($data['slug'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the slug of the news']);
    } elseif (!trim($data['meta_title'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the news meta-title']);
    } elseif (!trim($data['content'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'The content of the news is required']);
    } else {

      $update_news_query = "UPDATE " . self::$table . " SET title = :title, content = :content, slug = :slug, meta_title = :meta_title, thumbnail = :thumbnail, file = :file, status = :status WHERE id = :id LIMIT 1";

      $stmt = self::$pdo->prepare($update_news_query);

      $stmt->bindValue(':title', $data['title']);
      $stmt->bindValue(':content', $data['content']);
      $stmt->bindValue(':slug', $data['slug']);
      $stmt->bindValue(':meta_title', $data['meta_title']);
      $stmt->bindValue(':thumbnail', $data['thumbnail']);
      $stmt->bindValue(':file', $data['file']);
      $stmt->bindValue(':status', $data['status']);
      $stmt->bindValue(':id', $data['update_news_id']);
      $success = $stmt->execute();

      if ($success) {
        http_response_code(200);
        return json_encode(['message_success' => 'Item updated successfully']);
      } else {
        throw new Exception('Something went wrong');
      }
    }
  }

  public static function deleteOne($data)
  {
    self::initConnection();

    $delete_news_query = "DELETE FROM " . self::$table . " WHERE id = :id LIMIT 1";
    $stmt = self::$pdo->prepare($delete_news_query);
    $stmt->bindValue(':id', $data['delete_news_id']);
    $success = $stmt->execute();

    if ($success) {
      http_response_code(200);
      return json_encode(['message_success' => 'News deleted successfully']);
    } else {
      throw new Exception('Sommething went wrong');
    }
  }
}
