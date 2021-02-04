<html>
    <head>
        <title>Calcul interet</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <style type="text/css"> 
            .surligne {background-color: yellow;}
        </style>
    </head>
    <body>
        <?php
            if(!isset($_GET["col"])) {$col = 10;} else {$col = $_GET["col"];}
            if(!isset($_GET["raw"])) {$raw = 10;} else {$raw = $_GET["raw"];}
            echo "<table>";
            for($i = 0; $i <= $raw; $i++ ) {
                echo "<tr" . ($i%2 == 0 ? " class=\"surligne\"" : "") . ">";
                for($j = 0; $j <= $col; $j++ ) {
                    echo "<td>" . $i*$j . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        ?>
    </body>

</html>