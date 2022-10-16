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



  <title>Inscription</title>

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


   <div>
<?php

  $pseudo=htmlspecialchars($_POST['pseudo']);
  $mdp1=htmlspecialchars($_POST['mdp1']);
  $mdp2=htmlspecialchars($_POST['mdp2']);
  $nom=htmlspecialchars($_POST['nom']);
  $prenom=htmlspecialchars($_POST['prenom']);
  $email=htmlspecialchars($_POST['email']);

  $mysqli = new mysqli('localhost','zmenouch0','b7h5scjf','zfl2-zmenouch0');             # connexion à la base de données

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

  if($pseudo==NULL || $mdp1==NULL || $mdp2==NULL || $nom==NULL || $prenom==NULL || $email==NULL){
      echo "<center>";
      echo "<br />";
      echo "<br />";
      echo "<br />";
      echo "<br />";
      echo "<br />";
      echo "<br />";
      echo "<br />";
      echo "<h4>";
      echo("Il faut renseigrer tous les champs, veuillez reessayer l'inscription.");
      echo "<br />";
      echo "<br />";
      echo("<a href='./inscription.php'>Inscription</a>");
      echo "</h4>";
      echo "</center>";
      $OK=0;
  }

  if ($OK==1 && strcmp($mdp1,$mdp2)!=0){
      echo "<center>";
      echo "<br />";
      echo "<br />";
      echo "<br />";
      echo "<br />";
      echo "<br />";
      echo "<br />";
      echo "<br />";
      echo "<h4>";
      echo("Le mot de passe est mal renseigne, veuillez reessayer l'inscription.");
      echo "<br />";
      echo "<br />";
      echo("<a href='./inscription.php'>Inscription</a>");
      echo "</h4>";
      echo "</center>";
      $OK=0;
  }

  $sql7="SELECT cpt_pseudo FROM t_profil_pro WHERE cpt_pseudo='$pseudo';"; 
  $result7 = $mysqli->query($sql7);
  if ($result7 == false){
    echo "Error: La requete a echoue \n";
    echo "Query: " . $sql7 . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    exit();
  }else{
    if($result7->num_rows==1){
      echo "<center>";
      echo "<br />";
      echo "<br />";
      echo "<br />";
      echo "<br />";
      echo "<br />";
      echo "<br />";
      echo "<br />";
      echo "<h4>";
      echo("Ce pseudo est deja utilise, veuillez reessayer l'inscription.");
      echo "<br />";
      echo "<br />";
      echo("<a href='./inscription.php'>Inscription</a>");
      echo "</h4>";
      echo "</center>";
      $OK=0;
    }
  }


  if($OK==1){
      $sql="INSERT INTO t_compte_cpt VALUES('" .$pseudo. "','" .MD5($mdp1). "');";          # on insert une ligne dans la table des comptes
      $result3 = $mysqli->query($sql);
      if ($result3 == false){
          echo "Error: La requ�te a �chou� \n";
          echo "Query: " . $sql . "\n";
          echo "Errno: " . $mysqli->errno . "\n";
          exit();
          $OK=0;
      }
  }

  if($OK==1){
      $sql="INSERT INTO t_profil_pro VALUES('" .addslashes($nom). "','" .$prenom. "','" .$email. "','D','O',NOW(),'" .$pseudo. "');";      # on insert une ligne dans la table des profils
      $result3 = $mysqli->query($sql);
      if ($result3 == false){
          echo "Error: La requ�te a �chou� \n";
          echo "Query: " . $sql . "\n";
          echo "Errno: " . $mysqli->errno . "\n";
          $sql="DELETE FROM t_compte_cpt WHERE cpt_pseudo='" .$pseudo. "';";        # on supprime la ligne dans la table des comptes où le pseudo est égal à $pseudo
          $result3 = $mysqli->query($sql);
          if ($result3 == false){
            echo "Error: La requ�te a �chou� \n";
            echo "Errno: " . $mysqli->errno . "\n";
            exit();
          }
          exit();
      }
      else
      {
          echo "<center>";
          echo "<br />";
          echo "<br />";
          echo "<br />";
          echo "<br />";
          echo "<br />";
          echo "<br />";
          echo "<br />";
          echo "<h4>";
          echo("Inscription reussie");
          echo "<br />";
          echo "<br />";
          echo("<a href='./index.php'>Accueil</a>");
          echo "</h4>";
          echo "</center>";
      }
  }

  $mysqli->close();          # déconnexion de la base de données
?>

<div>

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

