<?php

    require_once("Helpers/tp2-helpers.php");

    $strfile = "Données/DSPE_ANT_GSM_EPSG4326.json";

    $antennas = json_decode(file_get_contents($strfile), true)["features"];

    $ref_point = array('lon' => (float) $_GET["lon"], 'lat' => (float) $_GET["lat"]);

    foreach($antennas as $ant) {
        $distances[] = distance($ref_point, array(
            'lon' => $ant["geometry"]["coordinates"][0],
            'lat' => $ant["geometry"]["coordinates"][1]
        ));
    }
    array_multisort($distances, SORT_ASC, $antennas);
    $top_antennas = array_slice($antennas, 0, (int)$_GET["top"]);

    for ($i = 0; $i < count($top_antennas); $i++) {
        $top_antennas[$i]["dst"] = $distances[$i];
    }



    function getFormattedCell($str) {
        return "<td" . ($str == "" ? " class=\"unknown\">Non renseigné" : ">" . $str) . "</td>\n";
    }
?>


<html>
    <head>
        <title><?php echo $_GET["top"]; ?> antennes trouvées</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <style type="text/css">
            table {
                border-collapse: collapse;
            }
            td, th {
                border: solid black 1px;
                padding: 1em;
            }
            .unknown {
                color: #888;
                font-style: italic;
            }
        </style>
    </head>
    <body>
        <h2>Voici les <?php echo $_GET["top"]; ?> antennes les plus proches</h2>
        <table>
            <tr>
                <th>ID antenne</th>
                <th>ID adresse</th>
                <th>Numéro CARTORADIO</th>
                <th>Numéro support</th>
                <th>Adresse</th>
                <th>Distance</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Technologie microcell</th>
                <th>2G</th>
                <th>3G</th>
                <th>4G</th>

            </tr>
            <?php
                foreach ($top_antennas as $ant) {
                    echo "<tr>\n";
                    echo getFormattedCell($ant["properties"]["ANT_ID"]);
                    echo getFormattedCell($ant["properties"]["ADRES_ID"]);
                    echo getFormattedCell($ant["properties"]["NUM_CARTORADIO"]);
                    echo getFormattedCell($ant["properties"]["NUM_SUPPORT"]);
                    echo getFormattedCell($ant["properties"]["ANT_ADRES_LIBEL"]);
                    echo getFormattedCell($ant["dst"]);
                    echo getFormattedCell($ant["geometry"]["coordinates"][0]);
                    echo getFormattedCell($ant["geometry"]["coordinates"][0]);
                    echo getFormattedCell($ant["properties"]["MICROCELL"]);
                    echo getFormattedCell($ant["properties"]["ANT_2G"]);
                    echo getFormattedCell($ant["properties"]["ANT_3G"]);
                    echo getFormattedCell($ant["properties"]["ANT_4G"]);
                    echo "</tr>\n";
                }
            ?>
        </table>
    </body>
</html>