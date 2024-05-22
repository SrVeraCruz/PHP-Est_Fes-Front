<!-- Header start -->
<header class="wrapper">
  <div class="wrapper-box1">
    <div>
      <div><img src="./assets/img/est_logo.jpeg" alt="est_logo"></div>
    </div>
    <div class="nav-bar">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </div>
  </div>

  <div class="slideOut"></div>

  <nav class="list">
    <img src="./assets/img/est_logo_mobile.png" class="estLogo" alt="est_logo">
    <i class="fa fa-times"></i>
    <ul>
      <li class="scrollHeader">
        <div class="main_nav">
          <a href="#" class="linkListHover">accueil</a><i class="fa fa-play fa-rotate-90"></i>
          <i class="fa fa-angle-right"></i>
        </div>
        <div class="nav_hover">
          <i class="fa fa-angle-left closeListHover1"></i>
          <ul>
            <li><a href="index.php">accueil</a></li>
            <?php
            $motdir_query = "SELECT name,slug 
            FROM items 
            WHERE name = 'Mot du Directeur' 
            AND status = '0' LIMIT 1";
            $motdir_result = mysqli_query($con, $motdir_query);
            if (mysqli_num_rows($motdir_result) > 0) {
              $motdir = mysqli_fetch_assoc($motdir_result);
            ?>
              <li><a href="item.php?title=<?= $motdir['slug'] ?>"><?= $motdir['name'] ?></a></li>
            <?php
            }
            ?>
          </ul>
        </div>
      </li>
      <?php
      $category_query = "SELECT * FROM categories WHERE parent_category_id = '0' AND status != '2' AND navbar_status = '0'";
      $category_result = mysqli_query($con, $category_query);

      if (mysqli_num_rows($category_result)) {
        foreach ($category_result as $category) {
      ?>
          <li class="scrollHeader">
            <div class="main_nav">
              <a href="#" class="linkListHover"><?= $category['name'] ?></a><i class="fa fa-play fa-rotate-90"></i>
              <i class="fa fa-angle-right"></i>
            </div>
            <div class="nav_hover">
              <i class="fa fa-angle-left closeListHover1"></i>
              <ul>
                <?php
                $sub_cat_query = "SELECT * FROM categories WHERE parent_category_id = '$category[id]' AND status != '2' AND navbar_status = '0'";
                $sub_cat_result = mysqli_query($con, $sub_cat_query);

                $item_query = "SELECT name,slug FROM items WHERE category_id = '$category[id]' AND status = '0'";
                $item_result = mysqli_query($con, $item_query);

                if (mysqli_num_rows($item_result)) {
                  foreach ($item_result as $item) {
                ?>
                    <li>
                      <div class="children1">
                        <a href="item.php?title=<?= $item['slug'] ?>"><?= $item['name'] ?></a>
                      </div>
                    </li>
                  <?php
                  }
                }

                if (mysqli_num_rows($sub_cat_result)) {
                  foreach ($sub_cat_result as $sub_cat) {
                  ?>

                    <li>
                      <div class="children1">
                        <a href="#" class="linkListHover2"><?= $sub_cat['name'] ?></a><i class="fa fa-play"></i>
                        <i class="fa fa-angle-right"></i>
                      </div>
                      <div class="nav_hover2">
                        <i class="fa fa-angle-left closeListHover2"></i>
                        <ul>
                          <?php
                          $sub_item_query = "SELECT name,slug FROM items WHERE category_id = '$sub_cat[id]' AND status = '0'";
                          $sub_item_result = mysqli_query($con, $sub_item_query);

                          if (mysqli_num_rows($sub_item_result)) {
                            foreach ($sub_item_result as $sub_item_cat) {
                          ?>
                              <li>
                                <a href="item.php?title=<?= $sub_item_cat['slug'] ?>"><?= $sub_item_cat['name'] ?></a>
                              </li>
                          <?php
                            }
                          }
                          ?>
                        </ul>
                      </div>
                    </li>
                <?php
                  }
                }
                ?>
              </ul>
            </div>
          </li>
      <?php
        }
      }
      ?>
      <li class="scrollHeader">
        <div class="main_nav">
          <a href="./suivi.php">suivi des lauréats</a>
        </div>
      </li>
      <li class="scrollHeader">
        <div class="main_nav">
          <a href="./contact.php">contact</a>
        </div>
      </li>
    </ul>
  </nav>
</header>
<!-- Header end -->