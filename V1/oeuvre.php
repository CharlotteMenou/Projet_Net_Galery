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



  <title>Oeuvre</title>

<link href="./main.82cfd66e.css" rel="stylesheet"></head>

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

    $mysqli = new mysqli('localhost','zmenouch0','b7h5scjf','zfl2-zmenouch0');           # connexion à la base de données

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

    $id=$_GET['id'];

    $reqmin = "SELECT MIN(oeu_code) as min FROM t_oeuvre_oeu";       # on récupère le plus petit code de toutes les oeuvre
    $reqmax = "SELECT MAX(oeu_code) as max FROM t_oeuvre_oeu";       # on récupère le plus grand code de toutes les oeuvre
    $resultmin = $mysqli->query($reqmin);
    $resultmax = $mysqli->query($reqmax);
    if ($resultmin == false){
      echo "Error: La requete a echoue \n";
      echo "Errno: " . $mysqli->errno . "\n";
      exit();
    }else{
      $min = $resultmin->fetch_assoc();
    }
    if ($resultmax == false){
      echo "Error: La requete a echoue \n";
      echo "Errno: " . $mysqli->errno . "\n";
      exit();
    }else{
      $max = $resultmax->fetch_assoc();
    }
    

    if($id<$min["min"] || $id>$max["max"]){
        echo('<h3><center>Oeuvre inexistante.</center></h3>');
    }else{
        $requete2="SELECT exp_nom,exp_prenom FROM t_oeuvre_oeu JOIN t_expose_eps USING(oeu_code) JOIN t_exposant_exp USING(exp_id) WHERE oeu_code=$id";      # on sélectionne le nom et le prénom de tous les exposants d'une oeuvre
        $result2 = $mysqli->query($requete2);
        if ($result2 == false){
          echo "Error: La requete a echoue \n";
          echo "Errno: " . $mysqli->errno . "\n";
          exit();
        }else{
          while ($actu = $result2->fetch_assoc()){
              echo "<center>";
              echo('<h4>'.$actu['exp_nom'].' '.$actu['exp_prenom'].'</h4>');
              echo "</center>";
          }
        }

        $requete="SELECT oeu_intitule,oeu_description,oeu_date,oeu_image FROM t_oeuvre_oeu WHERE oeu_code=$id";         # on sélectionne toutes les informations d'une oeuvre
        $result1 = $mysqli->query($requete);
        if ($resultmax == false){
          echo "Error: La requete a echoue \n";
          echo "Errno: " . $mysqli->errno . "\n";
          exit();
        }else{
          while ($actu = $result1->fetch_assoc()){
              echo "<center>";
              echo('<h2>'.$actu['oeu_intitule'] .'</h2>');
              echo('<h4>'.$actu['oeu_date'] .'</h4>');
              echo "<br />";
              echo('<img class="img-responsive" alt="" src="./images/'.$actu['oeu_image'].'" width=500 height=500>');
              echo "<br />";
              echo('<h5>'.$actu['oeu_description'] .'</h5>');
              echo "<br />";
              echo('<p><a href="./galerie1.php" title="">Galerie</a></p>');
              echo "</center>";
          }
        }
    }


    $mysqli->close();         # déconnexion de la base de données

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
