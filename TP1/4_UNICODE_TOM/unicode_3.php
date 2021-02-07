<html>
    <head>
        <title>Unicode</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <style type="text/css">
            table {border-collapse: collapse;}
            .carac {font-weight : bold; font-size : 30pt;}
            td {text-align : center; border : 1px solid black;}
        </style>
    </head>
    <body>
        <?php
            $code = mb_ord(mb_substr($_GET["string"],0,1));
            $inf = 16 * floor($code/16);
            $sup = $code == $inf ? $inf + 16 : 16 * ceil($code/16);
            echo "<table><tbody><tr>";
            for($i = $inf; $i < $sup; $i++) {
                $nb = dechex($i);
                echo  "<td><span class=\"carac\">" . mb_chr($i) . "</span></br><a href=\"http://unicode.org/cldr/utility/character.jsp?a=$nb\">U+$nb</a></td>";
            }
            echo "</tr></tbody></table>";
        ?>
    </body>
</html>