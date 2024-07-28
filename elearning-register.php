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
        <form id="eLearningRegisterForm">
          <div class="form-box">
            <div class="box-inputs">
              <label id="labelLname" class="labelInput">Nom:</label>
              <input type="text" name="lname" id="inputLname" class="inputUser" placeholder="Entrer votre nom d'utilisateur"
              autocomplete="username">
            </div>
            <div class="box-inputs">
              <label id="labelFname" class="labelInput">Prenom:</label>
              <input type="text" name="fname" id="inputFname" class="inputUser" placeholder="Entrer votre nom d'utilisateur"
              autocomplete="username">
            </div>
            <div class="box-inputs">
              <label id="labelEmail" class="labelInput">Email:</label>
              <input type="text" name="email" id="inputEmail" class="inputUser" autocomplete="username" placeholder="Entrer votre email"
            >
            </div>
            <div class="box-inputs">
              <label id="labelPassword" class="labelInput">Mot de passe:</label>
              <input type="password" name="password" id="inputPassword" class="inputUser" placeholder="Entrer votre mot de passe"  autocomplete="current-password">
            </div>
            <div class="box-inputs">
              <label id="labelCpassword" class="labelInput">Confirmer mot de passe:</label>
              <input type="password" name="cpassword" id="inputCpassword" class="inputUser" placeholder="Confirmer votre mot de passe"  autocomplete="current-password">
            </div>
            <div class="box-inputs naissance">
              <label id="labelDateNas" class="labelInput">Naissance:</label>
              <input type="date" name="birth" id="inputDateNas" class="inputUser">
            </div>
            <p>Sex:</p>
            <div class="radio sex">
              <input type="radio" name="sex" id="inputSexM" class="inputUser" value="masculin">
              <label id="labelSex" for="inputSexM" class="labelInput">Masculin</label>
            </div>
            <div class="radio sex">
              <input type="radio" name="sex" id="inputSexF" class="inputUser" value="feminin">
              <label id="labelSex" for="inputSexF" class="labelInput">Feminin</label>
            </div>

            <div class="box-inputs avatar">
              <label id="labelAvatar" class="labelInput">Avatar:</label>
              <input type="file" name="avatar" id="inputAvatar" class="inputUser" placeholder="Confirmer votre mot de passe" autocomplete="current-password">
            </div>
          </div>
          
          <div class="box-buttons">
            <input type="submit" name="submit" value="Enregistrer" id="eLearnBtn" class="btn">
          </div>

          <a href="./elearning-login.php" class="registerBtn">Avez-vous a compte? <span>Connecter</span></a>

        </form>
      </div>
    </div>
  </section>
<?php
require_once 'includes/footer.php';
?>