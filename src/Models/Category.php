<?php

require_once '../config/db.php';

class Category
{
  private static $table = "categories";
  private static $allowed_files = ['png', 'jpg', 'jpeg', 'webp', 'avif', 'svg'];
  private static $file_max_size = 1000000;
  private static $destination_path_upload = '../../uploads/categories/';

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
    $sql = "SELECT ct.*, pct.name AS parent_name 
    FROM " . self::$table . " ct 
    LEFT JOIN " . self::$table . " pct 
    ON ct.parent_category_id = pct.id WHERE ct.status = '0' AND ct.navbar_status = '0'";

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
      $sql = 'SELECT ct.*, pct.name AS parent_name 
      FROM ' . self::$table . ' ct 
      LEFT JOIN ' . self::$table . ' pct 
      ON ct.parent_category_id = pct.id 
      WHERE ct.id = :id AND ct.status = "0" AND ct.navbar_status = "0" LIMIT 1';

      $stmt = self::$pdo->prepare($sql);
      $stmt->bindValue(':id', $id);
    } else if ($slug) {
      $sql = 'SELECT ct.*, pct.name AS parent_name 
      FROM ' . self::$table . ' ct 
      LEFT JOIN ' . self::$table . ' pct 
      ON ct.parent_category_id = pct.id 
      WHERE ct.slug = :slug LIMIT 1';

      $stmt = self::$pdo->prepare($sql);
      $stmt->bindValue(':slug', $slug);
    } else {
      http_response_code(400);
      return json_encode(['message_error' => 'Invalid Reference']);
    }

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return json_encode($stmt->fetch(PDO::FETCH_ASSOC));
    } else {
      throw new Exception("No such data!");
    }
  }

  public static function insertOne($data, $file)
  {
    // Add category
    self::initConnection();

    if (!trim($data['name'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the category name']);
    } elseif (!trim($data['title'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the category title']);
    } else {

      // Work on Logo
      $file_to_upload = '';
      if (isset($file['logo'])) {
        if ($file['logo']['name'] != null || $file['logo']['name'] != '') {
          $file_extention = pathinfo($file['logo']['name'], PATHINFO_EXTENSION);

          if (in_array($file_extention, self::$allowed_files)) {
            if ($file['logo']['size'] <= self::$file_max_size) {
              $time = time();
              $file_to_upload = $time . $file['logo']['name'];
              $file_destination_path = self::$destination_path_upload . $file_to_upload;

              if ((move_uploaded_file($file['logo']["tmp_name"], $file_destination_path)) == false) {
                http_response_code(400);
                return json_encode(['message_warning' => "Sommething went wrong on uploading Logo"]);
              }
            } else {
              http_response_code(400);
              return json_encode(['message_warning' => "File size too big. Should be less than 1Mb"]);
            }
          } else {
            http_response_code(400);
            return json_encode(['message_warning' => "File Should be 'png','jpg','jpeg','webp','avif','svg'"]);
          }
        }
      }

      $add_cat_query = "INSERT INTO " . self::$table . " (parent_category_id, name, title, slug, logo, navbar_status) 
      VALUES (:parent_category_id, :name, :title, :slug, :file_to_upload, :navbar_status) LIMIT 1";

      $stmt = self::$pdo->prepare($add_cat_query);
      $stmt->bindValue(':parent_category_id', $data['parent_category_id']);
      $stmt->bindValue(':name', $data['name']);
      $stmt->bindValue(':title', $data['title']);
      $stmt->bindValue(':slug', $data['slug']);
      $stmt->bindValue(':file_to_upload', $file_to_upload);
      $stmt->bindValue(':navbar_status', $data['navbar_status']);
      $success = $stmt->execute();

      if ($success) {
        http_response_code(200);
        return json_encode(['message_success' => 'Category added successfully']);
      } else {
        throw new Exception('Sommething went wrong');
      }
    }
  }

  public static function updateOne($data, $file)
  {
    // Edit category
    self::initConnection();

    if (!trim($data['name'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the category name']);
    } elseif (!trim($data['title'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the category title']);
    } else {

      // Check file status
      $file_to_upload = $data['logo_old_name'];
      if (isset($file['logo'])) {
        if ($file['logo']['name'] != null || $file['logo']['name'] != '') {
          $file_extention = pathinfo($file['logo']['name'], PATHINFO_EXTENSION);

          if (in_array($file_extention, self::$allowed_files)) {
            if ($file['logo']['size'] <= self::$file_max_size) {
              $time = time();
              $file_to_upload = $time . $file['logo']['name'];
              $file_destination_path = self::$destination_path_upload . $file_to_upload;
            } else {
              http_response_code(400);
              return json_encode(['message_warning' => "File size too big. Should be less than 1Mb"]);
            }
          } else {
            http_response_code(400);
            return json_encode(['message_warning' => "File Should be 'png','jpg','jpeg','webp','avif','svg'"]);
          }
        }
      }

      $update_cat_query = "UPDATE " . self::$table . " 
      SET parent_category_id = :parent_category_id, name = :name, title = :title, slug = :slug, logo = :logo, navbar_status = :navbar_status WHERE id = :id LIMIT 1";

      $stmt = self::$pdo->prepare($update_cat_query);
      $stmt->bindValue(':parent_category_id', $data['parent_category_id']);
      $stmt->bindValue(':name', $data['name']);
      $stmt->bindValue(':title', $data['title']);
      $stmt->bindValue(':slug', $data['slug']);
      $stmt->bindValue(':logo', $file_to_upload);
      $stmt->bindValue(':navbar_status', $data['navbar_status']);
      $stmt->bindValue(':id', $data['update_cat_id']);
      $success = $stmt->execute();

      if ($success) {
        if (isset($file['logo'])) {
          if ($file['logo']['name'] != null || $file['logo']['name'] != '') {
            $file_old_destination_path = self::$destination_path_upload . $data['logo_old_name'];

            if (file_exists($file_old_destination_path)) {
              unlink($file_old_destination_path);
            }

            if ((move_uploaded_file($file['logo']["tmp_name"], $file_destination_path)) == false) {
              http_response_code(400);
              return json_encode(['message_warning' => "Sommething went wrong on uploading File"]);
            }
          }
        }

        http_response_code(200);
        return json_encode(['message_success' => 'Category updated successfully']);
      } else {
        throw new Exception('Sommething went wrong');
      }
    }
  }

  public static function deleteOne($data)
  {
    // Delete category
    self::initConnection();
    $delete_cat_query = "UPDATE " . self::$table . " 
    SET status = '2' 
    WHERE id = :id LIMIT 1";

    $stmt = self::$pdo->prepare($delete_cat_query);
    $stmt->bindValue(':id', $data['delete_cat_id']);
    $success = $stmt->execute();

    if ($success) {
      $file_old_destination_path = self::$destination_path_upload . $data['logo'];
      if (file_exists($file_old_destination_path)) {
        unlink($file_old_destination_path);
      }

      http_response_code(200);
      return json_encode(['message_success' => 'Category deleted successfully']);
    } else {
      throw new Exception('Sommething went wrong');
    }
  }
}
