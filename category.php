<?php
require 'includes/header.php';
require 'includes/global-variables.php';
?>

<section class="section">
  <?php
  if (isset($_GET['title'])) {
    $title = $_GET['title'];
    $category_query = "SELECT id,title FROM categories WHERE slug = '$title' LIMIT 1";
    $category_result = mysqli_query($con, $category_query);

    if (mysqli_num_rows($category_result) > 0) {
      $category_data = mysqli_fetch_assoc($category_result);
  ?>
      <div class="headline">
        <h1><?= $category_data['title'] ?></h1>
      </div>
      <h1>EST-Fes <i class="fa-solid fa-graduation-cap"></i></h1>
      <div class="box-container">

        <?php
        $item_query = "SELECT name,title,logo,slug FROM items WHERE category_id = '$category_data[id]' AND status != '2'";
        $item_result = mysqli_query($con, $item_query);

        if (mysqli_num_rows($item_result) > 0) {
          foreach ($item_result as $item) {
        ?>
            <div class="box">
              <img src="<?= $file_path . 'items/' . $item['logo'] ?>" alt="<?= $item['title'] ?>">
              <div class="content-Box">
                <h3><?= $item['name'] ?></h3>
                <a href="item.php?title=<?= $item['slug'] ?>"><?= $item['title'] ?> <i class="fa-solid fa-location-arrow"></i></a>
              </div>
            </div>
        <?php
          }
        }
        ?>

        <?php
        $sub_cat_query = "SELECT name,title,logo,slug FROM categories WHERE parent_category_id = '$category_data[id]' AND status != '2'";
        $sub_cat_result = mysqli_query($con, $sub_cat_query);

        if (mysqli_num_rows($sub_cat_result) > 0) {
          foreach ($sub_cat_result as $sub_cat) {
        ?>
            <div class="box">
              <img src="<?= $file_path . 'categories/' . $sub_cat['logo'] ?>" alt="<?= $sub_cat['title'] ?>">
              <div class="content-Box">
                <h3><?= $sub_cat['name'] ?></h3>
                <a href="#"><?= $sub_cat['title'] ?> <i class="fa-solid fa-location-arrow"></i></a>
              </div>
            </div>
        <?php
          }
        }
        echo '</div>';
      } else {
        ?>
        <div class="headline">
          <h1>Error...</h1>
        </div>
        <h1>Sorry no such data...</h1>
      <?php
      }
    } else {
      ?>
      <div class="headline">
        <h1>Error...</h1>
      </div>
      <h1>Sorry invalid title...</h1>
    <?php
    }
    ?>
</section>
<!-- Section Espace Etudiant end -->

<?php
require 'includes/footer.php'
?>