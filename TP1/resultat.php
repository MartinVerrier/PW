<?php
	
	function resultat($somme, $taux, $duree) {
		$cumul = $somme * ( 1 + $taux/100 ) ** $duree;
		return $cumul;
	}

?>

<!DOCTYPE HTML>
<html>

    <head>
        <title>Résultat calcul</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    </head>

    <body>
        <p>
			<?php
				echo "Résultat = " . resultat($_GET["somme"], $_GET["taux"], $_GET["duree"]);
			?>
		</p>
    </body>

</html>