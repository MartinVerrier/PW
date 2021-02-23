<?php
	$json = json_decode(file_get_contents("Données/borneswifi_EPSG4326_20171004.json"), true);

	$points = [];
	foreach ($json["features"] as $json_point) {
		$points[] = array(
			'name' => $json_point["properties"]["AP_ANTENNE1"],
			'adr' => $json_point["properties"]["Antenne 1"],
			'lon' => $json_point["geometry"]["coordinates"][0],
			'lat' => $json_point["geometry"]["coordinates"][1]
		);
	}

	//var_dump($points);
?>