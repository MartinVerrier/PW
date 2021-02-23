<?php 
    require_once("4.php");

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