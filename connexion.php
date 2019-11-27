<?php

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	include_once("myparam.inc.php");
	if(!empty($_POST))
	{
		$pseudoError = null;
		$mdpError = null;

		$pseudo = $_POST['pseudo'];
		$mdp = $_POST['mdp'];

		$valid = true;

		if(empty($pseudo))
		{
			$pseudoErreur = 'Veuillez entrer un pseudo.';
			$valid = false;
		}
		if(empty($mdp))
		{
			$mdpErreur = 'Veuillez entrer un pseudo.';
			$valid = false;
		}

		if($valid)
		{
			$mdp = md5($mdp);
			$connect = mysqli_connect(MYHOST, MYUSER, MYPASS, DBNAME) or die ("Problème de connexion à la base de données");
			$sql = "SELECT pseudo FROM personne WHERE pseudo = '".$pseudo."' AND mot_de_passe = '".$mdp."';";
			$requete = mysqli_query($connect,$sql);

			if(mysqli_num_rows($requete) == 0)
			{
				echo "Le pseudo ou le mot de passe que vous avez entrés sont erronnés ou n'existent pas dans la base de données. Veuillez recommencer ou vous inscrire.";
	        }
	        else
	        {
			if(isset($_POST['pseudo']))
			{
			    	session_start();
	        		$_SESSION['pseudo'] = $pseudo;
	        		echo("Vous êtes connecté.");
	        		header('Location: ./accueil.php');
			}
			}
		}
	}


// connexion à la base de données : myparam.inc.php
//
// $requete = mysqli_query($connect, "SELECT * FROM personne WHERE pseudo = '".pseudo."' AND mot_de_passe = '".$mdp."';");

// si mysqli_num_rows($connect) != 0) // mysqli_PHP/index.php_num_rows : compte le nombre de résultat de la requête. 1 s'il y a un résultat
// stocker les variables siimples dans des variables de sessions qui sera valable sur toutes les pages du site $_SESSION['pseudo'] = $pseudo;
// header('Location: ./acceP_PHP/index.phpuil.php'); // permet de rediriger l'utilisateur vers la page d'acceuil une fois connecté/inscrit

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link href="accueil.css" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<title>Connexion</title>
</head>

<header>
	<a href="Pageaccueil.html" class="retouraccueil">
		<div class="bandeau">
			<h1>Nuisibizzbizz</h1> <!--Titre du site-->
		</div>
	</a>
	<div class="MenuHaut">
		<ul >
			<a href="Pageaccueil.html"><li class="onglet"> Accueil </li></a>
			<a href="MenuSignalement"><li class="onglet"> Signaler </li></a>
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
					<a href="MenuConnexion"><li class="onglet">
						Connexion</li></a>
					<a href="Menuinscription"><li class="onglet">
						Inscription</li></a>
					<a href="Pagesupprcompte"><li class="onglet">
						Supprimer son compte</li></a>
		</ul>
	</div>
	<img class="bandeau" src="fox4.jpg">
</header>	
		
	<body>
	<h2>Connexion</h2>	
	<form action="#" method="post">
	
		<div>
			<label for="pseudo">Pseudo :</label>
			<input type="text" name="pseudo" placeholder="Nom d'utilisateur...">
		</div>
	
		<div>
			<label for="mdp">Mot de Passe :</label>
			<input type="password" name="mdp"  placeholder="Mot de passe...">
		</div>
	
		<div>
			<button type="sumbit" class="btn btn-outline-secondary">Connexion</button>
			<button type="button" OnClick="accueil.php" class="btn btn-success">Retour à l'accueil</button>
		</div>
				<!-- <button type="button" OnClick="accueil.php">Retour à l'accueil</button> -->
		</form>
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
