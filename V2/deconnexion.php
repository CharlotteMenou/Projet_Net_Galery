<?php
    session_start();
    if(!isset($_SESSION['login']) && !isset($_SESSION['role'])){
        header("Location:session.php");
    }
    session_destroy();
    header('Location: index.php');
?>