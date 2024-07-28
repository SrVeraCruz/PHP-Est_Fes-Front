<?php 
  session_start();

  if(!isset($_SESSION['auth'])) {
    session_unset();
    session_destroy();
    header('Location: elearning-login.php');
    
  } 
  
  $etudiant = $_SESSION['auth_user']['user_email'];
  
?>
<?php
  require_once 'includes/headerElearning.php';
?>

  <section class="section  construction" id="eLearn">
    <div class="boxContainer">
      <div class="box">
        </br>
        <?php
          echo "<h1>Bienvenu <span>$etudiant</span></h1>"
        ?>
        <h2>Page en construction, veuillez revenir plus tard...</h2>
        <img 
          src="./assets/img/construction.webp" 
          alt="estamos_em_obras" 
          id="probleme"
        >
      </div>
    </div>
  </section>

<?php
  require_once 'includes/footerElearning.php';
?>