<?php
require_once '../config/db.php';

class Item
{
  private static $table = 'items';
  private static $category_table = 'categories';
  private static $logo_allowed_files = ['png', 'jpg', 'jpeg', 'webp', 'avif', 'svg'];
  private static $file_allowed_files = ['pdf', 'png', 'jpg', 'jpeg', 'webp', 'avif', 'svg'];
  private static $logo_max_size = 1000000;
  private static $file_max_size = 10000000;
  private static $upload_item_path = '../../uploads/items/';
  private static $upload_file_path = '../../uploads/files/';

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
    $sql = "SELECT it.*, cit.name AS category_name 
    FROM " . self::$table . " it 
    LEFT JOIN " . self::$category_table . " cit 
    ON it.category_id = cit.id";

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
      $sql = "SELECT it.*, cit.name AS category_name 
      FROM " . self::$table . " it 
      LEFT JOIN " . self::$category_table . " cit 
      ON it.category_id = cit.id WHERE it.id = :id";

      $stmt = self::$pdo->prepare($sql);
      $stmt->bindValue(':id', $id);
    } else if ($slug) {

      $sql = "SELECT it.*, cit.name AS category_name 
      FROM " . self::$table . " it 
      LEFT JOIN " . self::$category_table . " cit 
      ON it.category_id = cit.id WHERE it.slug = :slug";

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
    self::initConnection();

    $cotent_data = json_decode($data['data_content']);

    // Inputs Verification
    if (!trim($data['name'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the item name']);
    } elseif (!trim($data['category_id'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the item category']);
    } elseif (!trim($data['title'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the item title']);
    } elseif (!trim($data['slug'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the slug of the item']);
    } elseif (!trim($data['meta_title'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the item meta-title']);
    } elseif (!trim($cotent_data[0]->title)) {
      http_response_code(400);
      return json_encode(['message_warning' => 'The item need 1+ subtitle']);
    } elseif (!trim($cotent_data[0]->description)) {
      http_response_code(400);
      return json_encode(['message_warning' => 'The item need 1+ description']);
    } else {

      // Work on Logo
      $logo_to_upload = '';
      if (isset($file['logo'])) {
        if ($file['logo']['name'] != null || $file['logo']['name'] != '') {
          $logo_extention = pathinfo($file['logo']['name'], PATHINFO_EXTENSION);

          if (in_array($logo_extention, self::$logo_allowed_files)) {
            if ($file['logo']['size'] <= self::$logo_max_size) {
              $time = time();
              $logo_to_upload = $time . $file['logo']['name'];
              $logo_destination_path = self::$upload_item_path . $logo_to_upload;

              if ((move_uploaded_file($file['logo']["tmp_name"], $logo_destination_path)) == false) {
                http_response_code(400);
                return json_encode(['message_warning' => "Sommething went wrong on uploading Logo"]);
              }
            } else {
              http_response_code(400);
              return json_encode(['message_warning' => "Logo size too big. Should be less than 1Mb"]);
            }
          } else {
            http_response_code(400);
            return json_encode(['message_warning' => "Logo Should be 'png','jpg','jpeg','webp','avif','svg'"]);
          }
        }
      }

      // Work on File
      $file_to_upload = '';
      if (isset($file['file'])) {
        if ($file['file']['name'] != null || $file['file']['name'] != '') {
          $file_extention = pathinfo($file['file']['name'], PATHINFO_EXTENSION);

          if (in_array($file_extention, self::$file_allowed_files)) {
            if ($file['file']['size'] <= self::$file_max_size) {
              $time = time();
              $file_to_upload = $time . $file['file']['name'];
              $file_destination_path = self::$upload_file_path . $file_to_upload;

              if ((move_uploaded_file($file['file']["tmp_name"], $file_destination_path)) == false) {
                http_response_code(400);
                return json_encode(['message_warning' => "Sommething went wrong on uploading File"]);
              }
            } else {
              http_response_code(400);
              return json_encode(['message_warning' => "File size too big. Should be less than 10Mb"]);
            }
          } else {
            http_response_code(400);
            return json_encode(['message_warning' => "File Should be 'pdf','png','jpg','jpeg','webp','avif','svg'"]);
          }
        }
      }

      $add_item_query = "INSERT INTO " . self::$table . " 
      (category_id, name, title, slug, logo, data_content, meta_title, file, status) 
      VALUES (:category_id, :name, :title, :slug, :logo_to_upload, :data_content, :meta_title, :file_to_upload, :status) LIMIT 1";

      $stmt = self::$pdo->prepare($add_item_query);

      $stmt->bindValue(':category_id', $data['category_id']);
      $stmt->bindValue(':name', $data['name']);
      $stmt->bindValue(':title', $data['title']);
      $stmt->bindValue(':slug', $data['slug']);
      $stmt->bindValue(':logo_to_upload', $logo_to_upload);
      $stmt->bindValue(':data_content', $data['data_content']);
      $stmt->bindValue(':meta_title', $data['meta_title']);
      $stmt->bindValue(':file_to_upload', $file_to_upload);
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

  public static function updateOne($data, $file)
  {
    self::initConnection();

    $cotent_data = json_decode($data['data_content']);

    if (!trim($data['name'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the item name']);
    } elseif (!trim($data['category_id'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the item category']);
    } elseif (!trim($data['title'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the item title']);
    } elseif (!trim($data['slug'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the slug of the item']);
    } elseif (!trim($data['meta_title'])) {
      http_response_code(400);
      return json_encode(['message_warning' => 'Please enter the item meta-title']);
    } elseif (!trim($cotent_data[0]->title)) {
      http_response_code(400);
      return json_encode(['message_warning' => 'The item need 1+ subtitle']);
    } elseif (!trim($cotent_data[0]->description)) {
      http_response_code(400);
      return json_encode(['message_warning' => 'The item need 1+ description']);
    } else {

      // Check logo status
      $logo_to_upload = $data['logo_old_name'];
      if (isset($file['logo'])) {
        if ($file['logo']['name'] != null || $file['logo']['name'] != '') {
          $logo_extention = pathinfo($file['logo']['name'], PATHINFO_EXTENSION);

          if (in_array($logo_extention, self::$logo_allowed_files)) {
            if ($file['logo']['size'] <= self::$logo_max_size) {
              $time = time();
              $logo_to_upload = $time . $file['logo']['name'];
              $logo_destination_path = self::$upload_item_path . $logo_to_upload;
            } else {
              http_response_code(400);
              return json_encode(['message_warning' => "Logo size too big. Should be less than 1Mb"]);
            }
          } else {
            http_response_code(400);
            return json_encode(['message_warning' => "Logo Should be 'png','jpg','jpeg','webp','avif','svg'"]);
          }
        }
      }

      // Check file status
      $file_to_upload = $data['file_old_name'];
      if (isset($file['file'])) {
        if ($file['file']['name'] != null || $file['file']['name'] != '') {
          $file_extention = pathinfo($file['file']['name'], PATHINFO_EXTENSION);

          if (in_array($file_extention, self::$file_allowed_files)) {
            if ($file['file']['size'] <= self::$file_max_size) {
              $time = time();
              $file_to_upload = $time . $file['file']['name'];
              $file_destination_path = self::$upload_file_path . $file_to_upload;
            } else {
              http_response_code(400);
              return json_encode(['message_warning' => "File size too big. Should be less than 10Mb"]);
            }
          } else {
            http_response_code(400);
            return json_encode(['message_warning' => "File Should be 'pdf','png','jpg','jpeg','webp','avif','svg'"]);
          }
        }
      }

      $update_item_query = "UPDATE " . self::$table . " SET category_id = :category_id, name = :name, title = :title, slug = :slug, logo = :logo_to_upload, data_content = :data_content, meta_title = :meta_title, file = :file_to_upload, status = :status WHERE id = :id LIMIT 1";

      $stmt = self::$pdo->prepare($update_item_query);

      $stmt->bindValue(':category_id', $data['category_id']);
      $stmt->bindValue(':name', $data['name']);
      $stmt->bindValue(':title', $data['title']);
      $stmt->bindValue(':slug', $data['slug']);
      $stmt->bindValue(':logo_to_upload', $logo_to_upload);
      $stmt->bindValue(':data_content', $data['data_content']);
      $stmt->bindValue(':meta_title', $data['meta_title']);
      $stmt->bindValue(':file_to_upload', $file_to_upload);
      $stmt->bindValue(':status', $data['status']);
      $stmt->bindValue(':id', $data['update_item_id']);
      $success = $stmt->execute();

      if ($success) {
        // Unlink old logo
        if (isset($file['logo'])) {
          if ($file['logo']['name'] != null || $file['logo']['name'] != '') {
            $logo_old_destination_path = self::$upload_item_path . $data['logo_old_name'];

            if (file_exists($logo_old_destination_path)) {
              unlink($logo_old_destination_path);
            }

            if ((move_uploaded_file($file['logo']["tmp_name"], $logo_destination_path)) == false) {
              http_response_code(400);
              return json_encode(['message_warning' => "Sommething went wrong on uploading Logo"]);
            }
          }
        }

        // Unlink old file
        if (isset($file['file'])) {
          if ($file['file']['name'] != null || $file['file']['name'] != '') {
            $file_old_destination_path = self::$upload_file_path . $data['file_old_name'];

            if (file_exists($file_old_destination_path)) {
              unlink($file_old_destination_path);
            }

            if ((move_uploaded_file($file['file']["tmp_name"], $file_destination_path)) == false) {
              http_response_code(400);
              return json_encode(['message_warning' => "Sommething went wrong on uploading File"]);
            }
          }
        }

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

    $delete_item_query = "DELETE FROM " . self::$table . " WHERE id = :id LIMIT 1";
    $stmt = self::$pdo->prepare($delete_item_query);
    $stmt->bindValue(':id', $data['delete_item_id']);
    $success = $stmt->execute();

    if ($success) {
      // Unlink logo
      $logo_old_destination_path = self::$upload_item_path . $data['logo'];
      if (file_exists($logo_old_destination_path)) {
        unlink($logo_old_destination_path);
      }

      // Unlink file
      $file_old_destination_path = self::$upload_file_path . $data['file'];
      if (file_exists($file_old_destination_path)) {
        unlink($file_old_destination_path);
      }

      http_response_code(200);
      return json_encode(['message_success' => 'Item deleted successfully']);
    } else {
      throw new Exception('Sommething went wrong');
    }
  }
}
