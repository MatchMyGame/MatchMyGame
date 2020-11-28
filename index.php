<?php /*
include('connexion.inc.php');
$bdd=connect();
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
<title>PTUT</title>
<link rel="stylesheet" href="PTUT.css" />


</head>

<div id="main">
	<body>
		
		<?php include('header.php') ?>
	
	<a href="connection.php">Se connecter</a>

	
		
		    <p>Bonjour à tout les gamers vous voici dans MMG---->(Match My Game) un site de rencontre dans le domaine des jeux videos.</p>
		    <p>Si vous avez des difficultées a vous faire des amis mais que vous adorer jouer au jeux videos alors ce site est fait pour vous!</p>
		    <p>Le principe est simple ils vous suffient de renseigner votre pseudos, les plateformes sur lesquelles vous jouez et les jeux auquels vous jouez.</p>
		    <p> Une fois inscrit le tour est joué et vous pouvez faire de nouvelle rencontre.   






























	 
		  <footer>
		  	<div id="footer"> 
				<p class="fin">	
					<a href="#changer">Mentions légales </a>
					<a href="#contacter"s>Nous contacter</a>
				</p>
		    </div> 
	      </footer>		
		
		</body>	
	</div>
</html>