<?php

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://api-adresse.data.gouv.fr/reverse/csv/");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt(
        $ch,
        CURLOPT_POSTFIELDS,
        array('data' => '@Données/borneswifi_EPSG4326_20171004_utf8.csv')
    );

    //$test = curl_getinfo($ch);
    //var_dump($test);

    // In real life you should use something like:
    // curl_setopt($ch, CURLOPT_POSTFIELDS, 
    //          http_build_query(array('postvar1' => 'value1')));
    
    // Receive server response ...
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $server_output = curl_exec($ch);
    
    curl_close ($ch);
    
    var_dump($server_output);

    // Further processing ...
    if ($server_output == "OK") {

    } else {
        
    }
?>