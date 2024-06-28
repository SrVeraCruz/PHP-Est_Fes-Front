<?php
require_once '../config/db.php';

class Newsletter
{
  private static $table = 'newsletter';
  private static $table_users = 'users';
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
    $sql = "SELECT * FROM " . self::$table;

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
    $sql = "SELECT * FROM " . self::$table . " WHERE id = :id LIMIT 1";

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

    // Inputs Verification
    if (!trim($data['email'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Email is required']);
    } else {

      $email_query = "SELECT * FROM " 
        . self::$table_users . 
        " WHERE email = :email LIMIT 1"
      ;

      $stmt = self::$pdo->prepare($email_query);
      $stmt->bindValue(':email', $data['email']);
      $stmt->execute();

      if ($stmt->rowCount() > 0) {
        $verify_sub_query = "SELECT * FROM " 
          . self::$table . 
          " WHERE email = :email LIMIT 1"
        ;

        $stmt = self::$pdo->prepare($verify_sub_query);
        $stmt->bindValue(':email', $data['email']);
        $stmt->execute();

        if ($stmt->rowCount() < 1) { 
          $add_query = "INSERT INTO " 
            . self::$table . 
            " (email, status) VALUES 
            (:email, :status) LIMIT 1"
          ;

          $status = '0';
          if(isset($data['status']) && $data['status'] !== '') {
            $status = $data['status'];
          }

          $stmt = self::$pdo->prepare($add_query);

          $stmt->bindValue(':email', $data['email']);
          $stmt->bindValue(':status', $status);
          $success = $stmt->execute();

          if ($success) {
            http_response_code(200);
            return json_encode(['message_success' => 'You are Subscribed successfully']);
          } else {
            throw new Exception('Sommething went wrong');
          }
        } else {
          http_response_code(400);
          return json_encode(['message_already_subscribed' => 'You are already subscribed']);
        }
      } else {
        http_response_code(400);
        return json_encode(['message_unauthorized' => 'Unauthorized email']);
      }
    }
  }

  public static function updateOne($data)
  {
    self::initConnection();

    $update_query = "UPDATE " . self::$table . 
      " SET status = :status WHERE id = :id LIMIT 1"
    ;

    $stmt = self::$pdo->prepare($update_query);

    $stmt->bindValue(':status', $data['status']);
    $stmt->bindValue(':id', $data['update_id']);
    $success = $stmt->execute();

    if ($success) {
      http_response_code(200);
      return json_encode(['message_success' => 'Subscription updated successfully']);
    } else {
      throw new Exception('Something went wrong');
    }
  }

  public static function deleteOne($data)
  {
    self::initConnection();

    $delete_query = "DELETE FROM " . self::$table . " WHERE id = :id LIMIT 1";
    $stmt = self::$pdo->prepare($delete_query);
    $stmt->bindValue(':id', $data['delete_id']);
    $success = $stmt->execute();

    if ($success) {
      http_response_code(200);
      return json_encode(['message_success' => 'You are unsubscribed successfully']);
    } else {
      throw new Exception('Sommething went wrong');
    }
  }
}
