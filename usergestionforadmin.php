<!DOCTYPE html>
<html>
<?php
	include 'myparam.inc.php';
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
?>

<head>
	<title>Gestion utilisateurs</title>
	<link href="accueil.css"  rel="stylesheet">
	<meta charset="utf-8">
</head>

<body><div class="corps">

<h2>Gestion des utilisateurs</h2>

<?php
			$base = mysqli_connect(MYHOST, MYUSER, MYPASS, DBNAME) or die ("Impossible de se connecter à la base de données"); 
			$sqlcount = "SELECT count(*) as total, FROM personne" ;
			$resultcount=mysqli_query ($base,$sqlcount);
			//echo $resultcount;
?>

<!-- tableau liste des utilisateurs centré-->
<center><table class="tableau">

<!-- titres des colonnes -->
<tr>
	<th>Pseudo</th>
	<th>Nom</th>
	<th>Prénom</th>
	<th>Date de naissance</th>
	<th>Mail</th>
	<th>Lieu de résidence</th>
	<th>Date d'inscription</th>
	<th></th>
	<th></th>
</tr>



<!-- affichage ligne par ligne du résultat de la query-->
	<!--	<form class="formulaire" action="usergestionforadmin.php" method="post"> -->
	
		<?php
			$base = mysqli_connect (MYHOST, MYUSER, MYPASS, DBNAME) or die ("Impossible de se connecter à la base de données"); 
			$sql = 	"SELECT pseudo, nom, prenom, naissance, mail, inscription, residence, mot_de_passe FROM personne ORDER BY inscription DESC" ;
			$result=mysqli_query ($base,$sql);
			
			while($row = mysqli_fetch_array($result)) 
			{
				$pseudo= $row['pseudo'];
				$nom= $row['nom'];
				$prenom= $row['prenom'];
				$naissance= $row['naissance'];
				$mail= $row['mail'];
				$residence= $row['residence'];
				$inscription= $row['inscription'];
				$mdp=$row['mot_de_passe'];
				$table="personne";
				
				
				echo "<tr>";
				//formulaire dont les valeurs par défaut sont basées sur ce qu'il y a dans la base de données, mais qui sont modifiables. Avec le submit la base de données est mise à jour avec les information dans les zones de texte
				echo "<form action=\"modifuser.php\" method=\"post\">"; 
					echo "<td><input type=\"text\" name =\"pseudo\" value=\"$pseudo\"></td>";
 					if (!empty($pseudoErreur)):
						echo "<br>$pseudoErreur";
						endif;
					echo "<input type=\"hidden\" name =\"mdp\" value=\"$mdp\" disabled=\"disabled\">";
 					echo "<td> <input class=\"textimput\" type=\"text\" name =\"nom\" value=\"$nom\"> </td>";
 					if (!empty($nomErreur)):
						echo "<br>$nomErreur";
						endif; 
 					echo "<td> <input class=\"textimput\" type=\"text\" name =\"prenom\" value=\"$prenom\"> </td>";
 					if (!empty($prenomErreur)):
						echo "<br>$prenomErreur";
						endif; 
 					echo "<td> <input type=\"date\" name =\"naissance\" value=\"$naissance\"> </td>";
 					if (!empty($naissanceErreur)):
						echo "<br>$naissanceErreur";
						endif; 
 					echo "<td> <input class=\"textimput\" type=\"text\" name =\"mail\" value=\"$mail\"> </td>";
 					if (!empty($mailErreur)):
						echo "<br>$mailErreur";
						endif; 
 					echo "<td> <input class=\"textimput\" type=\"text\" name =\"residence\" value=\"$residence\"> </td>";
 					if (!empty($residenceErreur)):
						echo "<br>$residenceErreur";
						endif; 
 					echo "<td> <input type=\"date\" name =\"inscription\" value=\"$inscription\" disabled=\"disabled\"> </td>";
 					echo "<td> <button type=\"submit\" name=\"Modifier\">Modifier</button> </td>";
 				echo"</form>";
 				
 				echo "<form action=\"suppruser.php\" method=\"post\""; //formulaire qui reprend $pseudo avec un imput qui n'apparaît pas à l'écran et exécute un script pour supprimer l'utilisateur
 					echo "<td> <input type=\"hidden\" name =\"pseudo\" value=\"$pseudo\"> </td>";
					echo "<td> <button type=\"submit\" name=\"Modifier\">Supprimer</button> </td>";
 				echo"</form>";
 				
 				echo "</tr>";

			}
			
		mysqli_close($base);
		
		?>

</table></center>
</div></body>


</html>


