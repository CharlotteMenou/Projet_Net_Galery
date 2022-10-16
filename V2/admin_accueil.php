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

<?php


    $mysqli = new mysqli('localhost','zmenouch0','b7h5scjf','zfl2-zmenouch0');          # connexion a la base de donnees

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

    echo ("<center>");                                                             # menu de l'espace d'administration
    echo('<h1>Administration</h1>');
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
    echo "<h2>Mon Profil</h2>";

    $sql="SELECT * FROM t_profil_pro WHERE cpt_pseudo='".$_SESSION['login']."'";        # on séléctionne toutes les colonnes de la table profil où le pseudo est égal au login de la personne connectée sur le site
    $resultat = $mysqli->query($sql);
    if ($resultat == false){
      echo "Error: La requete a echoue \n";
      echo "Errno: " . $mysqli->errno . "\n";
      exit();
    }else{
      while($actu = $resultat->fetch_assoc()){
          echo('<h4>Pseudo : '.$actu['cpt_pseudo'] .'</h4>');
          echo('<h4>Nom : '.$actu['pro_nom'] .'</h4>');
          echo('<h4>Prenom : '.$actu['pro_prenom'] .'</h4>');
          echo('<h4>email : '.$actu['pro_e_mail'] .'</h4>');
          echo('<h4>Date de creation du profil : '.$actu['pro_date'] .'</h4>');
          if($actu['pro_role']=='A'){
              echo ("<h4>Role  : Administrateur</h4>");
          }
          if($actu['pro_role']=='O'){
              echo ("<h4>Role : Organisateur</h4>");
          }
      }
    }
    echo("<a href='./modif_profil.php' title=''>Modifier mon profil</a>");
    echo "<br />";
    echo "<br />";
    echo "<br />";
    
    
    if($_SESSION['role']=='A'){                             # si la personne connectée est un administrateur
      $sql1="SELECT cpt_pseudo FROM t_profil_pro";          # on séléctionne tous les pseudos de la table des profils
      $resultat1 = $mysqli->query($sql1);
      if ($resultat1 == false){
        echo "Error: La requete a echoue \n";
        echo "Errno: " . $mysqli->errno . "\n";
        exit();
      }else{
        echo "<h2>Gestion des Profils</h2>";
        $nb=$resultat1->num_rows;
        echo("<h4>Il y a $nb comptes sur le serveur.</h4>");
        $sql="SELECT * FROM t_profil_pro";                      # on séléctionne toutes les colonnes de la table des profils
        $resultat = $mysqli->query($sql);
        if ($resultat == false){
          echo "Error: La requete a echoue \n";
          echo "Errno: " . $mysqli->errno . "\n";
          exit();
        }else{
          echo("<table>");
            echo("<tr>");
              echo ("<strong>");
              echo("<td> <strong> Pseudo </strong> </td>");
              echo("<td> <strong> Nom </strong> </td>");
              echo("<td> <strong> Prenom </strong> </td>");
              echo("<td> <strong> Email </strong> </td>");
              echo("<td> <strong> Role </strong> </td>");
              echo("<td> <strong> Validite </strong> </td>");
              echo("<td> <strong> Date de creation </strong> </td>");
              echo ("</strong>");
            echo("</tr>");
            while($actu = $resultat->fetch_assoc()){
              echo("<tr>");
                if($actu['pro_validite']=='A'){
                  $couleur='#90EE90';
                }
                if($actu['pro_validite']=='D'){
                  $couleur='#FA8072';
                }
                if($actu['pro_role']=='A'){
                  $couleur_role='#C0C0C0';
                }
                if($actu['pro_role']=='O'){
                  $couleur_role='#FFFFFF';
                }
                echo("<td>" .$actu['cpt_pseudo'] ."</td>");
                echo("<td>" .$actu['pro_nom'] ."</td>");
                echo("<td>" .$actu['pro_prenom'] ."</td>");
                echo("<td>" .$actu['pro_e_mail'] ."</td>");
                echo("<td style='background-color:$couleur_role;'>" .$actu['pro_role'] ."</td>");
                echo("<td style='background-color:$couleur;'>" .$actu['pro_validite'] ."</td>");
                echo("<td>" .$actu['pro_date'] ."</td>");
              echo("</tr>");   
            }
          echo("</table>");
          echo "<br />";
          echo "<br />";
          echo "<br />";
        }
      }

      $req="SELECT cpt_pseudo FROM t_profil_pro";            # on sélectionne tous les pseudos de la table des profils
      $resultat1 = $mysqli->query($req);
      if ($resultat1 == false){
        echo "Error: La requete a echoue \n";
        echo "Errno: " . $mysqli->errno . "\n";
        exit();
      }else{
        echo "<h2>Activer ou Desactiver un Compte</h2>";
          echo('<form action="comptes_action.php" method="post">');
            echo('<select name="pseudo">');
            while($actu = $resultat1->fetch_assoc()){
              echo('<option >'.$actu['cpt_pseudo'].'</option>');
            }
            echo('</select>');
            echo('<button type="submit" class="btn btn-primary btn-lg">Activer / Desactiver</button>');
          echo('</form>');
      }

      echo "<br />";
      echo "<br />";

      $req="SELECT cpt_pseudo FROM t_profil_pro";            # on sélectionne tous les pseudos de la table des profils
      $resultat1 = $mysqli->query($req);
      if ($resultat1 == false){
        echo "Error: La requete a echoue \n";
        echo "Errno: " . $mysqli->errno . "\n";
        exit();
      }else{
        echo "<h2>Modifier le role d'un utilisateur</h2>";
          echo('<form action="modif_role_action.php" method="post">');
            echo('<select name="pseudo">');
            while($actu = $resultat1->fetch_assoc()){
              echo('<option >'.$actu['cpt_pseudo'].'</option>');
            }
            echo('</select>');
            echo('<button type="submit" class="btn btn-primary btn-lg">Administrateur / Organisateur</button>');
          echo('</form>');
      }

      echo "<br />";
      echo "<br />";

      $req="SELECT cpt_pseudo FROM t_profil_pro";            # on sélectionne tous les pseudos de la table des profils
      $resultat1 = $mysqli->query($req);
      if ($resultat1 == false){
        echo "Error: La requete a echoue \n";
        echo "Errno: " . $mysqli->errno . "\n";
        exit();
      }else{
        echo "<h2>Supprimer un Compte</h2>";
          echo('<form action="suppr_profil_action.php" method="post">');
            echo('<select name="pseudo">');
            while($actu = $resultat1->fetch_assoc()){
              echo('<option >'.$actu['cpt_pseudo'].'</option>');
            }
            echo('</select>');
            echo('<button type="submit" class="btn btn-primary btn-lg">Supprimer</button>');
          echo('</form>');
      }
    }
  echo "</center>";

  $mysqli->close();                     # deconnexion de la base de données
   
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
