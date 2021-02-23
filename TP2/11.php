<?php
	
	$strfile = "Données/DSPE_ANT_GSM_EPSG4326.csv";
	$file = fopen($strfile, "r");

	$count = 0;
	fgetcsv($file, ",");
	while (fgetcsv($file, ",") !== FALSE) {
		$count++;
	}

	fclose($file);

	echo "Nombre d'antennes référencées : " . $count . ".\n";
	echo "Par rapport aux points d'accès Wi-Fi, ce jeu d'antennes contient des informations supplémentaires qui sont l'ID de l'antenne, son adresse, l'opérateur qui l'exploite, l'utilisation ou non de la technologie microcell, la technologie de l'antenne (2G/3G/4G), son numéro cartoradio et son numéro de support.\n";
	echo "Ces informations sont importantes dans le cas d'une démarche d'OpenData car elles permettent de complètement décrire les antennes.\n";

?>