<?php
    function initAccesspoint($row) {
        return array(
            'name' => $row[0], //string
            'adr' => $row[1],  //string
            'lon' => $row[2],  //float, in decimal degrees
            'lat' => $row[3]   //float, in decimal degrees
        );  
    }
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