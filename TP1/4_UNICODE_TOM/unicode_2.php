<!DOCTYPE HTML>
<html>

<head/><title>Unicode 2</title></head>

<body>

<?php
    $mots = explode(" ",$_GET["string"]);
    var_dump($_GET["string"]);
    foreach($mots as $mot) {
        echo "<p> $mot -> " . mb_substr($mot,0,1) . " -> " . mb_ord(mb_substr($mot,0,1)) . "</p>";
    }
?>

</body>

</html>