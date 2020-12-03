<?php
session_start();
include('connexion.inc.php');
$bdd=connect();

if(!(isset($_SESSION['idUser']) AND !empty($_SESSION['idUser']))){
	Header("Location: login.php");
	die('Vous n\'êtes pas connecté !');
}
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
			<p>Salut <?=$_SESSION['prénom'];?> !</p>
		<?php include('footer.php') ?>  
		</body>	
	</div>
</html>