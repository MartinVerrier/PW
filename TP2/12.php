<?php
	$strfile = "Données/DSPE_ANT_GSM_EPSG4326.json";

	$json = json_decode(file_get_contents($strfile), true);

	$operators = [];
	foreach ($json["features"] as $antenna) {
		$o = $antenna["properties"]["OPERATEUR"];
		if (!in_array($o, $operators)) {
			$operators[] = $o;
		}
	}

	echo "Ce jeu de données décrit les antennes de " . count($operators) . " opérateurs différents.\n";
?>