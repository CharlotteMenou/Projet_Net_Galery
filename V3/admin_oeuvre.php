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



  <title>Administration Oeuvre</title>

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
    
    
      
      $sql="SELECT * FROM t_oeuvre_oeu";              # on sélectionne toutes les colonnes de la table des oeuvres
      $resultat = $mysqli->query($sql);
      if ($resultat == false){
        echo "Error: La requete a echoue \n";
        echo "Errno: " . $mysqli->errno . "\n";
        exit();
      }else{
        echo "<h2>Gestion des Oeuvres</h2>";
        echo("<table>");
          echo("<tr>");
            echo ("<strong>");
            echo("<td> <strong> Identifiant </strong> </td>");
            echo("<td> <strong> Intitule </strong> </td>");
            echo("<td> <strong> Date  </strong> </td>");
            echo("<td> <strong> Image </strong> </td>");
            echo ("</strong>");
          echo("</tr>");
          while($actu = $resultat->fetch_assoc()){
            echo("<tr>");
              echo("<td>" .$actu['oeu_code'] ."</td>");
              echo("<td>" .$actu['oeu_intitule'] ."</td>");
              echo("<td>" .$actu['oeu_date'] ."</td>");
              echo("<td>" .$actu['oeu_image'] ."</td>");
            echo("</tr>");   
          }
        echo("</table>");
        echo "<br />";
        echo "<br />";
        echo "<br />";
      }
      echo "</center>";

    $sql2="SELECT oeu_code FROM t_oeuvre_oeu";             # on sélectionne le code des oeuvres dans la table des oeuvres
    $resultat2 = $mysqli->query($sql2);
    if ($resultat2 == false){
      echo "Error: La requete a echoue \n";
      echo "Errno: " . $mysqli->errno . "\n";
      exit();
    }else{
      echo "<h2>Supprimer une Oeuvre</h2>";
       echo('<form action="suppr_oeuvre_action.php" method="post">');
          echo('<select name="numero">');
          while($actu = $resultat2->fetch_assoc()){
            echo('<option >'.$actu['oeu_code'].'</option>');
          }
          echo('</select>');
          echo('<button type="submit" class="btn btn-primary btn-lg">Supprimer</button>');
        echo('</form>');
    }
  
    $mysqli->close();             # déconnexion de la base de données  

?>

<br>
<h2>Ajouter une oeuvre</h2>
<div class="section-container-spacer">
       <form action="new_oeuvre_action.php" method="post">
          <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <input type="text" class="form-control" name="exposant" placeholder="identifient de l'exposant">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="intitule" placeholder="Intitule de l'oeuvre">
              </div>
              <h5>Date de l'oeuvre :</h5>
              <div class="form-group">
                <input type="date" class="form-control" name="date" placeholder="Date de l'oeuvre">
              </div>
              <div class="form-group">
                <textarea class="form-control" rows="3" name="description" placeholder="Description de l'oeuvre"></textarea>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="image" placeholder="image">
              </div>
              <button type="submit" class="btn btn-primary btn-lg">Ajouter</button>



</main>

<script>
document.addEventListener("DOMContentLoaded", function (event) {
  navbarToggleSidebar();
  navActivePage();
});
</script>
<script type="text/javascript" src="./main.85741bff.js"></script></body>

</html>