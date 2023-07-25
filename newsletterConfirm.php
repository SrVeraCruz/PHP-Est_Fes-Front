<?php 
  session_start();

  if((isset($_POST['submit'])) && ($_POST['inputEmail']) != '') {
    $email = $_POST['inputEmail'];

    include_once('./config.php');

    $sqlUsers = "SELECT * FROM users WHERE emailEt = '$email'";

    $resultUsers = $conection->query($sqlUsers);

    // print_r($result);

    if(mysqli_num_rows($resultUsers) < 1) {
      $_SESSION['emailNoValid'] = $email;
            
      unset($_SESSION['email']);

      header('Location: newsletterCntDenied.php');
    } else {
      $_SESSION['email'] = $email;

      unset($_SESSION['emailNoValid']);

      $resultNewsletter = mysqli_query($conection, "INSERT INTO newsletter(emailNl)
      VALUES ('$email')");

      // $msg = "Votre inscription dans Nwesletter de l'Est de Fes a été bien efectué. Bientôt vous allez recevoir des nouvelles.";
      // $subject = "Newsletter";
      // $headers = "From: veracruzdudu@gmail.com" . "\r\n";
      
      // mail("duduveracruz1@gmail.com",$subject,$msg, $headers);

      header('Location: newsletterCntAllowed.php');
    }

  } else {
    header('Location: index.php');
  }
?>