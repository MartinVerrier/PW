<?php 
    $date = mktime(0,0,0,$_GET["month"],1,$_GET["year"]);
    echo "<table><tbody>";
    for($i = 1; $i <= intval(date("t",$date)); $i++) {
        $tmp = getdate(mktime(0,0,0,date("m",$date),$i,date("y",$date)));
        echo "<tr><td> " . $tmp["mday"] . " </td><td> " . $tmp["weekday"] . " </td><td>  </td></tr>";
    }
    echo "</tbody></table>";
?>