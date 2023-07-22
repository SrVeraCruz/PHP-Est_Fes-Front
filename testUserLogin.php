<?php

  session_start();
  // print_r($_REQUEST);

  if(isset($_POST['submit']) && $_POST['inputEmail'] != '' && $_POST['inputPassword'] != '') {
    //access system e-learning
    include_once('./config.php');

    $email = $_POST['inputEmail'];
    $password = $_POST['inputPassword'];

    // print_r('Email: ' . $email);
    // print_r('<br>');
    // print_r('Password: ' . $password);

    $sql = "SELECT * FROM users WHERE emailET = '$email' AND passwordEt = '$password'";

    $result = $conection->query($sql);

    // print_r($result);

    if(mysqli_num_rows($result) < 1){
      //no registre in dataBase
      unset($_SESSION['email']);
      unset($_SESSION['password']);
      header('Location: ElearningLogin.php');

    } else {
      //rediret to system
      header('Location: systemElearning.php');
      $_SESSION['email'] = $email;
      $_SESSION['password'] = $password;
    }

  } else {
    //redirect to Login page
    header('Location: ElearningLogin.php');
  }
?>