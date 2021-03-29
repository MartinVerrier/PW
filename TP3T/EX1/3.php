<?php
    require("../Helpers/tp3-helpers.php");

    $json = json_decode(tmdbget('movie/'.$_GET['nb']),true);
    echo "<h2> Titre : </h2><p>" . $json['title']. "</p>";
    echo "<h2> Titre original : </h2><p>" . $json['original_title']. "</p>";
    echo "<h2> Desc : </h2><p>" . $json['overview']. "</p>";
    echo "<h2> Link : </h2><a href=\"".$json['homepage']."\">" . $json['homepage']. "</a>";
    echo "<h2> Tagline : </h2><p>" . $json['tagline']. "</p>";
?>