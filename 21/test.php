<?php

$a = "rewr dasda eqweq -dsadas -good";
$b = "-kana kana かな 仮名 -幹事 -かな";
$temp = preg_split("/[\s,]+/", $a, -1, PREG_SPLIT_NO_EMPTY);
preg_match_all('/[-]\w+/', $a, $matches, PREG_PATTERN_ORDER);
$pattern = "/[-]+[ぁ-ゔ]+|[-]+[ァ-ヴー]+[々〆〤]+|[-]+[一-龥]+|[-]\w+/";
$result = preg_replace($pattern, "", $b);
$result2 = mb_ereg_replace($pattern, "", $b); 
var_dump($result);

?>