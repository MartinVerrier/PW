<html>
    <head>
        <title>Calendrier 3</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <style type="text/css"> 
            td {text-align : center;border: 1px solid black}
        </style>
    </head>
    <body>
        <?php 
            $date = explode("-",$_GET["date"]);
            $first = mktime(0,0,0,$date[1],1,$date[0]);
            $offset = date("N",$first);
            echo "<h1> " . date("F Y",$first);
            echo "<table><tbody><tr><td>Lundi</td><td>Mardi</td><td>Mercredi</td><td>Jeudi</td><td>Vendredi</td><td>Samedi</td><td>Dimanche</td></tr>";
            $i = 2-$offset;
            while($i <= intval(date("t",$first))) {
                echo "<tr>";
                for($j = 1; $j <= 7; $j++,$i++) {
                    echo "<td>";
                    if($i >= 1 && $i <= intval(date("t",$first))) {
                        $tmp = getdate(mktime(0,0,0,date("m",$first),$i,date("y",$first)));
                        echo $tmp["mday"];
                        if($i == intval($date[2])) {
                            echo "</br><span>" . $_GET["event"] . "</span>";
                        }
                    }
                    echo "</td>";
                }
                echo "</tr>";
            }
            echo "</tbody></table>";
        ?>
    </body>
</html