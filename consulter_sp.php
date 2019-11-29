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
    if(!empty($_POST))
    {
        $fieldsErr = null;

        $espece = $_POST['espece'];

        if(empty($espece))
        {
            $fieldsErr = "Veuillez sélectionner une espèce !";
        }

        $base = mysqli_connect(MYHOST, MYUSER, MYPASS, DBNAME);
       $sql = "SELECT "
    }
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
            <h2>Consulter les espèces nuisibles</h2>
            <form action="#" method="post" class="formulaire">
                <div class="control-group <?php echo !empty($Error)?'error':'';?>">
                    <div>
                        <select name="espece" value="<?php echo !empty($espece)?$espece:'';?>">
                            <option value='$region'>None</option>
                            <?php
                                $base = mysqli_connect (MYHOST, MYUSER, MYPASS, DBNAME); 
                                $sql = 	"SELECT nomverna FROM especes";
                                $result = mysqli_query ($base,$sql);
                                while($row = mysqli_fetch_array($result)) 
                                {
                                    $espece= $row['nomverna'];
                                
                                    echo "<OPTION value='$espece'> $espece </OPTION> \n"; 
                                }
                                mysqli_close($base);
                            ?>
                        </select>
                    </div>
                    <?php 
                        if (!empty($fieldsErr))
                        {                            
                            echo "<span style=\"color:red; text-align:center\"; class='help-inline'>"; 
                                echo $fieldsErr; 
                            echo "</span> <br>";
                        } 
                    ?>
                    <br>
                    <input class="button_co" type="submit" value="Soumettre" >
                </div>
            </form>

        </div>
    </body>

    <?php
    echo "<table>";
        echo "<thead>";
            echo "<tr>";
                echo "<td>";
                echo "</td>";
                echo "<td>";
                echo "</td>";
            echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
            echo "<tr>";
                echo "<td>";
                echo "</td>";
                echo "<td>";
                echo "</td>";
            echo "</tr>";
        echo "</tbody>";
    echo "</table>";
?>

    <?php include "footer.php"; ?>

</html>