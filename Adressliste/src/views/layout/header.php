<?php

/* Dateiname: header.php
* Autor: RS
* PHP-Training: Erstellung einer Adressliste
* Funktion: Erzeugung eines Headers
*/


function output_header(){

/*  Funktion: Funktion erzeugt einen Header
*   Parameter: keine
*   Ergebnis: HTML-Header
*/

echo "<!DOCTYPE html \n";
echo "<html lang='en'>\n";
  echo "<head>\n";
    echo "<meta charset='utf-8'>\n";
    echo "<meta http-equiv='X-UA-Compatible' content='IE=edge'>\n";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1'>\n";
    echo "<meta name='description' content=''>\n";
    echo "<meta name='author' content=''>\n";

    echo "<title>Adressliste</title>\n";

    // Latest compiled and minified CSS
    echo "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' integrity='sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7' crossorigin='anonymous'>\n";

    //Optional theme
    echo "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css' integrity='sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r' crossorigin='anonymous'>\n";

    //HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

   /*[if lt IE 9]>
     <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
     <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
   <![endif]*/
  include __DIR__ . "/style.php";

  echo "</head>";

  echo "<body>\n";

    echo "<nav class='navbar navbar-inverse navbar-fixed-top'>\n";
    echo  "<div class='container'>\n";
        echo "<div class='navbar-header'>\n";
          echo "<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar' aria-expanded='false' aria-controls='navbar'>\n";
            echo "<span class='sr-only'>Toggle navigation</span>\n";
            echo "<span class='icon-bar'></span>\n";
            echo "<span class='icon-bar'></span>\n";
            echo "<span class='icon-bar'></span>\n";
          echo "</button>\n";
          echo "<a class='navbar-brand' href='index'>Blog</a>\n";
        echo "</div>";
        echo "<div id='navbar' class='collapse navbar-collapse'>\n";
          echo "<ul class='nav navbar-nav'>\n";
            echo "<li class='active'><a href='index'>Home</a></li>\n";
          echo "</ul>\n";
        echo "</div>\n";
      echo "</div>\n";
    echo "</nav>\n";

    echo "<br /><br />\n";

    echo "<div class='container'>\n";
  }
    ?>
