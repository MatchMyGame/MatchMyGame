<?php
session_start();
include("connexion.inc.php");
$bdd = connect();

if(isset($_POST['mail']) AND isset($_POST['password']) AND !empty($_POST['mail']) AND !empty($_POST['password'])) {
  $email = htmlspecialchars($_POST['mail']);
  $getmatchinguser = $bdd->query("SELECT * FROM user WHERE `mail` = '$email'");
  if($getmatchinguser->rowCount() == 1){
    $user = $getmatchinguser->fetch();
      if(password_verify($_POST['password'], $user['password'])){
        $_SESSION['idUser'] = $user['idUser'];
        $_SESSION['mail'] = $user['mail'];
        $_SESSION['prénom'] = $user['prénom'];
        $_SESSION['discord'] = $user['discord'];
        $_SESSION['plateforme'] = $user['plateforme'];
        $_SESSION['game'] = $user['game'];

        
          Header("Location: index.php");
        
      }else{
        $error = "Mot de passe incorect.";
      }
  }else{
    $error = "Aucun utilisateur correspondant.";
  }

}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<link rel="stylesheet" href="styles.css" />
<link rel="stylesheet" href="formulaire.css" />
 

  <?php include('header.php') ?>

<h2>Se connecter </h2>
<form role="form" method="POST">

            <fieldset>
              <div class="form">
                <input class="form-input" placeholder="Adresse mail" name="mail" type="mail" autofocus="">
              </div>

              <div class="form">
                <input class="form-input" placeholder="Mot de passe" name="password" type="password" value="">
              </div>

              <input type="submit" name="inscription" value="Se connecter">
            </fieldset>
</form>

<a href="formulaire.php"> Je n'ai pas encore de compte </a>



<?php include('footer.php') ?>

</html>