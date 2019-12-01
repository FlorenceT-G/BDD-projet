<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	include_once("myparam.inc.php");
	
	if ( !empty($_POST)) 
	{
		//keep track validation errors
		$pseudoErreur = null;
		$mdpErreur = null;
		$nomErreur = null;
		$prenomErreur = null;
		$naissanceErreur = null;
		$mailErreur = null;
		$residenceErreur = null;
		
		$mdpErreur = null;
		$repeatmdp = null;
		
		$pseudoutiliseError=null;
	
		// keep track post values
		$pseudo = $_POST['pseudo'];
		$mdp= $_POST['mdp'];
		$nom= $_POST['nom'];
		$prenom= $_POST['prenom'];
		$naissance= $_POST['naissance'];
		$mail= $_POST['mail'];
		$residence= $_POST['residence'];
		$inscription= $_POST['inscription'];
		
		
		// validate input
		$valid=true;
		
		//nom de la table à modifier
		$table="personne";
		
		if (empty($pseudo)) 
		{
			$pseudoErreur = 'Veuillez entrer un pseudo';
			$valid = false;
		}
		if (empty($nom)) 
		{
			$nomErreur = 'Veuillez entrer un Nom';
			$valid = false;
		}		
		if (empty($prenom)) 
		{
			$prenomErreur = 'Veuillez entrer un Prénom';
			$valid = false;
		}
		if (empty($naissance)) 
		{
			$naissanceErreur = 'Veuillez entrer une date de naissance valide';
			$valid = false;
		}		
		if (empty($mail)) 
		{
			$mailErreur = 'Veuillez entrer un Email';
			$valid = false;
		} 		
		else if ( !filter_var($mail,FILTER_VALIDATE_EMAIL) ) //si l'email est valide
		{
			$mailErreur = 'Veuillez entrer une Adresse Email valide';
			$valid = false;
		}		
		if (empty($residence)) 
		{
			$residenceErreur = 'Veuillez entrer un lieu de Résidence';
			$valid = false;
		}
		
		if ($valid) //si tout est bon jusqu'ici on peut passer au reste
		{
			$naissance = date("Y-m-d", $naissance); //transformation de la date de naissance par l'utilisateur en un format accepté par MySQL
			$inscription = date("Y-m-d", $inscription); //transformation de la date d'inscription en un format accepté par MySQL
			
			$base = mysqli_connect(MYHOST, MYUSER, MYPASS, DBNAME); //requête de connexion à la base de donnée					   
			
			$check_pseudo = "SELECT pseudo FROM personne WHERE pseudo = '$pseudo'";
			$check_result =  mysqli_query($base, $checkpseudo); // requête qui permet de vérifier si le pseudo entré n'est pas déjà utilisé
			$count = mysqli_num_rows($check_result); // si le pseudo n'est pas utilisé retourne 0, sinon 1
			if ($count == 1) // s'il y a un résultat correspondant au pseudo saisi par l'utilisateur
			{
				$pseudoutiliseError="ERREUR: Le pseudo que vous avez entré est déjà utilisé."; 
			}
			else // sinon on peut lancer la requête pour l'ajout du nouvel utilisateur dans la base de donnée
			{
				$sql ="UPDATE table
						SET pseudo = '$pseudo', mail = '$mail', colonne_3 = 'valeur 3'
						WHERE pseudo = '$pseudo
				
				INSERT INTO $table(pseudo, mail, naissance, inscription, nom, prenom, residence, mot_de_passe) VALUES ('$pseudo', '$email', '$naissance', '$d_inscription', '$nom', '$prenom','$residence', '$mdp');" //requête SQL pour modifier les champs dans la base de données
			}
		}
	}

?>
		
		
