<?php 
    echo "<table><tbody>";
    for($i = 1; $i <= intval(date("t")); $i++) {
        $tmp = getdate(mktime(0,0,0,date("m"),$i,date("y")));
        echo "<tr><td> " . $tmp["mday"] . " </td><td> " . $tmp["weekday"] . " </td><td>  </td></tr>";
    }
    echo "</tbody></table>";
?>