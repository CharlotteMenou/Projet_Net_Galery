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

<div>
      <h3>Modifier mon Profil</h3>
        <h5>Remplir seulement les champs que vous souhaitez modifier</h5>
      <div class="section-container-spacer">
       <form action="action_profil.php" method="post">
          <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <input type="text" class="form-control" name="nom" placeholder="Nom">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="prenom" placeholder="Prenom">
            </div>
            <div class="form-group">
                <input type="texte" class="form-control" name="email" placeholder="Email">
            </div>
            <button type="submit" class="btn btn-primary btn-lg">Modifier</button>
        </form>
       
    <br>
    <br>
    <br>
        <h3>Modifier mon mot de passe</h3>
        <div class="section-container-spacer">
       <form action="action_profil.php" method="post">
          <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <input type="password" class="form-control" name="mdp1" placeholder="Mot de passe">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="mdp2" placeholder="Mot de passe">
            </div>
            <button type="submit" class="btn btn-primary btn-lg">Modifier</button>
        </form>

</main>

<script>
document.addEventListener("DOMContentLoaded", function (event) {
  navbarToggleSidebar();
  navActivePage();
});
</script>
<script type="text/javascript" src="./main.85741bff.js"></script></body>

</html>