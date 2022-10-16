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



  <title>Connexion</title>

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
    session_start();
    if(!isset($_SESSION['login']) && !isset($_SESSION['role'])){
      header("Location:session.php");
    }

    if ($_POST["pseudo"] && $_POST["mdp"]){
        $id=$_POST["pseudo"];
        $motdepasse=$_POST["mdp"];
    }else{
        echo "Il manque le pseudo ou le mot de passe\n";
    }

    $mysqli = new mysqli('localhost','zmenouch0','b7h5scjf','zfl2-zmenouch0');      # connexion à la base de données

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

    $sql="SELECT cpt_pseudo,cpt_mdp,pro_validite FROM t_compte_cpt JOIN t_profil_pro USING(cpt_pseudo)WHERE cpt_pseudo='" .$id ."' AND cpt_mdp=MD5('" .$motdepasse. "') AND pro_validite='A'";        #vérification qu'un compte se connecte avec les bons identifiants et qu'il est activé
    $resultat = $mysqli->query($sql);
    if ($resultat== false){
      echo "Error: La requete a echoue \n";
      echo "Errno: " . $mysqli->errno . "\n";
      exit();
    }
    else {
        if($resultat->num_rows == 1) {
            $_SESSION['login']=$id;
            $reqrole="SELECT pro_role FROM t_profil_pro WHERE cpt_pseudo='".$_SESSION['login']."'";      # on sélectionne le rôle du compte
            $resultrole = $mysqli->query($reqrole);
            if ($resultrole == false){
              echo "Error: La requete a echoue \n";
              echo "Errno: " . $mysqli->errno . "\n";
              exit();
            }
            else {
              $profil = $resultrole->fetch_assoc();
              $_SESSION['role']=$profil[pro_role];

              header("Location:admin_accueil.php");
            }
        }else{
            echo "<center>";
            echo "<br />";
            echo "<br />";
            echo "<br />";
            echo "<br />";
            echo "<br />";
            echo "<br />";
            echo "<h4>pseudo/mot de passe incorrect(s) ou profil inconnu !</h4>";
            echo "<a href=\"./session.php\">Cliquez ici pour afficher le formulaire de connection</a>";
            echo "</center>";
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
