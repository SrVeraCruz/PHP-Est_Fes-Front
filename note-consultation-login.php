<?php
  require_once 'includes/headerMixed.php';
?>

  <section class="consultation login" id="consultationNote">
    <div class="boxContainer">
      <div class="box">
        <div class="head">Connexion à votre espace</div>
        <div class="body">
          <h3>Accédez à votre resultat via votre compte académique</h3>
          <form id="noteConsultationLoginForm">
            <div class="box-inputs">
              <label>Email:</label>
              <input 
                type="email" 
                name="email" 
                autocomplete="username"
              />
            </div>
            <div class="box-inputs">
              <label>Password:</label>
              <input 
                type="password" 
                name="password" 
                autocomplete="current-password"
              >
            </div>
            <button type="submit" class="btn">Connexion</button>
          </form>
        </div>
      </div>
      <div class="box">
        <h2>
          <i class="fa-regular fa-circle-question"></i>
          <span>Support</span>
        </h2>
        <p>Pour toute assistance veuillez contacter le support en fournissant une description détaillée du problème.</p>
        <a href="mailto: est.usmba.fes@gmail.com">est.usmba.fes@gmail.com</a>
      </div>
    </div>
  </section>

<?php
  require_once 'includes/footerMixed.php';
?>