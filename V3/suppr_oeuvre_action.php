<?php

    session_start();
            if(!isset($_SESSION['login']) && !isset($_SESSION['role'])){
                header("Location:session.php");
            }


    $num=htmlspecialchars($_POST['numero']);

    $mysqli = new mysqli('localhost','zmenouch0','b7h5scjf','zfl2-zmenouch0');              # connexion à la base de données

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

    $sql1="DELETE FROM t_expose_eps WHERE oeu_code=$num";                 # suppression du lien entre une oeuvre et sont exposant
    $sql2="DELETE FROM t_oeuvre_oeu WHERE oeu_code=$num";               # suppression de l'oeuvre
    $resultat1 = $mysqli->query($sql1);
    $resultat2 = $mysqli->query($sql2);
    if ($resultat1 == false){
        echo "Error: La requete a echoue \n";
        echo "Errno: " . $mysqli->errno . "\n";
        exit();
      }
      if ($resultat2 == false){
        echo "Error: La requete a echoue \n";
        echo "Errno: " . $mysqli->errno . "\n";
        exit();
      }

    header("Location:admin_oeuvre.php");

    $mysqli->close();         # déconnexion de la base de données

?>