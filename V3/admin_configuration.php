<?php
        session_start();
        if(!isset($_SESSION['login']) && !isset($_SESSION['role'])){
            header("Location:session.php");
        }

 ?>

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



  <title>Administration Configuration de l'Exposition</title>

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

<?php


    $mysqli = new mysqli('localhost','zmenouch0','b7h5scjf','zfl2-zmenouch0');        # connexion à la base de données

    if ($mysqli->connect_errno)
    {
        echo "Error: Probl�me de connexion � la BDD \n";
        echo "Errno: " . $mysqli->connect_errno . "\n";
        echo "Error: " . $mysqli->connect_error . "\n";
        exit();
    }

    if (!$mysqli->set_charset("utf8")) {
     printf("Pb de chargement du jeu de car. utf8 : %s\n", $mysqli->error);
     exit();
    }

    echo ("<center>");
    echo('<h1>Administration</h1>');                                                 # menu de l'espace d'administration
    echo("<a href='./admin_accueil.php' title=''>Accueil et Profils</a>");
    echo("|    |");
    echo("<a href='./admin_actualite.php' title=''>Gestion des actualites</a>");
    echo("|    |");
    echo("<a href='./admin_exposant.php' title=''>Gestion des exposants</a>");
    echo("|    |");
    echo("<a href='./admin_oeuvre.php' title=''>Gestion des oeuvres</a>");
    echo("|    |");
    echo("<a href='./admin_visiteurs.php' title=''>Gestion des tickets visiteurs</a>");
    echo("|    |");
    echo("<a href='./admin_configuration.php' title=''>Gestion de la configuration</a>");
    echo("|    |");
    echo("<a href='./deconnexion.php' title=''>Deconnexion</a>");
    echo "<br />";
    echo "<br />";
    
    
      echo "<h2>Gestion de la configuration de l'Exposition</h2>";
      $sql="SELECT * FROM t_configuration_cfg";                     # on sélectionne toutes les colonnes de la table de la configuration de l'exposition
      $resultat = $mysqli->query($sql);
      if ($resultat == false){
        echo "Error: La requete a echoue \n";
        echo "Errno: " . $mysqli->errno . "\n";
        exit();
      }else{
        echo("<table>");
          echo("<tr>");
            echo ("<strong>");
            echo("<td> <strong> Intitule </strong> </td>");
            echo("<td> <strong> Date de debut </strong> </td>");
            echo("<td> <strong> Date de fin </strong> </td>");
            echo("<td> <strong> Presentation </strong> </td>");
            echo("<td> <strong> Lieu </strong> </td>");
            echo("<td> <strong> Date de vernissage </strong> </td>");
            echo("<td> <strong> Texte de bienvenue </strong> </td>");
            echo ("</strong>");
          echo("</tr>");
          while($actu = $resultat->fetch_assoc()){
            echo("<tr>");
              echo("<td>" .$actu['cfg_intitule'] ."</td>");
              echo("<td>" .$actu['cfg_date_deb'] ."</td>");
              echo("<td>" .$actu['cfg_date_fin'] ."</td>");
              echo("<td>" .$actu['cfg_presentation'] ."</td>");
              echo("<td>" .$actu['cfg_lieu'] ."</td>");
              echo("<td>" .$actu['cfg_date_vernissage'] ."</td>");
              echo("<td>" .$actu['cfg_texte_bienvenue'] ."</td>");
            echo("</tr>");   
          }
        echo("</table>");
      }
      echo "<br />";
      echo("<a href='./modif_configuration.php' title=''>Modifier la configuration de l'exposition</a>");
      echo "</center>";

  
      $mysqli->close();             # déconnexion de la base de données 

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