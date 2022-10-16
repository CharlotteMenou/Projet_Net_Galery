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



  <title>Accueil Administration</title>

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
      <h1>Livre D'or</h1>
      <h4>N'hesitez pas a partager vos impressions sur l'exposition.</h4>
    </div>
    <div class="section-container-spacer">
       <form action="commentaire_action.php" method="post">
          <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <input type="text" class="form-control" name="numero" placeholder="Numero de ticket">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" name="mdp" placeholder="Mot de passe">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="nom" placeholder="Nom">
              </div>
               <div class="form-group">
                <input type="text" class="form-control" name="prenom" placeholder="Prenom">
              </div>
              <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email">
              </div>
              <div class="form-group">
                <textarea class="form-control" rows="3" name="texte" placeholder="Donnez votre avis"></textarea>
              </div>
              <button type="submit" class="btn btn-primary btn-lg">Partager</button>
<br>
<br>
<br>
<h3>Commentaires du Livre d'Or</h3>

<div>
<?php

  $mysqli = new mysqli('localhost','zmenouch0','b7h5scjf','zfl2-zmenouch0');            #connexion à la base de données

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

  $requete="SELECT vis_prenom,vis_nom,com_date_heure,com_texte FROM t_commentaire_com JOIN t_visiteur_vis USING(vis_numero) WHERE com_etat='P'";        # on sélectionne les informations des visiteurs qui ont un commentaire publié
  $result1 = $mysqli->query($requete);
  if ($result1 == false){
    echo "Error: La requete a echoue \n";
    echo "Errno: " . $mysqli->errno . "\n";
    exit();
  }else{
    echo("<table>");
        echo("<tr>");
            echo("<td>"."<strong>".'Prenom'."</strong>"."</td>");
            echo("<td>"."<strong>".'Nom'."</strong>"."</td>");
            echo("<td>"."<strong>".'Commentaire'."</strong>"."</td>");
            echo("<td>"."<strong>".'Date'."</strong>"."</td>");
        echo("</tr>");
        while ($actu = $result1->fetch_assoc()){
            echo("<tr>");
                echo("<td>".$actu['vis_prenom'] ."</td>");
                echo("<td>".$actu['vis_nom'] ."</td>");
                echo("<td>".$actu['com_texte'] ."</td>");
                echo("<td>".$actu['com_date_heure'] ."</td>");
            echo("</tr>");
        }
    echo("</table>");
  }


  $mysqli->close();           # déconnexion de la base de données

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
