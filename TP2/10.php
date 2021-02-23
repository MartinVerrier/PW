<?php
	require_once("9.php");
    require_once("Helpers/tp2-helpers.php");

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
?>


<html>
    <head>
        <title><?php echo $_GET["top"]; ?> points d'accès trouvés</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <style type="text/css">
            table {
                border-collapse: collapse;
            }
            td, th {
                border: solid black 1px;
                padding: 1em;
            }
        </style>
    </head>
    <body>
        <h2>Voici les <?php echo $_GET["top"]; ?> points d'accès les plus proches</h2>
    	<table>
            <tr>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Distance</th>
                <th>Latitude</th>
                <th>Longitude</th>
            </tr>
       		<?php
       			foreach ($top_points as $point) {
       				echo "<tr>\n";
                    echo "  <td>" . $point["name"] . "</td>\n";
                    echo "  <td>" . $point["address"] . "</td>\n";
                    echo "  <td>" . $point["dst"] . "</td>\n";
                    echo "  <td>" . $point["lat"] . "</td>\n";
                    echo "  <td>" . $point["lon"] . "</td>\n";
                    echo "</tr>\n";
        		}
        	?>
        </table>
    </body>
</html>