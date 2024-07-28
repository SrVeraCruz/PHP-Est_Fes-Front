<?php
require_once 'includes/header.php';
?>
  <section class="section connexion-style eLearning" id="eLearRegister">
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
              <label for="inputName" name="labelName" id="labelName" class="labelInput">Nom:</label>
              <input type="text" name="inputName" id="inputName" class="inputUser" placeholder="Entrer votre nom d'utilisateur"
              autocomplete="username" required>
            </div>
            <div class="box-inputs">
              <label for="inputTel" name="labelTel" id="labelTel" class="labelInput">Contact:</label>
              <input type="text" name="inputTel" id="inputTel" class="inputUser" placeholder="Entrer votre numero de telephone"
              required>
            </div>
            <div class="box-inputs">
              <label for="inputEmail" name="labelEmail" id="labelEmail" class="labelInput">Email:</label>
              <input type="text" name="inputEmail" id="inputEmail" class="inputUser" placeholder="Entrer votre email"
              required>
            </div>
            <div class="box-inputs">
              <label for="inputPassword" name="labelPassword" id="labelPassword" class="labelInput">Password:</label>
              <input type="password" name="inputPassword" id="inputPassword" class="inputUser" placeholder="Entrer votre mot de passe"  autocomplete="current-password" required>
            </div>
            <div class="box-inputs naissance">
              <label for="inputDateNas" name="labelDateNas" id="labelDateNas" class="labelInput">Naissance:</label>
              <input type="date" name="inputDateNas" id="inputDateNas" class="inputUser" required>
            </div>
            <p>Sex:</p>
            <div class="radio sex">
              <input type="radio" name="inputSex" id="inputSexM" class="inputUser" value="masculin" required>
              <label for="inputSexM" id="labelSex" class="labelInput">Masculin</label>
            </div>
            <div class="radio sex">
              <input type="radio" name="inputSex" id="inputSexF" class="inputUser" value="feminin" required>
              <label for="inputSexF" id="labelSex" class="labelInput">Feminin</label>
            </div>
          </div>
          
          <div class="box-buttons">
            <input type="submit" name="submit" value="submit" id="eLearnBtn" class="btn">
          </div>

          <a href="./elearning.php" class="registerBtn">Avez-vous a compte? <span>Connecter</span></a>

        </form>
      </div>
    </div>
  </section>
<?php
require_once 'includes/footer.php';
?>