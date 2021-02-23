<?php
	
	require_once("4.php");

    for ($i = 0; $i < count($points); $i++) {
        // On ajoute les adresses au tableau des points d'accès
        $points[$i]["address"] = json_decode(smartcurl("https://api-adresse.data.gouv.fr/reverse/?lon=" . $points[$i]["lon"] . "&lat=" . $points[$i]["lat"], 0), true)["features"][0]["properties"]["label"];

        // On affiche ces adresses une par une
        $pt = $points[$i];
        echo "Point:   Lat: " . $pt["lat"] . "   Lon: " . $pt["lon"] . "   Address: " . $pt["address"] . "\n";
    }

?>