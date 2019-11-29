<?php
	// session_start();
	if($_SESSION)
	{
		$pseudo = $_SESSION['pseudo'];	
	}
?>

<!DOCTYPE html>
<html>
	<head>
    	<meta charset="utf-8">
   		<link href="accueil.css"  rel="stylesheet">
	</head>

	<header>
		<a href="accueil.php" class="retouraccueil">
			<div class="bandeau">
				<h1>Nuisibizzbizz</h1> <!--Titre du site-->
			</div>
		</a>
		<div class="MenuHaut">
			<ul >
				<a href="accueil.php"><li class="onglet"> Accueil </li></a>
				<?php if($_SESSION['pseudo'])
					{
						echo "<a href='signaler.php'><li class='onglet'>Signaler </li></a>";
					}
				?>
				<a href="consulter.php">
					<li class="onglet">Consulter
						<ul>
							<a href="consulter_sp.php"><li>Espèces</li></a>
							<a href="consulter_lieu.php"><li>Lieux</li></a>
							<a href="consulter_ill.php"><li>Maladies</li></a>
							<a href="consulter_nuisance.php"><li>Nuisances</li></a>
							
						</ul>
					</li></a>
				<a href="classementuser.php"><li class="onglet">Classement utilisateurs</li></a>
				<?php if(!($_SESSION['pseudo']))
					{
						echo "<a href='connexion.php'><li class='onglet'>Connexion</li></a>";
					}
				?>
				<?php if(!($_SESSION['pseudo']))
					{
						echo "<a href='inscription.php'><li class='onglet'>Inscription</li></a>";
					}
				?>			
				<?php if($_SESSION['pseudo'])
					{
						echo "<a href='user_profil.php'><li class='onglet'>Gerer son compte
								<ul>
								<a href='user_profil.php'><li>
									Modifier son profil</li></a>
								<a href='logout.php'><li>Déconnexion</li></a>
								<a href='supprcompte.php'><li>Supprimer sont compte</li></a>
						</ul></li></a>";
					}
				?>
				<?php if(($_SESSION['pseudo']) && ($pseudo == "Admin"))
				{
					echo "<a href='usergestionforadmin.php'><li class='onglet'> Administration </li></a>";
				}
				?>
					
				
			</ul>
		</div>
			<img class="bandeau" src="fox4.jpg">
	</header>
</html>
