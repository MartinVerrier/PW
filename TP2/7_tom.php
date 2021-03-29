<?php
	
	require_once("4.php");

    foreach($points as $pt) {
        // On ajoute les adresses au tableau des points d'accès
        $pt["address"] = json_decode(smartcurl("https://api-adresse.data.gouv.fr/reverse/?lon=" . $pt["lon"] . "&lat=" . $pt["lat"], 0), true)["features"][0]["properties"]["label"];

        // On affiche ces adresses une par une
        echo "Point:   Lat: " . $pt["lat"] . "   Lon: " . $pt["lon"] . "   Address: " . $pt["address"] . "\n";
    }

?>