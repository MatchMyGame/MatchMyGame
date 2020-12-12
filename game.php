<?php
session_start();
include('connexion.inc.php');
$bdd=connect();
$getuser = $bdd->query("SELECT discord,plateforme,description FROM user WHERE game REGEXP '\"".$_GET['jeu']."\"' ");
//var_dump($getuser->fetchAll());
/*while ($donnees = $getuser->fetch()) {
	echo '<p>'.$donnees['discord'].'-'. $donnees['plateforme'].'</p>';
}*/


?>

<!DOCTYPE html>
<html lang="fr">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>PTUT</title>
<link rel="stylesheet" href="style.css" />
<link rel="stylesheet" href="jeux.css" />

</head>

<div id="main">
	<body>
		<?php include('header.php') ?>


		<h2> <?php echo $_GET['jeu']; ?></h2>	

<?php
	while ($donnees = $getuser->fetch()) {
		echo '<div class="afficher_user">';

		echo	'<div class="info_user">'. '<p>'. 'Discord : '.$donnees['discord'].'</p>' .'</div>';
		echo  '<div class="info_user">' .'<p>' .'Plateforme: '.$donnees['plateforme']. '</p>' .'</div>';

		echo '<div class="info_user">' .'<p>' .'Description: '.$donnees['description']. '</p>' .'</div>';

		echo	'</div>';

	}
?>	
		












		
		<?php include('footer.php') ?>  
	 	
		
		</body>	
	</div>
</html>