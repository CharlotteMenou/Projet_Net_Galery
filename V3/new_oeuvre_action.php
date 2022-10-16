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



  <title>Modification Profil</title>

<link href="./main.82cfd66e.css" rel="stylesheet">
<style type="text/css">
    .grid-item{
        display: inline-block;
        padding: 5px;
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

    $exposant=htmlspecialchars($_POST['exposant']);
    $intitule=htmlspecialchars($_POST['intitule']);
    $date=htmlspecialchars($_POST['date']);
    $description=htmlspecialchars($_POST['description']);
    $image=htmlspecialchars($_POST['image']);

    if($exposant==NULL || $intitule==NULL || $date==NULL || $description==NULL || $image==NULL ){
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
        echo("<a href='./admin_oeuvre.php'>Recommencer</a>");
        echo "</h4>";
        echo "</center>";
    }else{
        $sql="INSERT INTO `t_oeuvre_oeu` (`oeu_code`, `oeu_intitule`, `oeu_date`, `oeu_description`, `oeu_image`) VALUES (NULL, '$intitule', '$date', '$description', '$image')";          # ajout d'une oeuvre
        $resultat = $mysqli->query($sql);
        if ($resultat == false){
            echo "Error: La requete a echoue \n";
            echo "Errno: " . $mysqli->errno . "\n";
            exit();
        }
        $sql1="SELECT max(oeu_code) AS max FROM t_oeuvre_oeu";
        $resultat1 = $mysqli->query($sql1);
        if ($resultat == false){
            echo "Error: La requete a echoue \n";
            echo "Errno: " . $mysqli->errno . "\n";
            exit();
        }else{
            $actu = $resultat1->fetch_assoc();
            $code_oeuvre=$actu['max'];
            $sql3="INSERT INTO `t_expose_eps` (`oeu_code`, `exp_id`) VALUES ('$code_oeuvre', '$exposant');";          # ajout d'une oeuvre
            $resultat3 = $mysqli->query($sql3);
            if ($resultat3 == false){
                echo "Error: La requete a echoue \n";
                echo "Errno: " . $mysqli->errno . "\n";
                exit();
            }
        }
        header("Location:admin_oeuvre.php");
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