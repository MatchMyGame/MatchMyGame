<?php
session_start();
include('connexion.inc.php');
$bdd=connect();
$getuser = $bdd->query("SELECT discord,plateforme,description FROM user WHERE game REGEXP '\"".$_GET['jeu']."\"' ");
//var_dump($getuser->fetchAll());
/*while ($donnees = $getuser->fetch()) {
	echo '<p>'.$donnees['discord'].'-'. $donnees['plateforme'].'</p>';
}*/
$nomJeux = array('R6' => 'Rainbow Six Siege' ,'LOL' => 'League of Legends','COD' => 'Call of Duty','OV' => 'Overwatch','among' => 'Among Us','RL' => 'Rocket League','fortnite' => 'Fortnite', );

?>

<!DOCTYPE html>
<html lang="fr">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<title>PTUT</title>
<link rel="stylesheet" href="style.css" />
<link rel="stylesheet" href="jeux.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css"> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>



</head>

<div id="main">
	<body>
		<?php include('header.php') ?>


		<h2> <?php echo $nomJeux[$_GET['jeu']]; ?></h2>	
		<br>
	
<table id="table">
	<thead>
		
		<th>Discord</th>
		<th>Plateforme</th>
		<th>Description</th>
		
	</thead>
	<?php
	while ($donnees = $getuser->fetch()) {
	echo '<tr>' ;
	echo	'<td>'.$donnees['discord'].'</td>';
	echo	'<td>'.$donnees['plateforme'].'</td>';
	echo	'<td>'.$donnees['description'].'</td>';				
	echo '</tr>';
}
	?>
</table>		









		
		<?php include('footer.php') ?>  

	 	<script type="text/javascript">
	 		$(document).ready( function () {
    			$('#table').DataTable({
    				searching:true,
    			 	
    			});
			} );
			$('#table').DataTable({ 
				pagingType: "simple_numbers",
				lengthMenu:[10,15,20,25],
				pageLength: 10,
    			language: { 
    				sProcessing: "Traitement en cours ...", 
    				sLengthMenu: "Afficher _MENU_ lignes", 
    				sZeroRecords: "Aucun résultat trouvé", 
    				sEmptyTable: "Aucune donnée disponible", 
    				sInfo: "Lignes _START_ à _END_ sur _TOTAL_", 
    				sInfoEmpty: "Aucune ligne affichée", 
    				sInfoFiltered: "(Filtrer un maximum de_MAX_)", 
    				sInfoPostFix: "", 
    				sSearch: "Chercher:", 
    				sUrl: "", 
    				sInfoThousands: ",", 
    				sLoadingRecords: "Chargement...", 
    				oPaginate: { 
     					sFirst: "Premier", "sLast": "Dernier", "sNext": "Suivant", "sPrevious": "Précédent" 
    				}, 
    				oAria: { 
     					sSortAscending: ": Trier par ordre croissant", "sSortDescending": ": Trier par ordre décroissant" 
    				} 
    			} 
		}); 
	 	</script>
		
		</body>	
	</div>
</html>