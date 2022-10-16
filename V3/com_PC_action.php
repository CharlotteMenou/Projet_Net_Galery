<?php

session_start();
if(!isset($_SESSION['login']) && !isset($_SESSION['role'])){
    header("Location:session.php");
}

$num=htmlspecialchars($_POST['numero']);

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

$sql="SELECT com_etat FROM t_commentaire_com WHERE vis_numero=$num" ;           # on selectionne l'etat du commentaire de la table commentaire où le numéro du visiteur est égal à $num
$resultat = $mysqli->query($sql);
if ($resultat == false){
    echo "Error: La requete a echoue \n";
    echo "Errno: " . $mysqli->errno . "\n";
    exit();
}else{
    $validite = $resultat->fetch_assoc();
    
    if($validite['com_etat']=='P'){
        $sql1="UPDATE t_commentaire_com SET com_etat='C' WHERE vis_numero='$num'" ;          # on modifie l'état du commentaire du visiteur $num
        $resultat1 = $mysqli->query($sql1);
    }
    if($validite['com_etat']=='C'){
        $sql1="UPDATE t_commentaire_com SET com_etat='P' WHERE vis_numero='$num'" ;          # on modifie l'état du commentaire du visiteur $num
        $resultat1 = $mysqli->query($sql1);
    }
}

header("Location:admin_visiteurs.php");

$mysqli->close();             # déconnexion de la base de données 

?>