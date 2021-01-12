<!DOCTYPE html>
<html lang="fr">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<link rel="stylesheet" href="contact.css" />
<link rel="stylesheet" href="styles.css" />
<link rel="stylesheet" href="style2.css" />
</head>

<div id="main">
	<body>
		
		<?php include('header.php') ?>

		
  		<div class="contenir">  
           <form id="contact" action="" method="post">
           <h3>MMG Page De Contact</h3>
           <h4>Vous pouvez nous contacter afin de nous faire de vos remarques</h4>
               <fieldset>
               <input placeholder="Votre nom" type="text" tabindex="1" required autofocus>
               </fieldset>
               <fieldset>
               <input placeholder="Votre adresse mail" type="email" tabindex="2" required>
               </fieldset>
               <fieldset>
      		   <input placeholder="Votre numéro de mobile (optionel)" type="tel" tabindex="3" required>
    		   </fieldset>
               <fieldset>
               <textarea placeholder="Ecrivez votre message  ici...." tabindex="5" required></textarea>
               </fieldset>
               <fieldset>
               <button name="Envoyer" type="Envoyez" id="contact-submit" data-submit="...Envoyez">Envoyer</button>
               </fieldset>
               <p class="copyright">Développé par Enzo et Damien</p>
          </form>
        </div>
  
		<?php include('footer.php') ?>
		</body>	
	</div>
</html>
