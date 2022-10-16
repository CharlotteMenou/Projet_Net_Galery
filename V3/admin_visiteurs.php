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


    $mysqli = new mysqli('localhost','zmenouch0','b7h5scjf','zfl2-zmenouch0');               # connexion à la base de données

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

    

      $sql="SELECT vis_numero,cpt_pseudo,com_texte,com_etat,vis_date_heure,vis_nom,vis_prenom,vis_e_mail FROM t_visiteur_vis LEFT OUTER JOIN t_commentaire_com USING(vis_numero)";           # on sélectionne tous les visiteurs dans la table visiteurs qu'ils aient ou non laissé un commentaire et leur commentaire dans la table commentaire 
      $resultat = $mysqli->query($sql);
      if ($resultat == false){
        echo "Error: La requete a echoue \n";
        echo "Errno: " . $mysqli->errno . "\n";
        exit();
      }else{
        echo "<h2>Gestion des tickets Visiteurs</h2>";
        echo("<table>");
          echo("<tr>");
            echo ("<strong>");
            echo("<td> <strong> Numero de ticket </strong> </td>");
            echo("<td> <strong> Heure d'emition du ticket </strong> </td>");
            echo("<td> <strong> Utilisateur qui a genere le ticket </strong> </td>");
            echo("<td> <strong> Nom </strong> </td>");
            echo("<td> <strong> Prenom </strong> </td>");
            echo("<td> <strong> Email </strong> </td>");
            echo("<td> <strong> Commentaire </strong> </td>");
            echo("<td> <strong> Etat du commentaire </strong> </td>");
            echo ("</strong>");
          echo("</tr>");
          while($actu = $resultat->fetch_assoc()){
            echo("<tr>");
              if($actu['com_etat']=='P'){
                  $couleur='#90EE90';
              }
              if($actu['com_etat']=='C'){
                  $couleur='#FA8072';
              }
              if($actu['com_etat']==NULL){
                  $couleur='#FFFFFF';
              }
              echo("<td>" .$actu['vis_numero'] ."</td>");
              echo("<td>" .$actu['vis_date_heure'] ."</td>");
              echo("<td>" .$actu['cpt_pseudo'] ."</td>");
              echo("<td>" .$actu['vis_nom'] ."</td>");
              echo("<td>" .$actu['vis_prenom'] ."</td>");
              echo("<td>" .$actu['vis_e_mail'] ."</td>");
              echo("<td>" .$actu['com_texte'] ."</td>");
              echo("<td style='background-color:$couleur;'>" .$actu['com_etat'] ."</td>");
            echo("</tr>");   
          }
        echo("</table>");
        echo "<br />";
        echo "<br />";
        echo "<br />";
      }
      $sql1="SELECT vis_numero FROM t_commentaire_com";            #on sélectionne le numero des visiteurs qui ont laissés un commentaire
      $resultat1 = $mysqli->query($sql1);
      if ($resultat1 == false){
        echo "Error: La requete a echoue \n";
        echo "Errno: " . $mysqli->errno . "\n";
        exit();
      }else{
        echo "<h2>Publier ou cacher un commentaire</h2>";
         echo('<form action="com_PC_action.php" method="post">');
            echo('<select name="numero">');
            while($actu = $resultat1->fetch_assoc()){
              echo('<option >'.$actu['vis_numero'].'</option>');
            }
            echo('</select>');
            echo('<button type="submit" class="btn btn-primary btn-lg">Publier / Cacher</button>');
          echo('</form>');
      }
        echo "<br />";
        echo "<br />";
        echo "<br />";
  

    $sql2="SELECT vis_numero FROM t_visiteur_vis";                  # on sélectionne le numero de tous les visiteurs de la table des visiteurs
    $resultat2 = $mysqli->query($sql2);
    if ($resultat2 == false){
      echo "Error: La requete a echoue \n";
      echo "Errno: " . $mysqli->errno . "\n";
      exit();
    }else{
      echo "<h2>Supprimer un ticket Visiteur</h2>";
       echo('<form action="visiteurs_action.php" method="post">');
          echo('<select name="numero">');
          while($actu = $resultat2->fetch_assoc()){
            echo('<option >'.$actu['vis_numero'].'</option>');
          }
          echo('</select>');
          echo('<button type="submit" class="btn btn-primary btn-lg">Supprimer le ticket</button>');
        echo('</form>');
    }
    echo('</center>');

    $mysqli->close();             # déconnexion de la base de données 
?>

<br>
<br>
<br>
<center>
<h2>Generer un ticket Visiteur</h2>
   <h4>Le mot de passe doit contenir au minimum 15 characteres.</h4>
    <div class="section-container-spacer">
       <form action="new_ticket_action.php" method="post">
                <input type="password" class="form-control" name="mdp" placeholder="Entrez le mot de passe du visiteur">
              <button type="submit" class="btn btn-primary btn-lg">Generer</button>
        </form>
      </div>
</center>

</main>

<script>
document.addEventListener("DOMContentLoaded", function (event) {
  navbarToggleSidebar();
  navActivePage();
});
</script>
<script type="text/javascript" src="./main.85741bff.js"></script></body>

</html>
