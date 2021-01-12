<?php 
session_start();
include('connexion.inc.php');
$bdd=connect();
/*
$getUser=$bdd->query('SELECT * FROM user');
var_dump ($getUser->errorInfo()); 
foreach ($getUser->fetchAll() as $data) {
	echo $data['mail'];
}*/
?>


<!DOCTYPE html>
<html lang="fr">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>Match My Game</title>
<link rel="stylesheet" href="styles.css" />
<link rel="stylesheet" href="style2.css" />


</head>

<div id="main">
	<body>
		
		<?php include('header.php') ?>
		<!--<button onclick="window.location.href = 'login.php';">Se connecter</button>-->
	
        
		<img id="logo" src="image/logo.jpg">
		<br>
		<br>
		<div  id="presentation">
		    <p>Bonjour à tous les gamers bienvenue sur Match My Game un site de rencontre dans le domaine des jeux videos.
		    Si vous avez des difficultés a vous faire des amis mais que vous adorez jouer au jeux videos alors ce site est fait pour vous!
		    N'hésitez pas! Inscrivez-vous pour rencontrer des joueurs du monde entier!
		    
		    </p>  
		</div>

		<div id="images">
			<div class="img_index">

				<img class="img_jeux" src="image/game.jpg">
				

			</div>

			<div class="img_index">

				<img class="img_jeux" src="image/gamer.jpg">
				

			</div>
			<div class="img_index">

				<img class="img_jeux" src="image/tournoi.jpg">
				

			</div>
			<div class="img_index">

				<img class="img_jeux" src="image/gam.jpg">
				

			</div>
			<div class="img_index">

				<img class="img_jeux" src="image/amis.jpg">
				

			</div>
		</div>



















	 
		 <?php include('footer.php') ?>
		</body>	
	</div>
</html>