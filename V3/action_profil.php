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

  $pseudo=$_SESSION['login'];
  $mdp1=htmlspecialchars($_POST['mdp1']);
  $mdp2=htmlspecialchars($_POST['mdp2']);
  $nom=htmlspecialchars($_POST['nom']);
  $prenom=htmlspecialchars($_POST['prenom']);
  $email=htmlspecialchars($_POST['email']);

  $mysqli = new mysqli('localhost','zmenouch0','b7h5scjf','zfl2-zmenouch0');           #connexion à la base de données

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

  if($nom!=NULL){
      $sql="UPDATE t_profil_pro SET pro_nom='" .addslashes($nom). "' WHERE cpt_pseudo='$pseudo'";        # on modifie le nom dans la table des profils où le pseudo est égal au pseudo de l'utilisateur connecté
      $resultat = $mysqli->query($sql);
      if ($resultat == false){
        echo "Error: La requete a echoue \n";
        echo "Errno: " . $mysqli->errno . "\n";
        exit();
      }
      header("Location:admin_accueil.php");
  }
  if($prenom!=NULL){
      $sql="UPDATE t_profil_pro SET pro_prenom='$prenom' WHERE cpt_pseudo='$pseudo'";                   # on modifie le prénom dans la table des profils où le pseudo est égal au pseudo de l'utilisateur connecté
      $resultat = $mysqli->query($sql);
      if ($resultat == false){
        echo "Error: La requete a echoue \n";
        echo "Errno: " . $mysqli->errno . "\n";
        exit();
      }
      header("Location:admin_accueil.php");
  }

  if($email!=NULL){
      $sql="UPDATE t_profil_pro SET pro_e_mail='$email' WHERE cpt_pseudo='$pseudo'";                   # on modifie l'email dans la table des profils où le pseudo est égal au pseudo de l'utilisateur connecté
      $resultat = $mysqli->query($sql);
      if ($resultat == false){
        echo "Error: La requete a echoue \n";
        echo "Errno: " . $mysqli->errno . "\n";
        exit();
      }
      header("Location:admin_accueil.php");
  }

  $OK_mdp=1;

  if (strcmp($mdp1,$mdp2)!=0){
      echo "<center>";
      echo "<br />";
      echo "<br />";
      echo "<br />";
      echo "<br />";
      echo "<br />";
      echo "<br />";
      echo "<br />";
      echo "<h4>";
      echo("Le mot de passe est mal renseigne, veuillez reessayer la modification de votre mot de passe.");
      echo "<br />";
      echo "<br />";
      echo("<a href='./modif_profil.php'>Modifier mon mot de passe</a>");
      echo "</h4>";
      echo "</center>";
      $OK_mdp=0;
  }
  if($OK_mdp==1 && $mdp1!=NULL && $mdp2!=NULL){
      $sql="UPDATE t_compte_cpt SET cpt_mdp=MD5('$mdp1') WHERE cpt_pseudo='$pseudo'";         # on modifie le mot de passe dans la table des comptes où le pseudo est égal au pseudo de l'utilisateur connecté
      $resultat = $mysqli->query($sql);
      if ($resultat == false){
        echo "Error: La requete a echoue \n";
        echo "Errno: " . $mysqli->errno . "\n";
        exit();
      }
      header("Location:admin_accueil.php");
  }

  $mysqli->close();                      # deconnexion de la base de données

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