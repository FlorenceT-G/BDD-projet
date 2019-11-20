<?php
	
	include_once("myparam.inc.php");
	if ( !empty($_POST)) 
	{
		//keep track validation errors
		$pseudoErreur = null;
		$mdpErreur = null;
		$prenomErreur = null;
		$nomErreur = null;
		$emailErreur = null;
		$residenceErreur = null;
		$jourErreur = null;
		$moisErreur = null;
		$anneeErreur = null;
	
		// keep track post values
		$pseudo = $_POST['pseudo'];
		$mdp = $_POST['mdp'];
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$email = $_POST['email'];
		$residence = $_POST['residence'];
		$jour = $_POST['jour'];
		$mois = $_POST['mois'];
		$annee = $_POST['annee'];
		
		// validate input
		$valid = true;

		if (empty($pseudo)) 
		{
			$pseudoErreur = 'Veuillez entrer un pseudo';
			$valid = false;
		}
		
		if (empty($mdp))
		{
			$mdpErreur = 'Veuillez entrer un mot de passe.';
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
		
		//insert data
		if ($valid) 
		{
			$naissance = "$annee-$mois-$jour";
			$d_inscription = date("Y-m-d");
		
			$base = mysqli_connect(MYHOST, MYUSER, MYPASS, DBNAME); 					   
			$sql = 	"INSERT INTO `personne`(pseudo, mail, naissance, inscription, nom, prenom, residence, mot_de_passe) VALUES ('$pseudo', '$email', '$naissance', '$d_inscription', '$nom', '$prenom','$residence', '$mdp');";	
			$result=mysqli_query($base,$sql);	
			
			if(!$result)
			{	
				 echo("Error description : ".mysqli_error($base));	
			}	
			
			mysqli_close($base);	
			//header("Location: index.php");	
		}
	} 
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<!-- <a href=""> -->
		<title>Inscription</title>
	</head>
	<body>
		<h2>Inscription</h2>
		<form class="inscription" action="inscription.php" method="post">

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
					<input type="text" name="jour" value="<?php echo !empty($jour)?$jour:'';?>">
					<?php if (!empty($jourErreur)):
						echo $jourErreur;
						endif; 
					?>
				</span>
				<label>Mois</label>
				<span <?php echo !empty($moisErreur)?'Erreur' :'';?>>
					<input type="text" name="mois" value="<?php echo !empty($mois)?$mois:'';?>">
					<?php if (!empty($moisErreur)):
						echo $moisErreur;
						endif; 
					?>
				</span>
				<label>Année</label>
				<span <?php echo !empty($anneeErreur)?'Erreur' :'';?>>
					<input type="text" name="annee" value="<?php echo !empty($annee)?$annee:'';?>">
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

			<div>
				<button type="submit" name="inscription">Inscription</button>
			</div>
	
		</form>
	</body>
</html>
