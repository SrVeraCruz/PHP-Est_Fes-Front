<?php
include('includes/header.php');

$file_path = '../admin_est-usmba.ac.ma/uploads/files/'
?>

<!-- Section Filiere start -->
<section class="section filiere section-mixins">
  <?php
  if (isset($_GET['title'])) {
    $title = $_GET['title'];
    $filier_query = "SELECT * FROM items WHERE slug = '$title' LIMIT 1";
    $filier_result = mysqli_query($con, $filier_query);

    if (mysqli_num_rows($filier_result) > 0) {
      $filier_data = mysqli_fetch_assoc($filier_result);
      $filier_content = json_decode($filier_data['data_content']) ?? null;
  ?>
      <div class="headline">
        <h1>Filiére</h1>
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