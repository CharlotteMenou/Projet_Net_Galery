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



  <title>Accueil</title>

<link href="./main.82cfd66e.css" rel="stylesheet">
<style type="text/css">
    .grid-item{
        display: inline-block;
        padding: 5px;
    }
    table{
      margin=auto;
      width=50%;
      border-collapse: collapse;
    }
    th,td,tr{
      border: thin solid black;
      padding: 1em;
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

<div>

<?php

  $mysqli = new mysqli('localhost','zmenouch0','b7h5scjf','zfl2-zmenouch0');          #connexion à la base de données

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

  $requete="SELECT * FROM t_configuration_cfg";              # on sélectionne toutes les colonnes de la table configuration
  $result1 = $mysqli->query($requete);
  if ($result1 == false){
    echo "Error: La requete a echoue \n";
    echo "Errno: " . $mysqli->errno . "\n";
    exit();
  }else{
    while ($actu = $result1->fetch_assoc()){
        echo"<center>";
        echo "<h3>";
        echo ($actu['cfg_intitule']);
        echo "</h3>";
        echo "<h4>";
        echo ('Du ' .$actu['cfg_date_deb']. ' au ' .$actu['cfg_date_fin']);
        echo "</h4>";
        echo "<h4>";
        echo ($actu['cfg_lieu']);
        echo "</h4>";
        echo "<br />";
        echo "<h5>";
        echo ($actu['cfg_presentation']);
        echo "</h5>";
        echo "<br />";
        echo "<h5>";
        echo ('Date de vernissage : '.$actu['cfg_date_vernissage']);
        echo "</h5>";
        echo "<br />";
        echo "<h5>";
        echo ($actu['cfg_texte_bienvenue']);
        echo "</h5>";
        echo"</center>";
    }
  }

  $mysqli->close();           # déconnexion de la base de données

?>

  <center>
  <img class="img-responsive" alt="" src="./images/img-index.png">
  <br>
  <br>
  <h2>Actualites</h2></center>

<?php

  $mysqli = new mysqli('localhost','zmenouch0','b7h5scjf','zfl2-zmenouch0');         # connexion à la base de données

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

  $requete="SELECT * FROM t_actualite_act";           # on sélectionne toutes les colonnes de la table des actualités
  $result1 = $mysqli->query($requete);
  if ($result1 == false){
    echo "Error: La requete a echoue \n";
    echo "Errno: " . $mysqli->errno . "\n";
    exit();
  }else{
    echo("<table>");
        echo("<tr>");
            echo ("<strong>");
            echo("<td> <strong> Titre </strong> </td>");
            echo("<td> <strong> Actualite </strong> </td>");
            echo("<td> <strong> Pseudo </strong> </td>");
            echo("<td> <strong> Date </strong> </td>");
            echo ("</strong>");
        echo("</tr>");
        while ($actu = $result1->fetch_assoc()){
            echo("<tr>");
                echo("<td>" .$actu['act_titre'] ."</td>");
                echo("<td>" .$actu['act_text'] ."</td>");
                echo("<td>" .$actu['cpt_pseudo'] ."</td>");
                echo("<td>" .$actu['act_date'] ."</td>");
            echo("</tr>");
        }
    echo("</table>");
  }

  $mysqli->close();        # déconnexion de la base de données

?>

</div>

</main>

<script>
document.addEventListener("DOMContentLoaded", function (event) {
  navbarToggleSidebar();
  navActivePage();
});
</script>
 <script type="text/javascript" src="./main.85741bff.js"></script></body>

</html>
