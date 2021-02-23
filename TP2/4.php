<?php
    require_once("Helpers/tp2-helpers.php");

    function getAccesspoints($strfile) {
        $file = fopen($strfile, "r");
        //$tab = [];
        fgetcsv($file, ",");
        while(($csv = fgetcsv($file, ",")) !== FALSE) {
            $tab[] = initAccesspoint($csv);
            //array_push($tab,initAccesspoint($csv));
        }
        fclose($file);
        return $tab;
    }

    $points = getAccesspoints("Données/borneswifi_EPSG4326_20171004_utf8.csv");
?>