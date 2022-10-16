<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="IE=edge" http-equiv="X-UA-Compatible">
  <meta content="width=device-width,initial-scale=1" name="viewport">
  <meta content="description" name="description">
  <meta name="google" content="notranslate" />
  <meta content="Mashup templates have been developped by Orson.io team" name="author">
  <meta name="msapplication-tap-highlight" content="no">

  <link href="./assets/apple-icon-180x180.png" rel="apple-touch-icon">
  <link href="./assets/favicon.ico" rel="icon">



  <title>Galerie</title>

<link href="./main.82cfd66e.css" rel="stylesheet">
<style type="text/css">
    .grid-item{
        display: inline-block;
        padding: 5px;
    }
</style>
</head>

<body>

<header class="">
  <div class="navbar navbar-default visible-xs">
    <button type="button" class="navbar-toggle collapsed">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a href="./index.html" class="navbar-brand">Mashup Template</a>
  </div>

  <nav class="sidebar">
    <div class="navbar-collapse" id="navbar-collapse">
      <div class="site-header hidden-xs">
            <img class="img-responsive site-logo" alt="" src="./images/logo.png">
        </br>
        </br>
      </div>
      <ul class="nav">
        <li><a href="./index.php" title="">Accueil</a></li>
        <li><a href="./galerie1.php" title="">Galerie</a></li>
        <li><a href="./AglaeBory.php" title="">Aglae Bory</a></li>
        <li><a href="./livredor.php" title="">Livre d'or</a></li>
        <li><a href="./session.php" title="">Connexion</a></li>
      </ul>

     <nav class="nav-footer">
        <p class="nav-footer-social-buttons">
          <a class="fa-icon" href="https://www.le-vallon.fr/" title="">
            <i class="fa fa-dribbble"></i>
          </a>
          <a class="fa-icon" href="https://twitter.com/CLandivisiau" title="">
            <i class="fa fa-twitter"></i>
          </a>
      </nav>
    </div>
  </nav>
</header>
<main class="" id="main-collapse">


<?php

    $mysqli = new mysqli('localhost','zmenouch0','b7h5scjf','zfl2-zmenouch0');          # connexion à la base de données

    if ($mysqli->connect_errno){
        echo "Error: Probl�me de connexion � la BDD \n";
        echo "Errno: " . $mysqli->connect_errno . "\n";
        echo "Error: " . $mysqli->connect_error . "\n";
        exit();
    }

    if (!$mysqli->set_charset("utf8")) {
        printf("Pb de chargement du jeu de car. utf8 : %s\n", $mysqli->error);
        exit();
    }

    $requete="SELECT oeu_code,oeu_intitule,oeu_date,oeu_image FROM t_oeuvre_oeu";         # on sélectionne le code, l'intitule, la date et l'image de toutes les oeuvres
    $result1 = $mysqli->query($requete);
    if ($result1 == false){
      echo "Error: La requete a echoue \n";
      echo "Errno: " . $mysqli->errno . "\n";
      exit();
    }else{
      if($result1->num_rows==0){
          echo('<h3><center>Aucune oeuvre pour le moment.</center></h3>');
      }else{
          echo("<div class='hero-full-wrapper'>");
          echo('<div class="grid">');
              echo('<div class="gutter-sizer"></div>');
                  echo('<div class="grid-sizer"></div>');

          while ($actu = $result1->fetch_assoc()){
              echo('<div class="grid-item">');
                  echo('<img class="img-responsive" alt="" src="./images/'.$actu['oeu_image'].'">');
                      echo('<a href="./oeuvre.php?id='.$actu['oeu_code'].'" class="project-description">');
                          echo('<div class="project-text-holder">');
                              echo('<div class="project-text-inner">');
                                  echo('<h3>'.$actu['oeu_intitule'] .'</h3>');
                                      echo('<h5>'.$actu['oeu_date'] .'</h5>');
                              echo('</div>');
                          echo('</div>');
                      echo('</a>');
              echo('</div>');
          }
                          echo('</div>');
                      echo('</div>');
                  echo('</div>');
              echo('</div>');
      }
    }

    $mysqli->close();            # déconnexion de la base de données

 ?>

</main>

<script>
document.addEventListener("DOMContentLoaded", function (event) {
  navbarToggleSidebar();
  navActivePage();
});
</script>
<script type="text/javascript" src="./main.85741bff.js"></script></body>

</html>
