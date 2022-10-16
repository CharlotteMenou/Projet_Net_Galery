<?php

session_start();
if(!isset($_SESSION['login']) && !isset($_SESSION['role'])){
    header("Location:session.php");
}

$pseudo=htmlspecialchars($_POST['pseudo']);

$mysqli = new mysqli('localhost','zmenouch0','b7h5scjf','zfl2-zmenouch0');          # connexion à la base de données

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

$sql="SELECT pro_role FROM t_profil_pro WHERE cpt_pseudo='$pseudo'" ;           # on selectionne le role du profil  $pseudo
$resultat = $mysqli->query($sql);
if ($resultat == false){
    echo "Error: La requete a echoue \n";
    echo "Errno: " . $mysqli->errno . "\n";
    exit();
}else{
    $role = $resultat->fetch_assoc();
}

 
if($role['pro_role']=='A'){
    $sql1="UPDATE t_profil_pro SET pro_role='O' WHERE cpt_pseudo='$pseudo'" ;      # on modifie le role du profil $pseudo
    $resultat1 = $mysqli->query($sql1);
    if ($resultat1 == false){
        echo "Error: La requete a echoue \n";
        echo "Errno: " . $mysqli->errno . "\n";
        exit();
    }
}
if($role['pro_role']=='O'){
    $sql1="UPDATE t_profil_pro SET pro_role='A' WHERE cpt_pseudo='$pseudo'" ;       # on modifie le role du profil $pseudo
    $resultat1 = $mysqli->query($sql1);
    if ($resultat1 == false){
        echo "Error: La requete a echoue \n";
        echo "Errno: " . $mysqli->errno . "\n";
        exit();
    }
}

header("Location:admin_accueil.php");

$mysqli->close();           # déconnexion de la base de données

?>