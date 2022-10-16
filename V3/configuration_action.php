<?php
        session_start();
        if(!isset($_SESSION['login']) && !isset($_SESSION['role'])){
          header("Location:session.php");
        }

  $intitule=htmlspecialchars($_POST['intitule']);
  $datedeb=htmlspecialchars($_POST['datedeb']);
  $datefin=htmlspecialchars($_POST['datefin']);
  $presentation=htmlspecialchars($_POST['presentation']);
  $lieu=htmlspecialchars($_POST['lieu']);
  $datevernissage=htmlspecialchars($_POST['datevernissage']);
  $bienvenue=htmlspecialchars($_POST['bienvenue']);

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

  if($intitule!=NULL){
      $sql="UPDATE t_configuration_cfg SET cfg_intitule='" .addslashes($intitule). "'";        # on modifie l'intitule de l'exposition
      $resultat = $mysqli->query($sql);
      if ($resultat == false){
        echo "Error: La requete a echoue \n";
        echo "Errno: " . $mysqli->errno . "\n";
        exit();
      }
  }

    if($datedeb!=NULL){
        $sql="UPDATE t_configuration_cfg SET cfg_date_deb='$datedeb'";        # on modifie la date de debut de l'exposition
        $resultat = $mysqli->query($sql);
        if ($resultat == false){
            echo "Error: La requete a echoue \n";
            echo "Errno: " . $mysqli->errno . "\n";
            exit();
        }
    }

    if($datefin!=NULL){
        $sql="UPDATE t_configuration_cfg SET cfg_date_fin='$datefin'";        # on modifie la date de fin de l'exposition
        $resultat = $mysqli->query($sql);
        if ($resultat == false){
            echo "Error: La requete a echoue \n";
            echo "Errno: " . $mysqli->errno . "\n";
            exit();
        }
    }

    if($presentation!=NULL){
        $sql="UPDATE t_configuration_cfg SET cfg_presentation='" .addslashes($presentation). "'";        # on modifie la presentation de l'exposition
        $resultat = $mysqli->query($sql);
        if ($resultat == false){
            echo "Error: La requete a echoue \n";
            echo "Errno: " . $mysqli->errno . "\n";
            exit();
        }
    }

    if($lieu!=NULL){
        $sql="UPDATE t_configuration_cfg SET cfg_lieu='" .addslashes($lieu). "'";        # on modifie le lieu de l'exposition
        $resultat = $mysqli->query($sql);
        if ($resultat == false){
            echo "Error: La requete a echoue \n";
            echo "Errno: " . $mysqli->errno . "\n";
            exit();
        }
    }

    if($datevernissage!=NULL){
        $sql="UPDATE t_configuration_cfg SET cfg_date_vernissage='$datevernissage'";        # on modifie la date de vernissage de l'exposition
        $resultat = $mysqli->query($sql);
        if ($resultat == false){
            echo "Error: La requete a echoue \n";
            echo "Errno: " . $mysqli->errno . "\n";
            exit();
        }
    }

    if($bienvenue!=NULL){
        $sql="UPDATE t_configuration_cfg SET cfg_texte_bienvenue='" .addslashes($bienvenue). "'";        # on modifie le texte de bienvenue de l'exposition
        $resultat = $mysqli->query($sql);
        if ($resultat == false){
            echo "Error: La requete a echoue \n";
            echo "Errno: " . $mysqli->errno . "\n";
            exit();
        }
    }
  
    header("Location:admin_configuration.php");

    $mysqli->close();                      # deconnexion de la base de données

?>
