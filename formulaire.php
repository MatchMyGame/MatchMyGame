<?php
session_start();
include("inc/connexion.inc.php");
$bdd = connect();

if(isset($_POST['email']) AND isset($_POST['password1']) AND isset($_POST['password2']) AND isset($_POST['username']) AND !empty($_POST['email']) AND !empty($_POST['password1']) AND !empty($_POST['password2']) AND !empty($_POST['username']) AND isset($_POST['fullname']) AND !empty($_POST['fullname'])) {
  $email = htmlspecialchars($_POST['email']);
  $getmatchinguser = $bdd->query("SELECT * FROM users WHERE `mail` = '$email'");

  if($getmatchinguser->rowCount() == 0){

    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {

      $username = htmlspecialchars($_POST['username']);
      $getmatchinguserbyusername = $bdd->query("SELECT * FROM users WHERE `username` = '$username'");

      if($getmatchinguserbyusername->rowCount() == 0){

        if(preg_match('%^([a-zA-Z\_0-9]+)$%isU', $_POST['username'])){

          if($_POST['password1'] == $_POST['password2']){

            $adduser = $bdd->prepare("INSERT INTO users (username,password,mail,fullname) VALUES(?,?,?,?)");
            $adduser->execute(array($username,password_hash($_POST['password1'], PASSWORD_DEFAULT),$email,htmlspecialchars($_POST['fullname'])));

            if($adduser){

              $success = "Compte créé !";
            }else{

              $error = "Une erreur est survenue.";
            }
          }else{

            $error = "Les mots de passe ne correspondent pas.";
          }
        }else{

          $error = "Nom d'utilisateur invalide, vérifiez qu'il comporte uniquement des lettres, chiffres et le caractère \"_\".";
        }
      }else{

        $error = "Ce pseudo est déjà utilisé :(";
      }
    }
    else {

      $error = "Adresse email incorecte.";
    }
    
  }else{
    
    $error = "Cette adresse email est déjà utilisée.";
  }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<link rel="stylesheet" href="" />

<h2>Formulaire d'inscription </h2>
<form action="#">
  <p><i>Complétez le formulaire. Tout les champs marqué sont obligatoires.</i></p>
  <fieldset>
    <legend>Contact</legend>
      <label for="nom">Discord <em></em></label>
      <!--placeholder: indication grisée'--> 
      <!--required: il faut renseigner le champs sinon la validation est bloquée'-->
      <!--autofocus: le curseur est positionné dans cette case au chargement de la page'-->
      <input id="nom" placeholder="" autofocus="" required=""><br>
      <label for="telephone">Portable</label>
      <!-- type="tel": bascule le clavier sur un smartphone'-->
      <!-- pattern: expression régulière à vérifier pour pouvoir valider'-->
      <input id="telephone" type="tel" placeholder="" pattern="06[0-9]{8}"><br>
      <label for="email">Email <em></em></label>
      <input id="email" type="email" placeholder="" required="" pattern="[a-zA-Z]*.[a-zA-Z]*@gmail.com"><br>
      <label for="plateforme">Plateforme</label>
      <select id="sexe">
        <option value="PS4" name="Plateforme">PS4</option>
        <option value="PC" name="Plateforme">PC</option>
        <option value="XBOX ONE" name="Plateforme">XBOX ONE</option>
        <option value="SWITCH" name="Plateforme">SWITCH</option>
        <option value="PS5" name="Plateforme">PS5</option>
        <option value="XBOX Serie X" name="Plateforme">XBOX X</option>
        <option value="XBOX Serie S" name="Plateforme">XBOX S</option>
      </select><br>
  </fieldset>
  <fieldset>
    <legend>Information complémentaire</legend>
      <label for="age">Age<em></em></label>
      <!-- type="number": bascule le clavier sur un smartphone'-->
      <input id="age" type="number" placeholder="" pattern="[0-9]{2}" required=""><br>
      <label for="sexe">Sexe</label>
      <select id="sexe">
        <option value="F" name="sexe">Femme</option>
        <option value="H" name="sexe">Homme</option>
      </select><br>
      <label for="comments">Pourquoi avez-vous décidé de vous inscrire sur MMG et non sur un autre?</label>
      <textarea id="comments"></textarea>
  </fieldset>
 
  <fieldset>
    <legend>Choisissez vos jeux favoris</legend>
    <label for="fortnite"><input id="fortnite" type="checkbox" name="jeux" value="fortnite"> Fortnite</label>
    <label for="LOL"><input id="LOL" type="checkbox" name="jeux" value="LOL"> LEAGUE Of LEGEND</label>
    <label for="COD"><input id="COD" type="checkbox" name="jeux" value="COD"> CALL OF DUTY</label>
    <label for="MH"><input id="MH" type="checkbox" name="jeux" value="MH"> MONSTER HUNTER</label>
    <label for="OV"><input id="OV" type="checkbox" name="jeux" value="OV"> OVERWATCH</label>
    <label for="RK"><input id="RK" type="checkbox" name="jeux" value="RK"> ROCKET LEAGUE</label>
    <label for="Among US"><input id="Among us" type="checkbox" name="jeux" value="Among US"> AMONG US</label>
    <label for="FIFA"><input id="FIFA" type="checkbox" name="jeux" value="FIFA"> FIFA 21</label>
  </fieldset>
  <p><input type="submit" value="Soummettre"></p>
</form>