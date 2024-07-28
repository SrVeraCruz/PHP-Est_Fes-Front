<?php
require_once 'includes/header.php';
?>
  <section class="section connexion-style eLearning" id="eLearnLogin">
    <div class="headline">
      <h1>E-Learning</h1>
    </div>
    <div class="boxContainer">
      <h2>Université Sidi Mohamed Ben Abdellah</h2>
      <p>
        Ecole Supérieure de Technologie de Fès
      </p>
      <div class="form-container">
        <div class="steps">
          <div class="step active">
            <i class="fas fa-user"></i>
            <p>Identification</p>
          </div>
        </div>
        <form>
          <div class="form-box">
            <div class="box-inputs">
              <label for="inputEmail" name="labelEmail" id="labelEmail" class="labelInput">Email:</label>
              <input type="email" name="inputEmail" id="inputEmail" class="inputUser" placeholder="Entrer votre email"
              required>
            </div>
            <div class="box-inputs">
              <label for="inputPassword" name="labelPassword" id="labelPassword" class="labelInput">Password:</label>
              <input type="password" name="inputPassword" id="inputPassword" class="inputUser" placeholder="Entrer votre mot de passe"  autocomplete="current-password" required>
            </div>
            <a href="#" class="forgotPass">Mot de passe oublié?</a>
          </div>
          
          <div class="box-buttons">
          <input type="submit" name="submit" value="Connection" id="eLearnBtn" class="btn">
          </div>

          <a href="./elearning-register.php" class="registerBtn">Vous n'avez pas de compte? <span>Enregistrer</span></a>

        </form>
      </div>
    </div>
  </section>
<?php
require_once 'includes/footer.php';
?>