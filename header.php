<header> 

		<div id="menu-nav">
		  <div id="navigation-bar">
		    <ul>
		    	
		      		<li><a href="index.php"><i class="fa fa-home"></i><span>Accueil</span></a></li>

		     		<li><a href="compte.php"><i class="fa fa-rss"></i> <span>A propos</span></a></li>
			  	
		      		<li><a href="jeux.php"><i class="fa fa-handshake"></i><span>Jeux</span></a></li>
		    	
			  		<li><a href="compte.php"><i class="fa fa-rss"></i> <span>Mon compte</span></a></li>
			  		<?php if (isset($_SESSION['idUser'])) {
			  				

			  			?>
			  			<li><a href="#"><i class="fa fa-rss"></i> <span><?=$_SESSION['prénom'];?></span></a></li>
			  			<?php
			  			}
			  			else{ 
			  			?>
			  					  		
			  		<li><a href="login.php"><i class="fa fa-rss"></i> <span>Se Connecter</span></a></li>
			  		<?php
			  	};
			  		 ?>

		    </ul>
		  </div>
  		</div>
		  <h1 class="titre">Match My Game</h1>

		 </header>