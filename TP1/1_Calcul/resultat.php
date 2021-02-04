<?php require_once("libcalcul.php"); ?>

<!DOCTYPE HTML>
<html>

    <head>
        <title>Résultat calcul</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    </head>

    <body>
        <p>
			<?php
				echo "Résultat = " . cumul($_POST["somme"], $_POST["taux"], $_POST["duree"]);
			?>
		</p>
    </body>

</html>