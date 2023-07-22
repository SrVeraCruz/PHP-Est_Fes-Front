<?php 
  $dbHost = 'Localhost';
  $dbUsername = 'root';
  $dbPassword = '';
  $dbName = 'e_learning_est_fes';

  $conection = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

  // if($conection->connect_errno) {
  //   echo "Error";
  // } else {
  //   echo "Conect";
  // }
?>