<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>E-learning @ l'EST de Fes</title>
  <!-- Google font Link(Poppins) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <!-- Google font Link(Poppins) -->

  <!-- Page Links -->
  <link rel="stylesheet" href="./assets/css/index.css">
  <!-- <script defer src="./assets/js/global.js"></script> -->
  <script defer src="./assets/js/index.js"></script>
  <!-- Page Links -->

  <!-- Fontawesome Link -->
  <script src="./assets/js/fontawesome.js"></script>
  <!-- <script src="https://kit.fontawesome.com/4b7f7e3635.js" crossorigin="anonymous"></script> -->
  <!-- Fontawesome Link -->

  <!-- Axios Link -->
  <script src="./assets/js/axios.min.js"></script>
  <!-- Axios Link -->

  <!-- Toaster Link -->
    <link href="./assets/css/toastr.min.css" rel="stylesheet" />
    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/toastr.min.js"></script>
  <!-- Toaster Link -->
  
  <!-- EmailJs Link -->
    <script src="./assets/js/email.min.js"></script>
  <!-- EmailJs Link -->
</head>
<body class="body">
  <!-- Header start -->
  <header class="wrapper" id="wrapperElearn">
    <div class="logo">
      <img src="./assets/img/est_logo.jpeg" alt="est_logo">
    </div>
    <div class="exit">
      <form id="logoutForm">
        <button 
          type="submit" 
          name="logout_btn" 
          class="flex gap-1 p-1 pr-16 rounded-md group"
        >
          <img src="./assets/img/logout.png" alt="logout">
        </button>
      </form> 
    </div>
  </header>
  <!-- Header end -->

  <!-- Main start -->
  <main class="main" id="mainElearn">
    <!-- Section start -->
    <a href="#eLearn" class="ancar"><i class="fa-solid fa-angle-down fa-rotate-180"></i></a>