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
			<div>
				<label for="nom">Nom :</label>
				<input type="text" name="nom">
			</div>
			<div>
				<label for="prenom">Prénom : </label>
				<input type="text" name="prenom">
			</div>
			<div>
				<label for="mail">Email : </label>
				<input type="text" name="mail">
			</div>
			<div>
				<label for="naissance">Date de naissance : </label>
				<?php
				
					echo "<select name=year>";
					$annee=getdate("this year")+1;
					
					for($i=0;$i<=125;$i++)
					{
						
						$annee=$annee-1;
						$year=date('Y',strtotime("$annee year"));
						echo "<option name='$year'>$year</option>";
					}
					echo "</select>";
			
					echo "<select name=month>";
					
					$month=date('m',strtotime("first month of the year"));
					$mois = (int)$month;
					
					for($i=0;$i<=11;$i++)
					{
						echo "<option value=$mois>$mois</option> ";
						$mois=$mois+1;
					}
					echo "</select>";
															
					/*echo "<select name=day>";
					<?php
					$y=date('Y', strtotime("last day of );
					$d=cal_days_in_month(CAL_GREGORIAN, $month, $y)
					for($i=0;$i<=$day:$i++)
					{
						$d=$i+1;
						echo "<option value=$d>$d</option>";
					}
					echo "</select>";*/
				?>
			</div>
			<div>
				<label for="prenom">Prénom : </label>
				<input type="text" name="prenom">
			</div>
		</form>
	</body>
</html>
