  </main>
  <!-- Main end -->

  <!-- Footer start -->
  <footer>
    <div class="boxContainer">
      <div class="content">

        <div class="box">
          <div class="boxImg">
            <img src="./assets/img/est_logo_mobile3.png" alt="est_logo">
          </div>
          <p>Ecole Supérieure de Technologie Fès</p>
          <p>BP: 2427</p>
          <p>Route d'Imouzzer</p>
          <p>30000</p>
          <p>Fès - Maroc</p>
          <p>Campus Universitaire</p>
          <p>Tel : +212 5 35 60 05 84</p>
          <p>Fax : +212 5 35 60 05 88</p>
          <a href="mailto:est.usmba.fes@gmail.com">E-mail : est.usmba.fes@gmail.com</a>
        </div>

        <div class="box">
          <h3>Liens rapides</h3>
          <ul>
            <li><a href="#">Diplôme Universitaire de Technologies</a></li>
            <li><a href="#">Licence Profissionnelle</a></li>
            <li><a href="#">Formations Continues</a></li>
            <li><a href="#">Espace Numerique De Travail</a></li>
          </ul>
        </div>

        <div class="box">
          <h3>Autres liens</h3>
          <ul>
            <li><a href="#">nous facebook</a></li>
            <li><a href="#">nous instagram</a></li>
            <li><a href="#">actualité</a></li>
            <li><a href="#">newsletter</a></li>
          </ul>
        </div>

        <div class="box">
          <h3>Suive nous</h3>
          <ul>
            <li><a href="#">facebook</a></li>
            <li><a href="#">instagram</a></li>
            <li><a href="#">twitter</a></li>
            <li><a href="#">youTube</a></li>
          </ul>
        </div>

      </div>
      <div class="content">
        <p>Université Sidi Mohamed Ben Abdellah - Ecole Superieure de Technologie Fès</p>
        <p>&copy; Copyright <span id="current_copy_year">2024</span> all rights reserved | <span>Vera Cruz Dúdú</span></p>
      </div>
    </div>
  </footer>
  <!-- Footer end -->

  <script>
    const current_year = new Date().getFullYear()
    document.getElementById("current_copy_year").innerText = current_year
  </script>

  <!-- Toaster -->
  <script>
    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
      "positionClass": "toast-top-right",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
  </script>
  <!-- Toaster -->

  </body>

  </html>