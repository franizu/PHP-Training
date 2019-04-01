<?php
$str_datum = "14.06.1987";

$a_datum = explode(".", $str_datum);
$timestamp = mktime(0,5,0,$a_datum[1],$a_datum[0],$a_datum[2]);
$alter = (time()-$timestamp)/(3600*24*365);

var_dump($alter);



 ?>
