<?php 
  session_start();
  if(isset($_SESSION['email']) == false) {
    unset($_SESSION['email']);
    header('Location: index.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Newsletter | l'EST de Fes</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./css/index.css">
  <script defer src="./js/global.js"></script>
  <script src="https://kit.fontawesome.com/4b7f7e3635.js" crossorigin="anonymous"></script>
</head>
<body class="body">
  <!-- Header start -->
  <header class="wrapper">
    <div class="wrapper-box1">
      <div>
        <div><img src="./img/est_logo.jpeg" alt="est_logo"></div>
      </div>
      <div class="nav-bar">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
      </div>
    </div>

    <div class="slideOut"></div>

    <nav class="list">
      <img src="./img/est_logo_mobile.png" class="estLogo" alt="est_logo">
      <i class="fa fa-times"></i>
      <ul>
        <li class="scrollHeader">
          <div class="main_nav">
            <a href="#" class="linkListHover">accueil</a><i class="fa fa-play fa-rotate-90"></i>
            <i class="fa fa-angle-right"></i>
          </div>
          <div class="nav_hover">
            <i class="fa fa-angle-left closeListHover1"></i>
            <ul>
              <li><a href="./index.php">accueil</a></li>
              <li><a href="#">mot du directeur</a></li>
            </ul>
          </div>
        </li>
        <li class="scrollHeader">
          <div class="main_nav">
            <a href="#" class="linkListHover">déppertements</a><i class="fa fa-play fa-rotate-90"></i>
            <i class="fa fa-angle-right"></i>
          </div>
          <div class="nav_hover">
            <i class="fa fa-angle-left closeListHover1"></i>
            <ul>
              <li><a href="./depGmp_mi.php">GMP-MI</a></li>
              <li><a href="./depGei.php">GEI</a></li>
              <li><a href="./depGp.php">GP</a></li>
              <li><a href="./depStg.php">STG</a></li>
            </ul>
          </div>
        </li>
        <li class="scrollHeader">
          <div class="main_nav">
            <a href="#" class="linkListHover">filères</a><i class="fa fa-play fa-rotate-90"></i>
            <i class="fa fa-angle-right"></i>
          </div>
          <div class="nav_hover">
            <i class="fa fa-angle-left closeListHover1"></i>
            <ul>
              <li>
                <div class="children1">
                  <a href="#" class="linkListHover2">DUT</a><i class="fa fa-play"></i>
                  <i class="fa fa-angle-right"></i>
                </div>
                <div class="nav_hover2">
                  <i class="fa fa-angle-left closeListHover2"></i>
                  <ul>
                    <li><a href="./f_dut_GMP.php">Génie Mécanique et Productique</a></li>
                    <li><a href="./f_dut_GE.php">Génie Électrique</a></li>
                    <li><a href="./f_dut_RT.php">Réseaux et Télècommunications</a></li>
                    <li><a href="./f_dut_GP.php">Génie des Procédés</a></li>
                    <li><a href="./f_dut_AGB.php">Agroalimentare et Génie Biológique</a></li>
                    <li><a href="./f_dut_GIM.php">Génie Industiel et Maintenance</a></li>
                    <li><a href="./f_dut_INFO.php">Informatique</a></li>
                    <li><a href="./f_dut_SE.php">Système Embarqués</a></li>
                    <li><a href="./f_dut_ID.php">Informatique Décisionnelle</a></li>
                    <li><a href="./f_dut_GTE.php">Génie Thermique et Energétique</a></li>
                    <li><a href="./f_dut_TM.php">Techniques de Managment</a></li>
                    <li><a href="./f_dut_GRH.php">Gestion de Ressources Humaines</a></li>
                    <li><a href="./f_dut_TGC.php">Techniques de Gestion Commerciale</a></li>
                    <li><a href="./f_dut_GLT.php">Gestion Logistique et Transport</a></li>
                  </ul>
                </div>
              </li>
              <li>
                <div class="children1">
                  <a href="#" class="linkListHover2">LP</a><i class="fa fa-play"></i>
                  <i class="fa fa-angle-right"></i>
                </div>
                <div class="nav_hover2">
                  <i class="fa fa-angle-left closeListHover2"></i>
                  <ul>
                    <li><a href="./f_lp_LOG.php">Logistique</a></li>
                    <li><a href="./f_lp_MEEB.php">Maintenance Electroniques Des Equipements Biomedicaux(MEEB)</a></li>
                    <li><a href="./f_lp_PIM.php">Production Industrielle(PIP/PIM)</a></li>
                    <li><a href="./f_lp_QAGRO.php">Qualité En Agroalimentare(QAGRO)</a></li>
                    <li><a href="./f_lp_TNR.php">Tannerie Et Idustrie Du Cuir</a></li>
                    <li><a href="./f_lp_TEREE.php">Technologies Des Energies Renouvables et de L'Efficacité Energétique(TEREE)</a></li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </li>
        <li class="scrollHeader">
          <div class="main_nav">
            <a href="#" class="linkListHover">formations</a><i class="fa fa-play fa-rotate-90"></i>
            <i class="fa fa-angle-right"></i>
          </div>
          <div class="nav_hover">
            <i class="fa fa-angle-left closeListHover1"></i>
            <ul>
              <li><a href="./format_Pre.php">présentation</a></li>
              <li><a href="./format_FormStage.php">formation et stages</a></li>
              <li><a href="./format_DepFil.php">déppertements et filières</a></li>
              <li><a href="./format_AdmCan.php">admission et candidature</a></li>
              <li><a href="./format_ScOrg.php">scolarité et organisation</a></li>
            </ul>
          </div>
        </li>
        <li class="scrollHeader">
          <div class="main_nav">
            <a href="#" class="linkListHover">recherche Scientifique</a><i class="fa fa-play fa-rotate-90"></i>
            <i class="fa fa-angle-right"></i>
          </div>
          <div class="nav_hover" id="recherche">
            <i class="fa fa-angle-left closeListHover1"></i>
            <ul>
              <li><a href="./404.php">CED STSM</a></li>
              <li><a href="./404.php">CED SJESG</a></li>
              <li>
                <div class="children1">
                  <a href="#" class="linkListHover2">laboratoires de recherche</a><i class="fa fa-play"></i>
                  <i class="fa fa-angle-right"></i>
                </div>
                <div class="nav_hover2">
                  <i class="fa fa-angle-left closeListHover2"></i>
                  <ul>
                    <li><a href="./filieres/lab1.pdf"><p>Laboratoires de Materiaux,</p> <p>Procédés,</p> <p>Catalyse et Environnement</p></a></li>
                    <li><a href="./filieres/lab2.pdf"><p>Laboratoires des</p> <p>Technologies Innovants</p></a></li>
                    <li><a href="./filieres/lab3.pdf"><p>Laboratoires Technologies</p> <p>et Services Industiels</p></a></li>
                  </ul>
                </div>
              </li>
              <li><a href="./recherche_activ.php">les activités de l'ecole</a></li>
            </ul>
          </div>
        </li>
        <li class="scrollHeader">
          <div class="main_nav">
            <a href="#" class="linkListHover">règlement</a><i class="fa fa-play fa-rotate-90"></i>
            <i class="fa fa-angle-right"></i>
          </div>
          <div class="nav_hover" id="reglement">
            <i class="fa fa-angle-left closeListHover1"></i>
            <ul>
              <li><a href="./regle_inter.php">règlement de l'internet</a></li>
              <li><a href="./regle_eval.php">règlement de l'évaluation</a></li>
              <li>
                <div class="children1">
                  <a href="#" class="linkListHover2">cahier des normes DUT</a><i class="fa fa-play"></i>
                  <i class="fa fa-angle-right"></i>
                </div>
                <div class="nav_hover2">
                  <i class="fa fa-angle-left closeListHover2"></i>
                  <ul>
                    <li><a href="./filieres/regle_CNPN_DUT.pdf">CNPN</a></li>
                    <li><a href="./filieres/regle_Desciptif_DUT.pdf">Déscriptif</a></li>
                  </ul>
                </div>
              </li>
              <li>
                <div class="children1">
                  <a href="#" class="linkListHover2">cahier des normes LP</a><i class="fa fa-play"></i>
                  <i class="fa fa-angle-right"></i>
                </div>
                <div class="nav_hover2">
                  <i class="fa fa-angle-left closeListHover2"></i>
                  <ul>
                    <li><a href="./filieres/regle_CNPN_LP.pdf">CNPN</a></li>
                    <li><a href="./404.php">Déscriptif</a></li>
                  </ul>
                </div>
              </li>
              <li>
                <div class="children1">
                  <a href="#" class="linkListHover2">règlement intérieur</a><i class="fa fa-play"></i>
                  <i class="fa fa-angle-right"></i>
                </div>
                <div class="nav_hover2">
                  <i class="fa fa-angle-left closeListHover2"></i>
                  <ul>
                    <li><a href="./filieres/regle_Inter_Univ.pdf">Université</a></li>
                    <li><a href="./filieres/regle_Inter_Ecol.pdf">Ecole</a></li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </li>
        <li class="scrollHeader">
          <div class="main_nav">
            <a href="./suivi.php">suivi des lauréats</a>
          </div>
        </li>
        <li class="scrollHeader">
          <div class="main_nav">
            <a href="./contact.php">contact</a>
          </div>
        </li>
      </ul>
    </nav>
  </header>
  <!-- Header end -->

  <!-- Main start -->
  <main class="main">
    <a href="#newLtAll" class="ancar"><i class="fa-solid fa-angle-down fa-rotate-180"></i></a>
    <!-- Section Newletter -->
    <section class="section newletter" id="newLtAll">
      <div class="headline">
        <h1>Newsletter</h1>
      </div>
      <div class="boxContainer">
        <p>Votre incription a été efectué.</p>
      </div>
    </section>
    <!-- Section Newsletter -->
  </main>
  <!-- Main end -->

  <!-- Footer start -->
  <footer>
    <div class="boxContainer">
      <div class="content">

        <div class="box">
          <div class="boxImg">
            <img src="./img/est_logo_mobile3.png" alt="est_logo">
          </div>
          <p>Ecole Supérieure de Technologie Fès</p>
          <p>BP: 2427</p>
          <p>Route d'Imouzzer</p>
          <p>30000</p>
          <p>Fès - Maroc</p>
          <p>Campus Universitaire</p>
          <p>Tel : +212 5 35 60 05 84</p>
          <p>Fax : +212 5 35 60 05 88</p>
          <a href="mailto:support.est@usmba.ac.ma">E-mail : support.est@usmba.ac.ma</a>
        </div>
        
        <div class="box">
          <h3>Liens rapides</h3>
          <ul>
            <li><a href="./filiere_DUT.php">Diplôme Universitaire de Technologies</a></li>
            <li><a href="./filiere_LP.php">Licence Profissionnelle</a></li>
            <li><a href="./fomation_cont_DU.php">Formations Continues</a></li>
            <li><a href="./esp_et_ENT.php">Espace Numerique De Travail</a></li>
          </ul>
        </div>
        
        <div class="box">
          <h3>Outres liens</h3>
          <ul>
            <li><a href="./404.php">nous facebook</a></li>
            <li><a href="./404.php">nous instagram</a></li>
            <li><a href="./404.php">actualité</a></li>
            <li><a href="./404.php">newsletter</a></li>
          </ul>
        </div>
        
        <div class="box">
          <h3>Suive nous</h3>
          <ul>
            <li><a href="./404.php">facebook</a></li>
            <li><a href="./404.php">instagram</a></li>
            <li><a href="./404.php">twitter</a></li>
            <li><a href="./404.php">youTube</a></li>
          </ul>
        </div>
        
      </div>
      <div class="content">
        <p>Université Sidi Mohamed Ben Abdellah - Ecole Superieure de Technologie Fès</p>
        <p>&copy; Copyright 2023 all rights reserved | <span>Vera Cruz Dúdú</span></p>
      </div>
    </div>
  </footer>
  <!-- Footer end -->
</body>
</html>