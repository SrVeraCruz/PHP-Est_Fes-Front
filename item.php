<?php
include('includes/header.php');

$file_path = '../admin_est-usmba.ac.ma/uploads/files/'
?>

<!-- Section Filiere start -->
<section class="section section-mixins">
  <?php
  if (isset($_GET['title'])) {
    $title = $_GET['title'];
    $filier_query = "SELECT it.*, c.id AS cid, c.name AS cname, c.parent_category_id AS cparent_id FROM items it INNER JOIN categories c ON it.category_id = c.id WHERE slug = '$title' LIMIT 1";
    $filier_result = mysqli_query($con, $filier_query);

    if (mysqli_num_rows($filier_result) > 0) {
      $filier_data = mysqli_fetch_assoc($filier_result);
      $filier_content = json_decode($filier_data['data_content']) ?? null;
  ?>
      <div class="headline">
        <?php if ($filier_data['cparent_id'] == '0') : ?>
          <h1><?= $filier_data['cname'] ?></h1>
        <?php else : ?>
          <?php
          $fparent_cat_query = "SELECT pc2.name AS pcname FROM categories pc LEFT JOIN categories pc2 ON pc.parent_category_id = pc2.id WHERE pc.id = '$filier_data[cid]' LIMIT 1";
          $fparent_cat_result = mysqli_query($con, $fparent_cat_query);

          if (mysqli_num_rows($filier_result) > 0) {
            $fparent_cat_data = mysqli_fetch_assoc($fparent_cat_result);
          ?>
            <h1><?= $fparent_cat_data['pcname'] ?></h1>
          <?php
          } else {
          ?>
            <h1>Category</h1>
          <?php
          }
          ?>
        <?php endif ?>
        <h2><?= $filier_data['title'] ?></h2>
      </div>
      <div class="boxContainer">
        <?php
        foreach ($filier_content as $f_content) {
        ?>
          <div class="box">
            <div class="titre-container">
              <h2><?= $f_content->title ?></h2>
            </div>
            <div class="box-content">
              <?= $f_content->description ?>
            </div>
          </div>

        <?php
        }
        ?>
        <?php if ($filier_data['file'] != '' || $filier_data['file'] != null) : ?>
          <div class="box">
            <div class="titre-container">
              <h2>Plus info</h2>
            </div>
            <div class="box-info">
              <a href="<?= $file_path . $filier_data['file'] ?>" download="<?= substr($filier_data['file'], 10) ?>" class="btn">Telecharger fichier <i class="fa fa-angle-right"></i></a>
            </div>
          </div>
        <?php endif ?>
      </div>
</section>
<!-- Section Filiere end -->
<?php
    } else {
?>
  <div class="headline">
    <h1>Error...</h1>
    <h2>Sorry no such data...</h2>
  </div>
<?php
    }
  } else {
?>
<div class="headline">
  <h1>Error...</h1>
  <h2>Sorry invalid title...</h2>
</div>

<?php
  }
?>

<?php

include('includes/footer.php')

?>