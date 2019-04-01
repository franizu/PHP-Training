<?php

function get_primzahl($end){
  $a = [];
  for ($i = 1 ;$i < $end; $i+=1){
    $pz = true;
    for ($j = 1; $j <= $i; $j+=1){
      $diff = $i/$j - floor($i/$j);

      if ($diff == 0 AND $j!=1 AND $j!=$i){
        $pz = false;

      }

    }
    if ($pz ==true) {
      $a[] = $i;
    }
  }
   yield $a;
}

foreach (get_primzahl(100) as $value) {
  var_dump($value);
}



 ?>
