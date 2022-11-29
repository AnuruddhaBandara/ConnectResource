<?php
$arr = [2, 3, 1, 2, 1, 3];

        for ($i = 0; $i < count($arr); $i++) {
            for ($j = $i + 1; $j < count($arr); $j++) {
                if ($arr[$i] == $arr[$j]) {
                    print($arr[$j] . "<br>");
                }
            }
        }

?>