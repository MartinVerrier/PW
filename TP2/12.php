<?php
	$strfile = "Données/DSPE_ANT_GSM_EPSG4326.json";

	$json = json_decode(file_get_contents($strfile), true);

	$operators = [];
	foreach ($json["features"] as $antenna) {
		$o = $antenna["properties"]["OPERATEUR"];
		if (!array_key_exists($o, $operators)) {
			$operators[$o] = 0;
		}
		$operators[$o]++;
	}

	echo "Ce jeu de données décrit les antennes de " . count($operators) . " opérateurs différents.\n";
	foreach($operators as $keys => $count) {
		echo "$keys possède $count antennes.\n";
	}
?>