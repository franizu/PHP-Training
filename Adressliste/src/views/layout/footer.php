<?php

/* Dateiname: header.php
* Autor: RS
* PHP-Training: Erstellung einer Adressliste
* Funktion: Erzeugung eines einer Funktion zur Erzeugung eines HTML-Footers
*/

function output_footer(){
  /*  Funktion: Funktion erzeugt einen Footer
  *   Parameter: keine
  *   Ergebnis: HTML-Footer
  */

  echo "</div>\n";

  // Bootstrap core JavaScript
  //================================================== -->
  //Placed at the end of the document so the pages load faster -->
  echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script>\n";
  echo "<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js' integrity='sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS' crossorigin='anonymous'></script>\n";
  echo "</body>\n";
  echo "</html>\n";
}
?>
