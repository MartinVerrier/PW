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
    echo "Tous les points : \n";
    foreach($points as $point) {
        $dst = distance($ref, $point);
        echo $dst . " : " . $point['name'] . " , " . $point['adr'] . "\n";
    }

    echo "\nTous les points à moins de 200m : \n";
    $nb = 0;
    foreach($points as $point) {
        $dst = distance($ref, $point);
        if(distance($ref,$point) <= 200) {
            echo $dst . " : " . $point['name'] . " , " . $point['adr'] . "\n";
            $nb++;
        }        
    }
    echo "Il y en a " . $nb . "\n";
?>