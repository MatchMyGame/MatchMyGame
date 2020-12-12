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
<link rel="stylesheet" href="style.css" />

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

		<?php include('footer.php') ?>  
		</body>	
	</div>
</html>