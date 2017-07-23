<?php

/* Funkcja zapisująca format wyświetlania pieniędzy 
French notation - wyświelta w taki sposób:  1 234,56 */

function moneyNotation($money){
    $price = number_format((int) $money, 2, ',' , ' ');
    return $price;
}

?>