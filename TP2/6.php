<?php  
    require_once("4.php");
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