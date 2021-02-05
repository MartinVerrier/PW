<?php
    $test = explode(" ",$argv[1]);
    foreach($test as $mot) {
        echo "$mot -> " . mb_substr($mot,0,1) . " -> " . mb_ord(mb_substr($mot,0,1)) . "\n";
    }
?>