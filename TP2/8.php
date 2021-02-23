<?php
	require_once("4.php");

    $ref_point = array('lon' => (float) $_GET["lon"], 'lat' => (float) $_GET["lat"]);

	foreach($points as $point) {
        $distances[] = distance($ref_point, $point);
    }
    array_multisort($distances, SORT_ASC, $points);
    $top_points = array_slice($points, 0, (int)$_GET["top"]);

	for ($i = 0; $i < count($top_points); $i++) {
        $top_points[$i]["address"] = json_decode(smartcurl("https://api-adresse.data.gouv.fr/reverse/?lon=" . $top_points[$i]["lon"] . "&lat=" . $top_points[$i]["lat"], 0), true)["features"][0]["properties"]["label"];
        $top_points[$i]["dst"] = $distances[$i];
    }

    echo json_encode($top_points);
?>