<?php  
    require_once("4.php");
    function distance ($p, $q) {
        $scale = 10000000 / 90; // longueur d'un degré le long d'un méridien
        $a = ((float)$p['lon'] - (float)$q['lon']);
        $b = (cos((float)$p['lat']/180.0*M_PI) * ((float)$p['lat'] - (float)$q['lat']));
        $res = $scale * sqrt( $a**2 + $b**2 );
        return (float)sprintf("%5.1f", $res);
    }

    $points = getAccesspoints("Données/borneswifi_EPSG4326_20171004_utf8.csv");
    $ref = array( // place grenette
        'lon' => 5.72752,
        'lat' => 45.19102
    );
    /*foreach($points as $point) {
        $dst = distance($ref, $point);
        $point += ["distance" => $dst];
    }*/
    /*for ($i = 0; $i < count($points); $i++) {
        $dst = distance($ref, $points[$i]);
        $points[$i] += ["distance" => $dst];
    }
    $distances = array_column($points, 'distance');*/

    foreach($points as $point) {
        $distances[] = distance($ref, $point);
    }

    array_multisort($distances, SORT_ASC, $points);
    
    $nearest_points = array_slice($points, 0, 5);
    echo "Top 5 : \n";
    foreach($nearest_points as $point) {
        echo $point['name'] . " , " . $point['adr'] . "\n";
    }

?>