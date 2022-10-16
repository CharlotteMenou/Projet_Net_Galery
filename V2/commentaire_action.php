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

  $numero=htmlspecialchars($_POST['numero']);
  $mdp=htmlspecialchars($_POST['mdp']);
  $nom=htmlspecialchars($_POST['nom']);
  $prenom=htmlspecialchars($_POST['prenom']);
  $email=htmlspecialchars($_POST['email']);
  $texte=htmlspecialchars($_POST['texte']);


  $mysqli = new mysqli('localhost','zmenouch0','b7h5scjf','zfl2-zmenouch0');         # connexion à la base de données

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

  $OK=1;

  if($numero==NULL || $mdp==NULL || $nom==NULL || $prenom==NULL || $email==NULL || $texte==NULL){
    echo "<center>";
    echo "<br />";
    echo "<br />";
    echo "<br />";
    echo "<br />";
    echo "<br />";
    echo "<br />";
    echo "<br />";
    echo "<h4>";
    echo("Il faut renseigrer tous les champs, veuillez reessayer.");
    echo "<br />";
    echo "<br />";
    echo("<a href='./livredor.php'>Recommencer</a>");
    echo "</h4>";
    echo "</center>";
  }else{
    $sql="SET @3h_OK=(SELECT vis_numero FROM t_visiteur_vis WHERE vis_date_heure <= NOW() AND NOW()<= TIMESTAMPADD(HOUR,3,vis_date_heure) AND vis_numero='$numero');";         # on vérifie que le ticket du visiteur soit encore valable pour qu'il puisse laisser un commentaire
    $resultat = $mysqli->query($sql);
    if ($resultat == false){
      echo "Error: La requete a echoue \n";
      echo "Errno: " . $mysqli->errno . "\n";
      exit();
    }else{
      $sqll="SELECT @3h_OK;";
      $resultatt = $mysqli->query($sqll);
      if ($resultatt == false){
        echo "Error: La requete a echoue \n";
        echo "Errno: " . $mysqli->errno . "\n";
        exit();
      }else{
        $valide = $resultatt->fetch_assoc();
      }
    }
  
    $sql1="SELECT com_texte FROM t_commentaire_com WHERE vis_numero=$numero";           # on sélectionne le commentaire si il existe du visiteur $num
    $resultat1 = $mysqli->query($sql1);
    if ($resultat1 == false){
      echo "Error: La requete a echoue \n";
      echo "Errno: " . $mysqli->errno . "\n";
      exit();
    }else{
      $nb_com = $resultat1->num_rows;
    }
  
    $sql4="SELECT vis_numero,vis_mdp FROM t_visiteur_vis WHERE vis_numero='$numero' AND vis_mdp=MD5('$mdp')";      # on vérifie que le ticket avec un numero de visiteur $numero et un mot de passe $mdp existe bien dans la base de donnée
    $resultat4 = $mysqli->query($sql4);
    if ($resultat4 == false){
      echo "Error: La requete a echoue \n";
      echo "Errno: " . $mysqli->errno . "\n";
      exit();
    }else{
      if($valide['@3h_OK']!=$numero){
          $OK=0;
          if($nb_com!=0){
              echo('<center><h4>Vous ne pouver pas laisser de commentaire. Vous avez deja laisse un commentaire et votre ticket a expire.</h4>');
              echo('<a href="./index.php" title="">Accueil</a>');
          }else{
              echo('<center><h4>Vous ne pouver pas laisser de commentaire. Votre ticket a expire.</h4>');
              echo('<a href="./index.php" title="">Accueil</a>');
          }    
      }else if($nb_com!=0){
          $OK=0;
          echo('<center><h4>Vous ne pouver pas laisser de commentaire. Vous avez deja laisse un commentaire.</h4>');
          echo('<a href="./index.php" title="">Accueil</a>');
      }else if($resultat4->num_rows!=1){
          $OK=0;
          echo('<center><h4>Vous ne pouver pas laisser de commentaire. Votre mot de passe est incorrecte.</h4>');
          echo('<a href="./index.php" title="">Accueil</a>');
      }
      if($OK==1){
          $sql2="UPDATE t_visiteur_vis SET vis_nom='" .addslashes($nom). "',vis_prenom='$prenom',vis_e_mail='$email' WHERE vis_numero='$numero'";         # on ajoute un nom, un prenom, et un email au visiteur qui va laisser un commentaire
          $resultat2 = $mysqli->query($sql2);
          if ($resultat2 == false){
            echo "Error: La requete a echoue \n";
            echo "Errno: " . $mysqli->errno . "\n";
            exit();
          }
          $sql3="INSERT INTO `t_commentaire_com` (`com_numero`, `com_date_heure`, `com_texte`, `com_etat`, `vis_numero`) VALUES (NULL, NOW(), '$texte', 'P', '$numero');";          # on ajoute une ligne dans la table des commentaires
          $resultat3 = $mysqli->query($sql3);
          if ($resultat3 == false){
            echo "Error: La requete a echoue \n";
            echo "Errno: " . $mysqli->errno . "\n";
            exit();
          }
          header("Location:livredor.php");
      }
    }
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