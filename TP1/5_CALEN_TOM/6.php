<?php
    session_start();

    if ($_GET["event"] != "") {
        $_SESSION[$_GET["date"]] = $_GET["event"];
    }


    function formatDate($date) {
        $month = $date["mon"];
        if ($month < 10)
            $month = "0" . $month;

        $day = $date["mday"];
        if ($day < 10)
            $day = "0" . $day;

        return $date["year"] . "-" . $month . "-" . $day;
    }
?>


<html>
    <head>
        <title>Calendrier 3</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <style type="text/css">
            table {border-collapse: collapse;}
            td {text-align : center;border: 1px solid black}
        </style>
    </head>
    <body>
        <?php
            $date = explode("-",$_GET["date"]);
            $first = mktime(0,0,0,$date[1],1,$date[0]);
            $offset = date("N",$first);
            echo "<h1> " . date("F Y",$first) . "</h1>";
            echo "<table><tbody><tr><td>Lundi</td><td>Mardi</td><td>Mercredi</td><td>Jeudi</td><td>Vendredi</td><td>Samedi</td><td>Dimanche</td></tr>";
            $i = 2-$offset;
            while($i <= intval(date("t",$first))) {
                echo "<tr>";
                for($j = 1; $j <= 7; $j++,$i++) {
                    echo "<td>";
                    if($i >= 1 && $i <= intval(date("t",$first))) {
                        $tmp = getdate(mktime(0,0,0,date("m",$first),$i,date("y",$first)));
                        echo $tmp["mday"];
                        $formattedDate = formatDate($tmp);
                        if(isset($_SESSION[$formattedDate])) {
                            echo "</br><span>" . $_SESSION[$formattedDate] . "</span>";
                        }
                    }
                    echo "</td>";
                }
                echo "</tr>";
            }
            echo "</tbody></table>";
        ?>
        <br />
        <a href="index_6.html"><input type="button" value="Revenir à l'accueil" /></a>
        <a href="logout.php"><input type="button" value="Se déconnecter" /></a>
    </body>
</html