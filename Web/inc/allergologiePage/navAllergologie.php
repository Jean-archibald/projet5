<!-- Static navbar -->
  <div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        <a class="navbar-brand" href="accueil">Blog Santé</a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="accueil">Accueil</a></li>
          <li><a href="medecinegenerale">Medecine generale</a></li>
          <li><a href="nutrition" class="smoothscroll">Nutrition</a></li>
          <li class="active"><a href="allergologie" class="smoothscroll">Allergologie</a></li>
          <li><a href="divers" class="smoothscroll">Divers</a></li>
          <li><a href="sessiondestroy" class="smoothscroll">Se deconnecter</a></li>
          <?php
            if (isset($_SESSION['status']) && ($_SESSION['status']) == 'administrateur')
            {
          ?>
          <li><a href="admin" class="smoothscroll">Administration</a></li> 
          <?php
            }
          ?>
           <li><a href="rechercher-1" class="smoothscroll">Rechercher</a></li>
        </ul>
      </div>
      <!--/.nav-collapse -->
    </div>
  </div>


  