<?php 

  $host = 'localhost';
  $username = 'root';
  $password = '';
  $database = 'est_fes';

  $con = mysqli_connect($host,$username,$password,$database);

  if(!$con) {
    header('Location: ../error/error.php');
    exit();
  }

?>