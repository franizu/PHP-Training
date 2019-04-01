<?php


if (isset($_COOKIE['name'])){
  if ($_COOKIE['name'] == 'Robert'){
    $i = $_COOKIE['zaehler'];
    $i += 1;
    setcookie('zaehler',$i);
    var_dump($_COOKIE['zaehler']);
  }
}else{
  setcookie("name","Robert");
  setcookie("zaehler",1);
}


 ?>
