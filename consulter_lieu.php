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

        if(empty($region))
        {
            $fieldsErr = "Veuillez sélectionner une région.";
        }

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
            <h2>Consulter les lieux</h2>
            <form action="#" method="post" class="formulaire">
                <div class="control-group <?php echo !empty($Error)?'error':'';?>">
                    <div>
                        <select name="region" value="<?php echo !empty($region)?$region:'';?>">
                            <option value="$region">None</option>
                            <?php
                                $base = mysqli_connect (MYHOST, MYUSER, MYPASS, DBNAME); 
                                $sql = 	"SELECT DISTINCT lieu FROM recensement";
                                $result = mysqli_query ($base,$sql);
                                while($row = mysqli_fetch_array($result))
                                {
                                    $region = $row['lieu'];

                                    echo "<option value='$region'>$region</option> \n";
                                }
                                mysqli_close($base);
                            ?>
                        </select>
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