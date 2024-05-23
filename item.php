<?php
include('includes/header.php');
require 'includes/global-variables.php';
?>

<!-- Section Filiere start -->
<section class="section section-mixins">
  <?php
  if (isset($_GET['title'])) {
    $title = $_GET['title'];
    $item_query = "SELECT it.*, c.id AS cid, c.title AS ctitle, c.parent_category_id AS cparent_id FROM items it INNER JOIN categories c ON it.category_id = c.id WHERE it.slug = '$title' LIMIT 1";
    $item_result = mysqli_query($con, $item_query);

    if (mysqli_num_rows($item_result) > 0) {
      $item_data = mysqli_fetch_assoc($item_result);
      $item_content = json_decode($item_data['data_content']) ?? null;
  ?>
      <div class="headline">
        <h1><?= $item_data['ctitle'] ?></h1>
        <h2><?= $item_data['title'] ?></h2>
      </div>
      <div class="boxContainer">
        <?php
        foreach ($item_content as $i_content) {
        ?>
          <div class="box">
            <div class="titre-container">
              <h2><?= $i_content->title ?></h2>
            </div>
            <div class="box-content">
              <?= $i_content->description ?>
            </div>
          </div>

        <?php
        }
        ?>
        <?php if ($item_data['file'] != '' || $item_data['file'] != null) : ?>
          <div class="box">
            <div class="titre-container">
              <h2>Plus info</h2>
            </div>
            <div class="box-info">
              <a href="<?= $file_path . 'files/' . $item_data['file'] ?>" download="<?= substr($item_data['file'], 10) ?>" class="btn">Telecharger fichier <i class="fa fa-angle-right"></i></a>
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