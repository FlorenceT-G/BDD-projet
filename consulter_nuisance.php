<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>

<?php
    session_start();
    include "myparam.inc.php";
	$pseudo = $_SESSION['pseudo'];	
?>

<?php

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Consulter</title>
		<link href="accueil.css"  rel="stylesheet">
	</head>
	
	<?php include "header.php"; ?>
	
	<body>
        <div class="corps">
            <h2>Consulter le type du nuisance</h2>
            <form action="#" method="post" class="formulaire">
                <div class="control-group <?php echo !empty($Error)?'error':'';?>">
                    <div>
                        <input type="checkbox" name="nuisance_ssp" checked>
                        <label for="nuisance_ssp">Sécurité & santé publique</label>                    
                        <br>
                        <input type="checkbox" name="nuisance_ff">
                        <label for="nuisance_ff">Faune & Flore</label>
                        <br>
                        <input type="checkbox" name="nuisance_agri">
                        <label for="nuisance_ff">Agricole</label>
                        <br>
                        <input type="checkbox" name="nuisance_a">
                        <label for="nuisance_ff">Autres formes de proprité</label>
                    </div>
                    <?php 
                        if (!empty($fieldsErr)):
                                            
                            echo "<span style=\"color:red; text-align:center\"; class='help-inline'>"; 
                                echo $fieldsErr; 
                            echo "</span> <br>";
                        endif; 
                    ?>
                    <br>
                    <input class="button_co" type="submit" value="Soumettre" >
                </div>
            </form>
        </div>
    </body>

    <?php include "footer.php"; ?>

</html>

