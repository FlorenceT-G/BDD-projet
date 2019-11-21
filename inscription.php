<?php
	
	include_once("myparam.inc.php");
	if ( !empty($_POST)) 
	{
		//keep track validation errors
		$pseudoErreur = null;
		$prenomErreur = null;
		$nomErreur = null;
		$emailErreur = null;
		$residenceErreur = null;
		$jourErreur = null;
		$moisErreur = null;
		$anneeErreur = null;
		
		$mdpErreur = null;
		$repeatmdp = null;
	
		// keep track post values
		$pseudo = $_POST['pseudo'];
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$email = $_POST['email'];
		$residence = $_POST['residence'];
		$jour = $_POST['jour'];
		$mois = $_POST['mois'];
		$annee = $_POST['annee'];
		
		$mdp = $_POST['mdp'];
		$repeatmdp = $_POST['repeatmdp'];
		
		// validate input
		$valid = true;

		if (empty($pseudo)) 
		{
			$pseudoErreur = 'Veuillez entrer un pseudo';
			$valid = false;
		}

		if (empty($prenom)) 
		{
			$prenomErreur = 'Veuillez entrer un Prénom';
			$valid = false;
		}

		if (empty($nom)) 
		{
			$nomErreur = 'Veuillez entrer un Nom';
			$valid = false;
		}
		
		if (empty($email)) 
		{
			$emailErreur = 'Veuillez entrer un Email';
			$valid = false;
		} 
		else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) 
		{
			$emailErreur = 'Veuillez entrer une Adress Email valide';
			$valid = false;
		}
		
		if (empty($residence)) 
		{
			$residenceErreur = 'Veuillez entrer un lieu de Résidence';
			$valid = false;
		}
		
		if (empty($jour)) 
		{
			$jourErreur = 'Veuillez entrer un jour';
			$valid = false;
		}
		
		if (empty($mois)) 
		{
			$moisErreur = 'Veuillez entrer un mois';
			$valid = false;
		}
		
		if (empty($annee)) 
		{
			$anneeErreur = 'Veuillez entrer une annee';
			$valid = false;
		}
		
		if (empty($mdp))
		{
			$mdpErreur = 'Veuillez entrer un mot de passe.';
			$valid = false;
		}
		
		if (empty($repeatmdp))
		{
			$repeatmdpErreur = 'Veuillez répéter votre mot de passe.';
			$valid = false;
		}
		
		
		//insert data
		if ($valid) //si aucun champ ne se trouve vide alors on peut passer au reste
		{
			$naissance = "$annee-$mois-$jour"; //transformation de la date entrée par l'utilisateur en un format accepté par MySQL
			$d_inscription = date("Y-m-d"); //récupère la date à laquelle l'utilisateur s'inscrit
			
			if(strlen($mdp)>=6) //on vérifie que le mot de passe fasse au moins 6 caractères > sécurité
			{
				if($mdp == $repeatmdp) //si mot de passe répété est équivalent au mot de passe saisi initialement
				{	
					$mdp = md5($mdp); //cryptage du mot de passe
					$base = mysqli_connect(MYHOST, MYUSER, MYPASS, DBNAME); //requête de connexion à la base de donnée					   
					$sql = 	"INSERT INTO `personne`(pseudo, mail, naissance, inscription, nom, prenom, residence, mot_de_passe) VALUES ('$pseudo', '$email', '$naissance', '$d_inscription', '$nom', '$prenom','$residence', '$mdp');";	//requêt SQL pour inscrire une personne dans la base de donnée
					
					$checkpseudo = "SELECT * FROM personne WHERE pseudo = $checkpseudo;"; //permet de vérifier si le pseudo existe déjà dans la vase de donnée

					if($checkpseudo)
					{
						echo "Le pseudo que vous avez choisi est déjà utilisé. Si vous êtes déjà inscrit, rendez-vous sur la page de '<a href="connexion.php">'connexion'</a>'. Sinon, tentez de changer de pseudo.";
					}
					else
					{
					
						$result = mysqli_query($base,$sql); //envoie de la requête de connexion et de la requête d'insertion à MySQL
			
						if(!$result) //si la requête échoue
						{	
				 			echo("Error description : ".mysqli_error($base)); //on echo la raison de l'échec de la requête
						}	
			
						mysqli_close($base); //si la requête à fonctionné, alors la personne est insérée dans la base de donnée et on peut clore la connexion à MySQL
					}
				}
				else
				{
					echo "Erreur : Les mots de passe ne sont pas identiques."; //echo de l'erreur si les mots de passe ne sont pas identique
				}
			}
			else
			{
				echo "Erreur : Veuillez saisir un mot de passe d'au moins 6 caractères."; //echo de l'erreur lorsque le mdp saisi est inférieur à 6caractères
			}
		}
	} 
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link href="accueil.css"  rel="stylesheet">
		<title>Inscription</title>
	</head>
	<body>
		
		<header>
			<a href="Pageaccueil.html" class="retouraccueil">
				<div class="bandeau">
					<h1>Nuisibizzbizz</h1> <!--Titre du site-->
				</div>
			</a>
			<div class="MenuHaut">
				<ul >
					<a href="Pageaccueil.html"><li class="onglet"> Accueil </li></a>
					<a href="MenuConnexion"><li class="onglet">	Connexion</li></a>
					<a href="Menuinscription"><li class="onglet"> Inscription</li></a>
				</ul>
			</div>
				<img class="bandeau" src="fox4.jpg">
		</header>
		
		<h2>Inscription</h2>
		<form class="inscription" action="inscription.php" method="post">

			<div <?php echo !empty($nomErreur)?'erreur':'';?>>
				<label for="nom">Nom :</label>
				<input type="text" name="nom" value="<?php echo !empty($nom)?$nom:'';?>">
				<?php if (!empty($nomErreur)):
				    echo $nomErreur;
					endif; 
				?>
			</div>

			<div <?php echo !empty($prenomErreur)?'Erreur' :'';?>>
				<label for="prenom">Prénom : </label>
				<input type="text" name="prenom" value="<?php echo !empty($prenom)?$prenom:'';?>">
				<?php if (!empty($prenomErreur)):
					echo $prenomErreur;
					endif; 
				?>
			</div>

			<div <?php echo !empty($emailErreur)?'Erreur' :'';?>>
				<label for="mail">Email : </label>
				<input type="text" name="email" value="<?php echo !empty($email)?$email:'';?>">
				<?php if (!empty($emailErreur)):
					echo $emailErreur;
					endif; 
				?>
			</div>

			<div>
				<label for="naissance">Date de naissance (JJ-MM-AAAA) : </label>
				<label>Jour</label>
				<span <?php echo !empty($jourErreur)?'Erreur' :'';?>>
					<input type="text" name="jour" maxlength="2" value="<?php echo !empty($jour)?$jour:'';?>">
					<?php if (!empty($jourErreur)):
						echo $jourErreur;
						endif; 
					?>
				</span>
				<label>Mois</label>
				<span <?php echo !empty($moisErreur)?'Erreur' :'';?>>
					<input type="text" name="mois" maxlength="2" value="<?php echo !empty($mois)?$mois:'';?>">
					<?php if (!empty($moisErreur)):
						echo $moisErreur;
						endif; 
					?>
				</span>
				<label>Année</label>
				<span <?php echo !empty($anneeErreur)?'Erreur' :'';?>>
					<input type="text" name="annee" maxlength="4" value="<?php echo !empty($annee)?$annee:'';?>">
					<?php if (!empty($anneeErreur)):
						echo $anneeErreur;
						endif; 
					?>
				</span>
			</div>

			<div <?php echo !empty($residenceErreur)?'Erreur' :'';?>>
				<label for="residence">Lieu de Résidence : </label>
				<input type="text" name="residence" value="<?php echo !empty($residence)?$residence:'';?>">
				<?php if (!empty($residenceErreur)):
					echo $residenceErreur;
					endif; 
				?>
			</div>
			<br><br>
			<div <?php echo !empty($pseudoErreur)?'erreur':'';?>>
				<label for="pseudo">Pseudo :</label>
				<input type="text" name="pseudo" value="<?php echo !empty($pseudo)?$pseudo:'';?>">
				<?php if (!empty($pseudoErreur)):
				    echo $pseudoErreur;
					endif; 
				?>
			</div>
			
			<div <?php echo !empty($mdpErreur)?'erreur':'';?>>
				<label for="mdp">Mot de Passe :</label>
				<input type="password" name="mdp" value="">
				<?php if (!empty($mdpErreur)):
				    echo $mdpErreur;
					endif; 
				?>
			</div>
			
			<div <?php echo !empty($repeatmdpErreur)?'erreur':'';?>>
				<label for="mdp">Répéter votre Mot de Passe :</label>
				<input type="password" name="repeatmdp" value="">
				<?php if (!empty($repeatmdpErreur)):
				    echo $repeatmdpErreur;
					endif; 
				?>
			</div>

			<div>
				<button type="submit" name="inscription">Inscription</button>
			</div>
	
		</form>
		
		<footer>
			<p class="disclaimer"> Nous ne sommes pas responsables de la véracité des informations saisies 		par les utilisateurs </p>		
		
				<p> Nous contacter par mail: </p>
				<div>
					<ul>
						<li class="contacts">
							<address><a href="mailto:sarah.bonnet1@etu.univ-nantes.fr"> Sarah </a></address>		
						</li>		
						<li class="contacts">		
							<address><a href="mailto:florence.thomas1@etu.univ-nantes"> Florence </a></address>		
						</li>		
					</ul>		
				</div>		
			<p class="merci"> Merci de votre visite ! </p> 
		</footer >
		
	</body>
</html>

