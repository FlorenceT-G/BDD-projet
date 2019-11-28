<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	include_once 'myparam.inc.php';
	session_start();
	$pseudo = $_SESSION['pseudo'];

	$base = mysqli_connect(MYHOST, MYUSER, MYPASS, DBNAME);
	$sql = "SELECT * FROM personne WHERE pseudo = '".$pseudo."';";
	$requete = mysqli_query($base, $sql);

	$row = mysqli_fetch_array($requete);
	$nom = $row['nom'];
	$prenom = $row["prenom"];
	$mail = $row["mail"];
	$pseudo = $row["pseudo"];
	$naissance = $row["naissance"];
	$inscription = $row["inscription"];
	mysqli_close($base);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profil</title>
		<link href="accueil.css"  rel="stylesheet">
	</head>
	
	<?php include "header.php"; ?>
	
	<body>
	<?php echo"$pseudo"; ?>
	<form action="edit_profil.php">
		<div class="corps">	
		<h2>Profil utilisateur</h2>
			<table>
				<tr>
					<td>Nom : </td>
					<td><?php echo $nom; ?></td>
				</tr>
				<tr>
					<td>Prénom : </td>
					<td> <?php echo $prenom; ?></td>
				</tr>
				<tr>
					<td>E-mail : </td>
					<td><?php echo $mail; ?></td>
				</tr>
				<tr>
					<td>Pseudo : </td>
					<td><?php echo $pseudo; ?></td>
				</tr>
				<tr>
					<td>Date de Naissance : </td>
					<td><?php echo $naissance; ?></td>
				</tr>
				<tr>
					<td>Date d'inscription : </td>
					<td><?php echo $inscription; ?></td>
				</tr>
				<tr>
					<td><input type="submit" value="Editer le profil"></td>
				</tr>
			</table>
			<?php  ?>
		</div class="corps">
	</form>	
	</table>
	
	</body>
	
	<?php include "footer.php"; ?>
	
</html>
