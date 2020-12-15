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
<title>MatchMyGame</title>
<link rel="stylesheet" href="styles.css" />


</head>

<div id="main">
	<body>
		
		<?php include('header.php') ?>
	
	<a href="login.php">Se connecter</a>

	
		
		    <p>Bonjour à tous les gamers bienvenue sur MMG---->(Match My Game) un site de rencontre dans le domaine des jeux videos.</p>
		    <p>Si vous avez des difficultées a vous faire des amis mais que vous adorez jouer au jeux videos alors ce site est fait pour vous!</p>
		    <p>Le principe est simple, il suit de vous inscrire.</p>
		    <p> Une fois inscrit le tour est joué et vous pouvez faire de nouvelle rencontre. </p>  




















	 
		 <?php include('footer.php') ?>
		</body>	
	</div>
</html>