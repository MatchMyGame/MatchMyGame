<?php
session_start();
include('connexion.inc.php');
$bdd=connect();

if(!(isset($_SESSION['idUser']) AND !empty($_SESSION['idUser']))){
	Header("Location: login.php");
	die('Vous n\'êtes pas connecté !');
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
				        <label>Mot de passe actuel</label>
				        <input class="form-input" placeholder="Mot de passe" name="password" type="password" value="">
				      </div>

				      <div class="form">
				        <label>Nouveaux mot de passe</label>
				        <input class="form-input" placeholder="Confirmer le mot de passe" name="password1" type="password" value="">
				      </div> 

				      <div class="form">
				        <label>Confirmez votre nouveau mot de passe</label>
				        <input class="form-input" placeholder="Confirmer le mot de passe" name="password2" type="password" value="">
				      </div> 

				      <div>
				          <label for="plateforme">Renseigner vos plateformes</label> <br>
				          
				            <label for="PS4"><input id="fortnite" type="checkbox" name="plateforme[]" value="PS4"> PS4</label>
				            <label for="PC"><input id="LOL" type="checkbox" name="plateforme[]" value="PC"> PC</label>
				            <label for="XBOX ONE"><input id="COD" type="checkbox" name="plateforme[]" value="XBOX ONE"> XBOX ONE</label>
				            <label for="SWITCH"><input id="MH" type="checkbox" name="plateforme[]" value="SWITCH">SWITCH</label>
				            <label for="PS5"><input id="OV" type="checkbox" name="plateforme[]" value="PS5"> PS5</label>
				            <label for="XBOX SERIE X"><input id="RK" type="checkbox" name="plateforme[]" value="XBOX SERIE X"> XBOX SERIE X</label>
				            <label for="XBOX SERIE S"><input id="Among us" type="checkbox" name="plateforme[]" value="XBOX SERIE S"> XBOX SERIE S</label>
				          
				      </div>
				    
				    <div>
				      <legend>Choissisez vos jeux</legend>
				      <label for="fortnite"><input id="fortnite" type="checkbox" name="jeux[]" value="Fortnite"> Fortnite</label>
				      <label for="LOL"><input id="LOL" type="checkbox" name="jeux[]" value="LOL"> LEAGUE Of LEGEND</label>
				      <label for="COD"><input id="COD" type="checkbox" name="jeux[]" value="COD"> CALL OF DUTY</label>
				      <label for="MH"><input id="R6" type="checkbox" name="jeux[]" value="R6"> Rainbow six siege</label>
				      <label for="OV"><input id="OV" type="checkbox" name="jeux[]" value="OV"> OVERWATCH</label>
				      <label for="RK"><input id="RK" type="checkbox" name="jeux[]" value="RL"> ROCKET LEAGUE</label>
				      <label for="Among US"><input id="Among us" type="checkbox" name="jeux[]" value="among"> AMONG US</label>
				      <label for="FIFA"><input id="FIFA" type="checkbox" name="jeux[]" value="FIFA"> FIFA 21</label>
				    </div>
				    
				    <input type="submit" name="changement" value="Changer mes informations">


				  </fieldset>

				
			</form>

		<?php include('footer.php') ?>  
		</body>	
	</div>
</html>