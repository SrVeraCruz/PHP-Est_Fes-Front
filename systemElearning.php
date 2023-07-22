<?php 
  session_start();

  if((isset($_SESSION['email']) == false) && (isset($_SESSION['password']) == false)) {
    unset($_SESSION['email']);
    unset($_SESSION['password']);
    header('Location: ElearningLogin.php');
    
  } else {
    $etudiant = $_SESSION['email'];
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-learning @ l'EST de Fes</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./css/index.css">
  <script src="https://kit.fontawesome.com/4b7f7e3635.js" crossorigin="anonymous"></script>
</head>
<body class="body">
  <!-- Header start -->
  <header class="wrapper" id="wrapperElearn">
    <div class="logo">
      <img src="./img/est_logo.jpeg" alt="est_logo">
    </div>
    <div class="exit">
      <a href="./sortirSystemELearn.php"><img src="./img/logout.png" alt="logout"></a>
    </div>
  </header>
  <!-- Header end -->

  <!-- Main start -->
  <main class="main" id="mainElearn">
    <!-- Section start -->
    <a href="#eLearn" class="ancar"><i class="fa-solid fa-angle-down fa-rotate-180"></i></a>

    <section class="section  construction" id="eLearn">
      <?php 
        echo "<h1>Bienvenu <span>$etudiant</span></h1>"
      ?>
      <div class="boxContainer">
        <div class="box">
          <h1>Avis</h1>
          <h2>Nous rencontrons des problèmes, veuillez réessayer plus tard...</h2>
          <img src="./img/construction.webp" alt="estamos_em_obras" id="probleme">
        </div>
      </div>
    </section>
    <!-- Section start -->
  </main>
  <!-- Main end -->

  <!-- Footer start -->
  <footer id="footerElearn">
    <div class="boxContainer">
      <div class="content"></div>
      <div class="content">
        <p>Université Sidi Mohamed Ben Abdellah - Ecole Superieure de Technologie Fès</p>
        <p>&copy; Copyright 2023 all rights reserved | <span>Vera Cruz Dúdú</span></p>
      </div>
    </div>
  </footer>
  <!-- Footer end -->
</body>
</html>