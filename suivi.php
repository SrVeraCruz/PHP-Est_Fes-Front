<?php
include('includes/header.php');
?>

<!-- Section Suivi start -->
<section class="section connexion-style" id="suivi">
  <div class="headline">
    <h1>SUIVI</h1>
  </div>
  <div class="boxContainer">
    <h2>Suivi des lauréats de L'EST Fes</h2>
    <p>
      Soucieuse du devenir de ses lauréats, l'école Supérieure de Technologie de Fès vise à travers ce questionnaire de faire un suivi régulier de ses lauréats
    </p>
    <div class="form-container">
      <div class="steps">
        <div class="step active">
          <i class="fas fa-user"></i>
          <p>Identification</p>
        </div>
        <div class="step">
          <i class="fas fa-graduation-cap"></i>
          <p>Filliere</p>
        </div>
        <div class="step">
          <i class="fas fa-paper-plane"></i>
          <p>Submit</p>
        </div>
      </div>
      <form>
        <div class="form-box active">
          <div class="box-inputs">
            <label for="inputName" name="labelName" id="labelName" class="labelInput">Nom-prenom:</label>
            <input type="text" name="inputName" id="inputName" class="inputUser" placeholder="Ecrire votre nom et prenon" required>
          </div>
          <div class="box-inputs">
            <label for="inputCne" name="labelCne" id="labelCne" class="labelInput">CNE:</label>
            <input type="text" name="inputCne" id="inputCne" class="inputUser" placeholder="Ecrire votre CEN" required>
          </div>
          <div class="box-inputs">
            <label for="inputTel" name="labelTel" id="labelTel" class="labelInput">Tel:</label>
            <input type="text" name="inputTel" id="inputTel" class="inputUser" placeholder="Ecrire votre numero de telephone" required>
          </div>
          <div class="box-inputs">
            <label for="inputEmail" name="labelEmail" id="labelEmail" class="labelInput">Email:</label>
            <input type="text" name="inputEmail" id="inputEmail" class="inputUser" placeholder="Ecrire votre email" required>
          </div>
        </div>
        <div class="form-box" id="radioSection">
          <div class="box-radio-inputs">
            <h4>Genie Mecanique et Productique</h4>
            <input type="radio" name="inputFil" id="inputGMP" value="genie-mecanique-et-productique" required>
            <label for="inputGMP">Construction et Fabrication Mecanique</label>
          </div>
          <div class="box-radio-inputs">
            <h4>Genie Electrique</h4>
            <div for="labelContainer">
              <div class="radio">
                <input type="radio" name="inputFil" id="inputGE_1" value="electronique" required>
                <label for="inputGE_1">Electronique</label>
              </div>
              <div class="radio">
                <input type="radio" name="inputFil" id="inputGE_2" value="electrotechnique" required>
                <label for="inputGE_2">Electrotechnique</label>
              </div>
              <div class="radio">
                <input type="radio" name="inputFil" id="inputGE_3" value="reseaux-et-telecoms" required>
                <label for="inputGE_3">Reseaux et Telecoms</label>
              </div>
            </div>
          </div>
          <div class="box-radio-inputs">
            <h4>Genie des Procedes</h4>
            <div for="labelContainer">
              <div class="radio">
                <input type="radio" name="inputFil" id="inputGP_1" value="industries-chimiques" required>
                <label for="inputGP_1">Industries Chimiques</label>
              </div>
              <div class="radio">
                <input type="radio" name="inputFil" id="inputGP_2" value="biotechnologies" required>
                <label for="inputGP_2">Biotechnologies</label>
              </div>
            </div>
          </div>
          <div class="box-radio-inputs">
            <h4>Maintenance Industrielle</h4>
            <div for="labelContainer">
              <div class="radio">
                <input type="radio" name="inputFil" id="inputMI_1" value="electromecanique" required>
                <label for="inputMI_1">Electromecanique</label>
              </div>
            </div>
          </div>
          <div class="box-radio-inputs">
            <h4>Genie Thermique et Energetique</h4>
            <div for="labelContainer">
              <div class="radio">
                <input type="radio" name="inputFil" id="inputGTE_1" value="genie-thermique-et-energetique" required>
                <label for="inputGTE_1">Genie Thermique et Energetique</label>
              </div>
            </div>
          </div>
          <div class="box-radio-inputs">
            <h4>Informatique</h4>
            <div for="labelContainer">
              <div class="radio">
                <input type="radio" name="inputFil" id="inputI_1" value="administration-des-reseaux-et-syst" required>
                <label for="inputI_1">Administration des Reseaux et Syst</label>
              </div>
              <div class="radio">
                <input type="radio" name="inputFil" id="inputI_2" value="administration-des-bases-de-donnees" required>
                <label for="inputI_2">Administration des Bases de Donnees</label>
              </div>
            </div>
          </div>
          <div class="box-radio-inputs">
            <h4>Techniques de Management</h4>
            <div for="labelContainer">
              <div class="radio">
                <input type="radio" name="inputFil" id="inputTM_1" value="gestion-des-affaires-internationales" required>
                <label for="inputTM_1">Gestion des Affaires Internationales</label>
              </div>
              <div class="radio">
                <input type="radio" name="inputFil" id="inputTM_2" value="administration-du-personnel" required>
                <label for="inputTM_2">Administration du Personnel</label>
              </div>
            </div>
          </div>
          <div class="box-radio-inputs">
            <h4>Techniques de Commercialisation et de Communication</h4>
            <div for="labelContainer">
              <div class="radio">
                <input type="radio" name="inputFil" id="inputTCC_1" value="techniques-de-commercialisation-et-de-communication" required>
                <label for="inputTCC_1">Techniques de Commercialisation et de Communication</label>
              </div>
            </div>
          </div>
          <div class="box-radio-inputs">
            <h4>Techniques de Ventes et Fidelisation de la Clientele</h4>
            <div for="labelContainer">
              <div class="radio">
                <input type="radio" name="inputFil" id="inputTVFC_1" value="techniques-de-ventes-et-fidelisation-de-la-clientele" required>
                <label for="inputTVFC_1">Techniques De Ventes et Fidelisation de la Clientele</label>
              </div>
            </div>
          </div>
          <div class="box-radio-inputs">
            <h4>Vente et Prospection des Marches</h4>
            <div for="labelContainer">
              <div class="radio">
                <input type="radio" name="inputFil" id="inputVPM_1" value="vente-et-prospection-des-marches" required>
                <label for="inputVPM_1">Vente et Prospection des Marches</label>
              </div>
            </div>
          </div>
          <div class="box-radio-inputs">
            <h4>Techniques de Gestion Commerciale</h4>
            <div for="labelContainer">
              <div class="radio">
                <input type="radio" name="inputFil" id="inputTGC_1" value="techniques-de-gestion-commerciale" required>
                <label for="inputTGC_1">Techniques de Gestion Commerciale</label>
              </div>
            </div>
          </div>
        </div>
        <div class="form-box" id="commentSection">
          <h3>Avez-vous des suggestions pour l'amelioration de la formation DUT?</h3>

          <p>Commentaire:</p>
          <textarea name="inputCommentaire" id="inputCommentaire"></textarea>
        </div>
        <div class="box-buttons">
          <button type="button" id="PrevBtn" class="btn"><i class="fa fa-chevron-left"></i> Avant</button>
          <button type="button" id="NextBtn" class="btn">Suivant <i class="fa fa-chevron-right"></i></button>
          <button type="submit" id="SubmitBtn" class="btn">Submit <i class="fas fa-paper-plane"></i></button>
        </div>
      </form>
    </div>
  </div>
</section>
<!-- Section Suivi end -->

<?php
include('includes/footer.php')
?>