<?php
	// session_start();
	if(isset($_POST['pseudo']))
	{
		header('Location: accueil.php');
	}
	$pseudo = $_SESSION['pseudo'];
		
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
						echo "<a href='signaler.php'><li class='onglet'> Signaler </li></a>";
					}
				?>
				<a href="MenuConsultation"><li class="onglet">
					Consulter</li></a>
				<a href="ClassementUtilisateurs"><li class="onglet">Classement utilisateurs</li></a>
				<a href="MenuMaladies"><li class="onglet">
					Maladies
					<!-- Sous-onglets, facultatifs...
					<ul>
						<a href="Maladie1"><li>
							Maladie1</li></a>
						<a href="Maladie2"><li>Maladie2</li></a>
						<a href="Maladie3"><li>Maladie3</li></a>
					</ul>
					-->
				</li></a>
				<?php if(!$_SESSION['pseudo'])
					{
						echo "<a href='connexion.php'><li class='onglet'>Connexion</li></a>";
					}
				?>
				<a href="inscription.php"><li class="onglet">Inscription</li></a>
				<!-- <a href="Pagesupprcompte"><li class="onglet">Supprimer son compte</li></a> -->
				<?php if($_SESSION['pseudo'])
					{
						echo "<a href='logout.php'><li class='onglet'>Déconnexion</li></a>";
					}
				?>
				
				<?php if($_SESSION['pseudo'])
					{
						echo "<a href='user_profil.php'><li class='onglet'> Gerer son compte </li></a>";
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
