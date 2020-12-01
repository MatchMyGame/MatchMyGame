<?php
session_start();
include('connexion.inc.php');
$bdd=connect(); 



if(isset($_POST['mail']) AND isset($_POST['password1']) AND isset($_POST['password2']) AND isset($_POST['discord']) AND !empty($_POST['mail']) AND !empty($_POST['password1']) AND !empty($_POST['password2']) AND !empty($_POST['discord'])) {
  $email = htmlspecialchars($_POST['mail']);
  $getmatchinguser = $bdd->query("SELECT * FROM user WHERE `mail` = '$email'");
  
  if($getmatchinguser->rowCount() == 0){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $discord = htmlspecialchars($_POST['discord']);
      $getmatchinguserbyusername = $bdd->query("SELECT * FROM user WHERE `discord` = '$discord'");
      if($getmatchinguserbyusername->rowCount() == 0){
          if($_POST['password1'] == $_POST['password2']){
            $adduser = $bdd->prepare("INSERT INTO user (discord,password,mail) VALUES(?,?,?)");
            $adduser->execute(array($discord,password_hash($_POST['password1'], PASSWORD_DEFAULT),$email));
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

  

    // On met les variables utilisé dans le code PHP à FALSE (C'est-à-dire les désactiver pour le moment).
    /*$error = FALSE;
    $registerOK = FALSE;

        // On regarde si l'utilisateur est bien passé par le module d'inscription
        if(isset($_POST["inscription"])){
            
            // On regarde si tout les champs sont remplis, sinon, on affiche un message à l'utilisateur.
            if($_POST["discord"] == NULL OR $_POST["mail"] == NULL OR $_POST["password1"] == NULL OR $_POST["password2"] == NULL){
                
                // On met la variable $error à TRUE pour que par la suite le navigateur sache qu'il y'a une erreur à afficher.
                $error = TRUE;
                
                // On écrit le message à afficher :
                $errorMSG = "Tout les champs doivent être remplis !";
                    
            }
            
            // Sinon, si les deux mots de passes correspondent :
            elseif($_POST["password1"] == $_POST["password2"]){
                
                // On regarde si le mot de passe et le nom de compte n'est pas le même
                if($_POST["mail"] != $_POST["password1"]){
                    
                    // Si c'est bon on regarde dans la base de donnée si le nom de compte est déjà utilisé :
                    $sql = "SELECT mail FROM user WHERE mail = '".$_POST["mail"]."' ";
                    $sql = mysql_query($sql);
                // On compte combien de valeur à pour nom de compte celui tapé par l'utilisateur.
                $sql = mysql_num_rows($sql);
                
                   // Si $sql est égal à 0 (c'est-à-dire qu'il n'y a pas de nom de compte avec la valeur tapé par l'utilisateur
                   if($sql == 0){
                   
                      // Si tout va bien on regarde si le mot de passe n'exède pas 60 caractères.
                      if(strlen($_POST["password1"] < 60)){
                      
                         // Si tout va bien on regarde si le nom de compte n'exède pas 60 caractères.
                         if(strlen($_POST["mail"] < 60)){
                         
                            // Si le nom de compte et le mot de passe sont différent :
                            if($_POST["mail"] != $_POST["password1"]){
                         
                               // Si tout ce passe correctement, on peut maintenant l'inscrire dans la base de données :
                               $sql = "INSERT INTO user (discord,mail,password) VALUES ('".$_POST["discord"]."','".$_POST["mail"]."','".$_POST["password"]."')";
                               $sql = mysql_query($sql);
                               
                               // Si la requête s'est bien effectué :
                               if($sql){
                               
                                  // On met la variable $registerOK à TRUE pour que l'inscription soit finalisé
                                  $registerOK = TRUE;
                                  // On l'affiche un message pour le dire que l'inscription c'est bien déroulé :
                                  $registerMSG = "Inscription réussie ! Vous êtes maintenant membre du site.";
                                  
                                  // On le met des variables de session pour stocker le nom de compte et le mot de passe :
                                  $_SESSION["mail"] = $_POST["mail"];
                                  $_SESSION["password"] = $_POST["password1"];
                                  
                                  // Comme un utilisateur est différent, on crée des variables de sessions pour "varier" l'utilisateur comme ceci :
                                  // echo $_SESSION["login"]; (bien entendu avec les balises PHP, sinons cela ne marchera pas.
                               
                               }
                               
                               // Sinon on l'affiche un message d'erreur (généralement pour vous quand vous testez vos scripts PHP)
                               else{
                               
                                  $error = TRUE;
                                  
                                  $errorMSG = "Erreur dans la requête SQL<br/>".$sql."<br/>";
                               
                               }
                            
                            }
                            
                            // Sinon on fais savoir à l'utilisateur qu'il a mis un nom de compte trop long.
                            else{
                            
                               $error = TRUE;
                               
                               $errorMSG = "Votre nom compte ne doit pas dépasser <strong>60 caractères</strong> !";
                               
                               $login = NULL;
                               
                               $pass = $_POST["password1"];
                            
                            }
                         
                         }
                      
                      }
                      
                      // Si le mot de passe dépasse 60 caractères on le fait savoir
                      else{
                      
                         $error = TRUE;
                         
                         $errorMSG = "Votre mot de passe ne doit pas dépasser <strong>60 caractères</strong> !";
                         
                         $login = $_POST["mail"];
                         
                         $pass = NULL;
                      
                      }
                   
                   }
                   
                   // Sinon on affiche un message d'erreur lui disant que ce nom de compte est déjà utilisé.
                   else{
                   
                      $error = TRUE;
                      
                      $errorMSG = "Le nom de compte <strong>".$_POST["mail"]."</strong> est déjà utilisé !";
                      
                      $login = NULL;
                      
                      $pass = $_POST["password1"];
                   
                   }
                }
                
                // Sinon on fais savoir à l'utilisateur qu'il doit changer le mot de passe ou le nom de compte
                else{
                    
                    $error = TRUE;
                    
                    $errorMSG = "Le nom de compte et le mot de passe doivent êtres différents !";
                    
                }
                
            }
          
          // Sinon si les deux mots de passes sont différents :      
          elseif($_POST["password1"] != $_POST["password2"]){
          
             $error = TRUE;
             
             $errorMSG = "Les deux mots de passes sont différents !";
             
             $login = $_POST["mail"];
             
             $pass = NULL;
          
          }
          
          // Sinon si le nom de compte et le mot de passe ont la même valeur :
          elseif($_POST["mail"] == $_POST["password1"]){
          
             $error = TRUE;
             
             $errorMSG = "Le nom de compte et le mot de passe doivent être différents !";
          
          }
            
        }

    ?>

    <?php

       mysql_close($BDD);

    ?>

    <?php // On affiche les erreurs :
       if($error == TRUE){ echo "<p>".$errorMSG."</p>"; }
    ?>
    <?php // Si l'inscription s'est bien déroulée on affiche le succès :
       if($registerOK == TRUE){ echo "<p><strong>".$registerMSG."</strong></p>"; }
    ?>*/


    
?>

<!DOCTYPE html>
<html lang="fr">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<link rel="stylesheet" href="PTUT.css" />

<?php include('header.php') ?>



<h2>Formulaire d'inscription </h2>

<form action="" method="post">
  <fieldset>
    <p><i>Complétez le formulaire. Tout les champs marqué sont obligatoires.</i></p>
    
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
          
            <label for="PS4"><input id="fortnite" type="checkbox" name="Plateforme" value="PS4"> PS4</label>
            <label for="PC"><input id="LOL" type="checkbox" name="Plateforme" value="PC"> PC</label>
            <label for="XBOX ONE"><input id="COD" type="checkbox" name="Plateforme" value="XBOX ONE"> XBOX ONE</label>
            <label for="SWITCH"><input id="MH" type="checkbox" name="Plateforme" value="SWITCH">SWITCH</label>
            <label for="PS5"><input id="OV" type="checkbox" name="Plateforme" value="PS5"> PS5</label>
            <label for="XBOX SERIE X"><input id="RK" type="checkbox" name="Plateforme" value="XBOX SERIE X"> XBOX SERIE X</label>
            <label for="XBOX SERIE S"><input id="Among us" type="checkbox" name="Plateforme" value="XBOX SERIE S"> XBOX SERIE S</label>
          
      </div>
      <div>
        <label for="comments">Pourquoi avez-vous décidé de vous inscrire sur MMG</label>
        <textarea id="comments"></textarea>
      </div>
    
   
    <div>
      <legend>Choisissez vos jeux favoris</legend>
      <label for="fortnite"><input id="fortnite" type="checkbox" name="jeux" value="fortnite"> Fortnite</label>
      <label for="LOL"><input id="LOL" type="checkbox" name="jeux" value="LOL"> LEAGUE Of LEGEND</label>
      <label for="COD"><input id="COD" type="checkbox" name="jeux" value="COD"> CALL OF DUTY</label>
      <label for="MH"><input id="MH" type="checkbox" name="jeux" value="MH"> MONSTER HUNTER</label>
      <label for="OV"><input id="OV" type="checkbox" name="jeux" value="OV"> OVERWATCH</label>
      <label for="RK"><input id="RK" type="checkbox" name="jeux" value="RK"> ROCKET LEAGUE</label>
      <label for="Among US"><input id="Among us" type="checkbox" name="jeux" value="Among US"> AMONG US</label>
      <label for="FIFA"><input id="FIFA" type="checkbox" name="jeux" value="FIFA"> FIFA 21</label>
    </div>
    
    <input type="submit" name="inscription" value="Je crée mon compte!">


  </fieldset>
</form>
    <a href="connection.php"> J'ai dejà un compte </a>





    <?php include('footer.php') ?>

</html>