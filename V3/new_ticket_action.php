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



  <title>Administration Visiteurs</title>

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

    $pseudo=$_SESSION['login'];
    $mdp=htmlspecialchars($_POST['mdp']);

    if(strlen($mdp)<15){
        echo "<center>";
        echo "<br />";
        echo "<br />";
        echo "<br />";
        echo "<br />";
        echo "<br />";
        echo "<br />";
        echo "<br />";
        echo "<h4>";
        echo("Le mot de passe doit contenir au minimum 15 characteres, veuillez reessayer.");
        echo "<br />";
        echo "<br />";
        echo("<a href='./admin_visiteurs.php'>Recommencer</a>");
        echo "</h4>";
        echo "</center>";
    }else{
        $sql="INSERT INTO `t_visiteur_vis` (`vis_numero`, `vis_mdp`, `vis_date_heure`, `cpt_pseudo`) VALUES (NULL, MD5('$mdp'), NOW() , '$pseudo');";          # ajout d'un ticket visiteur dans la table des visiteurs
        $resultat = $mysqli->query($sql);
        if ($resultat == false){
            echo "Error: La requete a echoue \n";
            echo "Errno: " . $mysqli->errno . "\n";
        exit();
        }
        header("Location:admin_visiteurs.php");
    }

   

    $mysqli->close();           # déconnexion de la base de données
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