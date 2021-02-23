<?php
	
	$strfile = "Données/DSPE_ANT_GSM_EPSG4326.csv";

	$file = fopen($strfile, "r");

	$count = 0;
	fgetcsv($file, ",");
	while (fgetcsv($file, ",") !== FALSE) {
		$count++;
	}

	fclose($file);

	echo "Nombre d'antennes référencées : " . $count . "\n";


?>