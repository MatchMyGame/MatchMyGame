<?php
session_start();
include('connexion.inc.php');
$bdd=connect();

if(!(isset($_SESSION['idUser']) AND !empty($_SESSION['idUser']))){
	Header("Location: login.php");
	die('Vous n\'êtes pas connecté !');
}
	if(isset($_SESSION['idUser'])) {
	   $requser = $bdd->prepare("SELECT * FROM user WHERE idUser = ?");
	   $requser->execute(array($_SESSION['idUser']));
	   $user = $requser->fetch();
	   if(isset($_POST['newdiscord']) AND !empty($_POST['newdiscord']) AND $_POST['newdiscord'] != $user['discord']) {
	      $newpseudo = htmlspecialchars($_POST['newdiscord']);
	      $insertdiscord = $bdd->prepare("UPDATE user SET discord = ? WHERE idUser = ?");
	      $insertdiscord->execute(array($newpseudo, $_SESSION['idUser']));
	     
	   }
	   if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail']) {
	      $newmail = htmlspecialchars($_POST['newmail']);
	      $insertmail = $bdd->prepare("UPDATE user SET mail = ? WHERE idUser = ?");
	      $insertmail->execute(array($newmail, $_SESSION['idUser']));
	      
	   }
	   if(isset($_POST['plateforme2']) AND !empty($_POST['plateforme2'])){ 
	      $plat2 = json_encode($_POST['plateforme2']);
	      $insertplat = $bdd->prepare("UPDATE user SET plateforme = ? WHERE idUser = ?");
	      $insertplat->execute(array($plat2, $_SESSION['idUser']));
	   }
	    if(isset($_POST['jeux2']) AND !empty($_POST['jeux2'])){ 
          $jeux2 = json_encode($_POST['jeux2']);
	      $insertjeux = $bdd->prepare("UPDATE user SET game = ? WHERE idUser = ?");
	      $insertjeux->execute(array($jeux2, $_SESSION['idUser']));
	   }
	   if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
	   
	      if($_POST['newmdp1'] == $_POST['newmdp2']) {
	         $insertmdp = $bdd->prepare("UPDATE user SET password = ? WHERE idUser = ?");
	         $insertmdp->execute(array(password_hash($_POST['newmdp1'], PASSWORD_DEFAULT), $_SESSION['idUser']));
	         
	      } else {
	         $msg = "Vos deux mdp ne correspondent pas !";
	      }
	   }
	   
//$getps4user = $bdd->query("SELECT * FROM user WHERE plateforme REGEXP '\"PS4\"'");
//var_dump($getps4user->fetchAll());
?>
<!DOCTYPE html>
<html lang="fr">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>PTUT</title>
<link rel="stylesheet" href="styles.css" />

</head>

<div id="main">
	<body>
		<?php include('header.php') ?>
			<p>Bienvenue <?=$_SESSION['prénom'];?> !</p>
			Pseudo discord : <?=$_SESSION['discord'];?><br />
			Mail : <?=$_SESSION['mail'];?><br />
			Les plateformes sur lesquelles vous jouez :<br />
			<ul>
			<?php
			foreach (json_decode($_SESSION['plateforme'],1) as $p) {
				echo "<li>".$p.'</li>';
			} 
			?>
			</ul>
			<p>Les jeux auquelles vous jouez :</p> <br />
			<?php
			foreach (json_decode($_SESSION['game'],1) as $g) {
				echo "<li>".$g.'</li>';
			} 
			?>
			<a href="deconnexion.php">Se déconnecter</a>

			<form class="inscription"  action="" method="post">
				<fieldset>
				    <?php 
				    if (isset($error)){
				          echo $error;
				    
				    } 
				    if (isset($success)){
				          echo $success;
				    
				    }
				    ?>
				    <p><i>Vous pouvez modifier votre mot de passe, modifier les jeux auquels vous jouez ainsi que les plateformes sur lesquelles vous jouez</i></p>
				    


				      <div class="form">
				        <label>Discord</label>
				        <input class="form-input" placeholder="Discord" value="" name="newdiscord" type="text" autofocus="">
				      </div>
				      <br>
				      <br>

				      <div class="form">
        				<label>Adresse mail</label>
        				<input class="form-input" placeholder="Adresse mail" name="newmail" value="" type="mail" autofocus="">
     				 </div>
     				 <br>
				     <br>

				      <div class="form">
				        <label>Nouveaux mot de passe</label>
				        <input class="form-input" placeholder="Confirmer le mot de passe" name="newmdp1" type="password" value="">
				      </div>
				      <br>
				      <br> 

				      <div class="form">
				        <label>Confirmez votre nouveau mot de passe</label>
				        <input class="form-input" placeholder="Confirmer le mot de passe" name="newmdp2" type="password" value="">
				      </div> 
				      <br>
				      <br>

				      <div>
				          <legend>Renseigner vos plateformes</legend> 
				          <br>
				            <label for="PS4"><input id="fortnite" type="checkbox" name="plateforme2[]" value="PS4"> PS4</label>
				            <label for="PC"><input id="LOL" type="checkbox" name="plateforme2[]" value="PC"> PC</label>
				            <label for="XBOX ONE"><input id="COD" type="checkbox" name="plateforme2[]" value="XBOX ONE"> XBOX ONE</label>
				            <label for="SWITCH"><input id="MH" type="checkbox" name="plateforme2[]" value="SWITCH">SWITCH</label>
				            <label for="PS5"><input id="OV" type="checkbox" name="plateforme2[]" value="PS5"> PS5</label>
				            
				          
				      </div>
				      <br>
				      <br>
				    
				    <div>
				      <legend>Choissisez vos jeux</legend>
				      <br>
				      <label for="fortnite"><input id="fortnite" type="checkbox" name="jeux2[]" value="Fortnite"> Fortnite</label>
				      <label for="LOL"><input id="LOL" type="checkbox" name="jeux2[]" value="LOL"> LEAGUE Of LEGEND</label>
				      <label for="COD"><input id="COD" type="checkbox" name="jeux2[]" value="COD"> CALL OF DUTY</label>
				      <label for="MH"><input id="R6" type="checkbox" name="jeux2[]" value="R6"> Rainbow six siege</label>
				      <label for="OV"><input id="OV" type="checkbox" name="jeux2[]" value="OV"> OVERWATCH</label>
				      <label for="RK"><input id="RK" type="checkbox" name="jeux2[]" value="RL"> ROCKET LEAGUE</label>
				      <label for="Among US"><input id="Among us" type="checkbox" name="jeux2[]" value="among"> AMONG US</label>
				      <label for="FIFA"><input id="FIFA" type="checkbox" name="jeux2[]" value="FIFA"> FIFA 21</label>
				    </div>
				    <br> 
				     <br>
				    
				    <input type="submit"  value="Changer mes informations">


				  </fieldset>

				
			</form>
			 <?php if(isset($msg)) { echo $msg; } ?>

		<?php include('footer.php') ?>  
		</body>	
	</div>
</html>
<?php   
	}
	else {
	   header("Location: login.php");
	}