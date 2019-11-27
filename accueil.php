<?php
	session_start();
	if(isset($_POST['pseudo']))
	{
		header('Location: accueil.php');
	}
	$name = $_SESSION['pseudo'];
		
?>

<!DOCTYPE html>
<html>
<head>
	<title>Page d'accueil</title>
	<link href="accueil.css"  rel="stylesheet">
	<meta charset="utf-8" >
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
			<a href="signaler.php"><li class="onglet"> Signaler </li></a>
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
			<a href="connexion.php"><li class="onglet">Connexion</li></a>
			<a href="inscription.php"><li class="onglet">Inscription</li></a>
			<!-- <a href="Pagesupprcompte"><li class="onglet">Supprimer son compte</li></a> -->
			<a href="logout.php"><li class="onglet">Déconnexion</li></a>
			<a href="edit_profil.php"><li class="onglet"><?php echo"$name"; ?></li></a>
			
		</ul>
	</div>
		<img class="bandeau" src="fox4.jpg">
</header>	

<body>

	<?php echo("Bonjour, $name"); ?>
	<div class="corps">
	<h2>
		Bienvenue !
	</h2>
	<p> Bienvenue cher utilisateur ! </p>
	<p>
		Tu es sur un site collaboratif qui permet la collecte de nombreuses informations sur la localisation d'espèces nuisibles :
	</p>
	<ul>
		<li>
			Pour consulter les différentes signalisations déjà effectuées, pas besoin de t'inscrire, tu peux directement accéder à la page <a href="MenuConsultation">Consultation</a> et effectuer une recherche selon l'espèce ou la localisation désirée.
		</li>
	    <li>
	    	Pour pourvoir soumettre un signalement, il faut que tu te crées un profil, et que tu te connectes dessus. Ensuite, rendez-vous sur la page <a href="MenuSignalement">Signalement</a>
	    </li>
	    <li>
	    	Pour que l'expérience des inscrits soit plus sympathique, un système de <a href = "ClassementUtilisateur"> classement </a> existe : signale toutes les espèces nuisibles que tu vois pour te hisser en haut du podium !
	    </li>
	    <li>
	    	Nos utilisateurs ne sont pas les seuls à être classés ! Découvre le classement des <a href="ClassementEspeces"> espèces les plus signalées</a> sur le site !
	    </li>
    </ul>
    <p> C'est bien de signaler des espèces et de connaître leur localisation, mais à quoi ça sert ? </p>
    <p> Certaines espèces nuisibles recensées sur ce site sont des vecteurs de maladie ! Découvre comment t'en prémunir sur la page <a href="MenuMaladies">Maladies</a></p>
	</div>
</body>
	
<footer>
	<p class="disclaimer"> Nous ne sommes pas responsables de la véracité des informations saisies par les utilisateurs </p>

		<p> Nous contacter par mail: </p>
		<div>
			<ul>
			
				<li class="contacts">
					<address>  <a href="mailto:sarah.bonnet1@etu.univ-nantes.fr"> Sarah </a> </address>
				</li>
				<li  class="contacts">
					<address>  <a href="mailto:florence.thomas1@etu.univ-nantes"> Florence </a> </address>
				</li>
			</ul>
		</div>
	<p class="merci"> Merci de votre visite ! </p> 
</footer >

</html>
