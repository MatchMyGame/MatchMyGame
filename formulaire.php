<?php
session_start();
include('connexion.inc.php');
$bdd=connect(); 
// var_dump($adduser->errorInfo());


if(isset($_POST['mail']) AND isset($_POST['password1']) AND isset($_POST['prénom']) AND !empty($_POST['prénom']) AND isset($_POST['password2']) AND isset($_POST['discord']) AND !empty($_POST['mail']) AND !empty($_POST['password1']) AND !empty($_POST['password2']) AND !empty($_POST['discord'])) {
  $email = htmlspecialchars($_POST['mail']);
  $getmatchinguser = $bdd->query("SELECT * FROM user WHERE `mail` = '$email'");
  
  if($getmatchinguser->rowCount() == 0){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $discord = htmlspecialchars($_POST['discord']);
      $getmatchinguserbyusername = $bdd->query("SELECT * FROM user WHERE `discord` = '$discord'");
      if($getmatchinguserbyusername->rowCount() == 0){
          if($_POST['password1'] == $_POST['password2']){
            if(isset($_POST['plateforme']) AND !empty($_POST['plateforme']) AND isset($_POST['jeux']) AND !empty($_POST['jeux'])){
                $plat = json_encode($_POST['plateforme']);
                $jeux = json_encode($_POST['jeux']);
                 $adduser = $bdd->prepare("INSERT INTO user (discord,password,mail,prénom,plateforme,game,description) VALUES(?,?,?,?,?,?,?)");
                $adduser->execute(array($discord,password_hash($_POST['password1'], PASSWORD_DEFAULT),$email,htmlspecialchars($_POST['prénom']),$plat,$jeux,htmlspecialchars($_POST['description'])));
            }else{
              $error = "Choisissez au moins une plateforme et un jeu !";
            }
            if($adduser){
              $success = "Compte créé !";
            }else{
              $error = "Une erreur est survenue.";
            }
          }else{
            $error = "Les mots de passe ne correspondent pas.";
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
<link rel="stylesheet" href="styles.css" />
<link rel="stylesheet" href="formulaire.css" />
<?php include('header.php') ?>

<h2>Formulaire d'inscription </h2>

<form class="inscription" action="" method="post">
  <fieldset>
    <?php 
    if (isset($error)){
          echo $error;
    
    } 
    if (isset($success)){
          echo $success;
    
    }
    ?>
   
    

      <div class="form">
        <label>Prénom</label>
        <input class="form-input" placeholder="Prénom" value="<?php if(isset($_POST['prénom'])){echo $_POST['prénom'];}?>" name="prénom" type="text" autofocus="">
      </div>

      <div class="form">
        <label>Discord</label>
        <input class="form-input" placeholder="Discord" value="<?php if(isset($_POST['discord'])){echo $_POST['discord'];}?>" name="discord" type="text" autofocus="">
      </div>

      <div class="form">
        <label>Adresse mail</label>
        <input class="form-input" placeholder="Adresse mail" name="mail" value="<?php if(isset($_POST['mail'])){echo $_POST['mail'];}?>" type="mail" autofocus="">
      </div>

      <div class="form">
        <label>Mot de passe</label>
        <input class="form-input" placeholder="Mot de passe" name="password1" type="password" value="">
      </div>

      <div class="form">
        <label>Confirmez votre mot de passe</label>
        <input class="form-input" placeholder="Confirmer le mot de passe" name="password2" type="password" value="">
      </div> 

      <div>
          <label for="plateforme">Renseigner vos plateformes</label> <br>
          
            <label for="PS4"><input id="fortnite" type="checkbox" name="plateforme[]" value="PS4"> PS4</label>
            <label for="PC"><input id="LOL" type="checkbox" name="plateforme[]" value="PC"> PC</label>
            <label for="XBOX ONE"><input id="COD" type="checkbox" name="plateforme[]" value="XBOX ONE"> XBOX ONE</label>
            <label for="SWITCH"><input id="MH" type="checkbox" name="plateforme[]" value="SWITCH">SWITCH</label>
            <label for="PS5"><input id="OV" type="checkbox" name="plateforme[]" value="PS5"> PS5</label>
            <label for="XBOX SERIE S"><input id="Among us" type="checkbox" name="plateforme[]" value="XBOX SERIE"> XBOX SERIE</label>
          
      </div>
       <p><i>Décrivez-vous (cette desrciption sera visible par tous), n'hésitez pas à renseigner vôtre niveau</i></p>
      <div>
        
        <textarea id="description" name="description" ></textarea>
      </div>
    
   
    <div>
      <legend>Choisissez vos jeux favoris</legend>
      <label for="fortnite"><input id="fortnite" type="checkbox" name="jeux[]" value="Fortnite"> Fortnite</label>
      <label for="LOL"><input id="LOL" type="checkbox" name="jeux[]" value="LOL"> League of Legend</label>
      <label for="COD"><input id="COD" type="checkbox" name="jeux[]" value="COD"> Call of Duty</label>
      <label for="MH"><input id="R6" type="checkbox" name="jeux[]" value="R6"> Rainbow Six Siege</label>
      <label for="OV"><input id="OV" type="checkbox" name="jeux[]" value="OV"> Overwatch</label>
      <label for="RK"><input id="RK" type="checkbox" name="jeux[]" value="RL"> Rocket League</label>
      <label for="Among US"><input id="Among us" type="checkbox" name="jeux[]" value="among"> Among US</label>
      <label for="FIFA"><input id="FIFA" type="checkbox" name="jeux[]" value="FIFA"> FIFA 21</label>
    </div>
    <div id="mention">
      <label for=""><input type="checkbox" value="politique" required="required"> En cliquant sur ce bouton vous acceptez nôtre <a href="confidentialité.html">politique de confidentialité</a> mais également les <a href="legales.html">mentions légales</a></label> <br>
    </div>
    <input type="submit" name="inscription" value="Je crée mon compte!">


  </fieldset>
</form>
    <a href="login.php"> J'ai dejà un compte </a>





    <?php include('footer.php') ?>

</html>