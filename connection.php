<!DOCTYPE html>
<html lang="fr">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<link rel="stylesheet" href="PTUT.css" />
 

  <?php include('header.php') ?>

<h2>Se connecter </h2>
<form action="#">
  <fieldset>
      <label for="mail">Adresse mail <em></em></label>
      <input id="email" type="email" placeholder="" required="" pattern="[a-zA-Z]*.[a-zA-Z]*@gmail.com"><br>

      <label for="password">Mot de passe</label>
      <input id="mdp" type="password" placeholder="" required=""><br>
        
  </fieldset>
  
</form>

<a href="formulaire.php"> Je n'ai pas encore de compte </a>



<?php include('footer.php') ?>

</html>