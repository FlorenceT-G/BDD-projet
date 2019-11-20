<?php

inclue_once("myparam.inc.php");
session_start()

if (isset($_POST["Connexion"]))
{
	if(empty($_POST["pseudo"]))
	{
		echo "Veuillez saisir votre pseudo.";
	}
	else
	{
		if(empty($_POST["mdp"]))
		{
			echo "Veuillez saisir votre mot de passe.";
		}
		else
		{
			$pseudo = htmlentities($_POST["pseudo"], ENT_QUOTES, "UTF-8");
			$mot_de_passe = htmlentities($_POST["mdp"], ENT_QUOTES, "UTF-8");
			$base = mysqli_connect (MYHOST, MYUSER, MYPASS,DBNAME); 					   
	  		$Requete = mysqli_query($mysqli,"SELECT * FROM personne WHERE pseudo = '".$pseudo."' AND mdp = '".$mot_de_passe."'");
	  		$result=mysqli_query ($base,$sql);
	  		
	  		if(!$result)
	  		{
 				echo("Error description: " . mysqli_error($base));
		  	}
		  	
		  	$data=mysqli_fetch_array($result,MYSQLI_ASSOC);
		  	mysqli_close($base);
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<link href="file:///home/florence/Dropbox/Cours/M1BB/bases_de_donn%C3%A9es_interfacees_web/projet/styles.css" rel="stylesheet">
	<title>Connexion</title>
</head>
<body>
	<h2 class="connexion">Connexion</h2>

	<form class="formulaire">

			<div> 
				<label for="pseudo">Pseudo :</label>
				<input type="text" class="pseudo">
			</div>

			<div class="input">
				<label for="mdp">Mot de Passe :</label>
				<input type="text" class="mdp">
			</div>

			<div class="input">
				<button type="submit" name="Connexion">Connexion</button>
			</div>

	</form>
</body>
</html>
