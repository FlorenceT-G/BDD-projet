<?php
	
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	include_once("myparam.inc.php");
	
	if ( !empty($_POST)) 
	{
		//keep track validation errors
		$pseudoErreur = null;
		$prenomErreur = null;
		$nomErreur = null;
		$emailErreur = null;
		$residenceErreur = null;
		$birth_dateErreur = null;
		
		$mdpErreur = null;
		$repeatmdp = null;
	
		// keep track post values
		$pseudo = $_POST['pseudo'];
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$email = $_POST['email'];
		$residence = $_POST['residence'];
		$birth_date = strtotime($_POST['birth_date']);
		
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
		
		if (empty($birth_date)) 
		{
			$birth_dateErreur = 'Veuillez entrer une date de naissance valide';
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
			$naissance = date("Y-m-d", $birth_date); //transformation de la date entrée par l'utilisateur en un format accepté par MySQL
			$d_inscription = date("Y-m-d"); //récupère la date à laquelle l'utilisateur s'inscrit
			
			if(strlen($mdp)>=6) //on vérifie que le mot de passe fasse au moins 6 caractères > sécurité
			{
				if($mdp == $repeatmdp) //si mot de passe répété est équivalent au mot de passe saisi initialement
				{	
					$mdp = md5($mdp); //cryptage du mot de passe
					$base = mysqli_connect(MYHOST, MYUSER, MYPASS, DBNAME); //requête de connexion à la base de donnée					   
					
					$check_pseudo = "SELECT pseudo FROM personne WHERE pseudo = '$pseudo'";
					$check_result =  mysqli_query($base, $checkpseudo); // requête qui permet de vérifier si le pseudo entré n'est pas déjà utilisé
									
					$count = mysqli_num_rows($check_result); // si le pseudo n'est pas utilisé retourne 0, sinon 1
					
					if ($count == 1) // s'il y a un résultat correspondant au pseudo saisi par l'utilisateur
					{
						echo("ERREUR: Le pseudo que vous avez entré est déjà utilisé."); // alors on affiche un message d'erreur
					}
					else // sinon on peut lancer la requête pour l'ajout du nouvel utilisateur dans la base de donnée
					{
						$sql = 	"INSERT INTO `personne`(pseudo, mail, naissance, inscription, nom, prenom, residence, mot_de_passe) VALUES ('$pseudo', '$email', '$naissance', '$d_inscription', '$nom', '$prenom','$residence', '$mdp');";	//requêt SQL pour inscrire une personne dans la base de donnée
						$result = mysqli_query($base,$sql); //envoie de la requête de connexion et de la requête d'insertion à MySQL
						echo("Vous êtes maintenant enregistré sur Nuisibizzbizz !");
						header('Location: ./accueil.php');
						
						if(!$result) // si la requête échoue
						{	
			 				echo("Error description : ".mysqli_error($base)); // on echo la raison de l'échec de la requête
						}				
						mysqli_close($base); // si la requête à fonctionné, alors la personne est insérée dans la base de donnée et on peut clore la connexion à MySQL
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
	
	<body>		
		<div class="corps">		
		<h2>Inscription</h2>
		<form class="formulaire" action="inscription.php" method="post">
		
		<table> <!-- tableau servant à bien placer les éléments, uniquement pour la mise en page : colonne gauche s'aligne sur la droite, donc tous les labels s'affichent juste à gauche de l'espace où renseigner ces informations, et tout est aligné-->
			<tr>
			<div <?php echo !empty($nomErreur)?'erreur':'';?>>
				<td class="colonnelabel">
				<label for="nom">Nom :</label>
				</td>
				<td>
				<input type="text" name="nom" value="<?php echo !empty($nom)?$nom:'';?>">
				<?php if (!empty($nomErreur)):
				    echo $nomErreur;
					endif; 
				?>
				</td>
			</div>
			</tr>

			<tr>
			<div <?php echo !empty($prenomErreur)?'Erreur' :'';?>>
				<td class="colonnelabel">
				<label for="prenom">Prénom : </label>
				</td>
				<td>
				<input type="text" name="prenom" value="<?php echo !empty($prenom)?$prenom:'';?>">
				<?php if (!empty($prenomErreur)):
					echo $prenomErreur;
					endif; 
				?>
				</td>
			</div>
			</tr>

			<tr>
			<div <?php echo !empty($emailErreur)?'Erreur' :'';?>>
				<td class="colonnelabel">
				<label for="mail">Email : </label>
				</td>
				<td>
				<input type="text" name="email" value="<?php echo !empty($email)?$email:'';?>">
				<?php if (!empty($emailErreur)):
					echo $emailErreur;
					endif; 
				?>
				</td>
			</div>
			</tr>

			<tr>
			<div>
				<td class="colonnelabel">
				<label for="naissance">Date de naissance : </label>
				</td>
				<td>
				<span <?php echo !empty($birth_dateErreur)?'Erreur' :'';?>>
					<input type="date" name="birth_date" maxlength="2" value="<?php echo !empty($birth_date)?$birth_date:'';?>">
					<?php if (!empty($birth_dateErreur)):
						echo $birth_dateErreur;
						endif; 
					?>
				</td>
				</span>
			</div>
			</tr>

			<tr>
			<div <?php echo !empty($residenceErreur)?'Erreur' :'';?>>
				<td class="colonnelabel">
				<label for="residence">Lieu de Résidence : </label>
				</td>
				<td>
				<input type="text" name="residence" value="<?php echo !empty($residence)?$residence:'';?>">
				<?php if (!empty($residenceErreur)):
					echo $residenceErreur;
					endif; 
				?>
				</td>
			</div>
			</tr>
			<tr> <td><br></td> <td><br></td> </tr> <!--espacement, ligne vide-->
			<tr>
			<div <?php echo !empty($pseudoErreur)?'erreur':'';?>>
				<td class="colonnelabel">
				<label for="pseudo">Pseudo :</label>
				</td>
				<td>
				<input type="text" name="pseudo" value="<?php echo !empty($pseudo)?$pseudo:'';?>">
				<?php if (!empty($pseudoErreur)):
				    echo $pseudoErreur;
					endif; 
				?>
				</td>
			</div>
			</tr>
			
			<tr>
			<div <?php echo !empty($mdpErreur)?'erreur':'';?>>
				<td class="colonnelabel">
				<label for="mdp">Mot de Passe :</label>
				</td>
				<td>
				<input type="password" name="mdp" value="">
				<?php if (!empty($mdpErreur)):
				    echo $mdpErreur;
					endif; 
				?>
				</td>
			</div>
			</tr>
			
			<tr>
			<div <?php echo !empty($repeatmdpErreur)?'erreur':'';?>>
				<td class="colonnelabel">
				<label for="mdp">Répéter votre Mot de Passe :</label>
				</td>
				<td>
				<input type="password" name="repeatmdp" value="">
				<?php if (!empty($repeatmdpErreur)):
				    echo $repeatmdpErreur;
					endif; 
				?>
				</td>
			</div>
			</tr>
			
			<tr>
			</table
			<div>
				<button class= "button_co" type="submit" name="inscription">Inscription</button>
			</div>
		
		</form>
		</div>
	</body>
	
	<footer>
		<p class="disclaimer"> Nous ne sommes pas responsables de la véracité des informations saisies par les utilisateurs </p>			
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
	
</html>
