<?php
/* Dateiname: table.php
* Autor: RS
* PHP-Training: Erzeugung einer Adressliste
* Funktion: Erzeugung einer Tabelle mit Adressdaten
*/

function output_table($o_adressen){

  /*  Funktion: Erzeugung einer Tabelle mit Adressdaten
  *   Parameter: $o_adressen - Adressdaten von Datenbanktabelle(Objekt)
  *   Ergebnis: HTML-Tabelle
  */

  echo "<br/><br/>";
  echo "<form id = 'table'>";
  echo "<table>";
  echo "<thead><tr>";
  echo get_table_head_fragment('Vorname');
  echo get_table_head_fragment('Nachname');
  echo get_table_head_fragment('Straße/Hausnummer');
  echo get_table_head_fragment('Postleitzahl');
  echo get_table_head_fragment('Ort');
  echo "</tr></thead>";

  echo "<tbody";
  foreach ($o_adressen as $adresse) {
    echo "<tr>";
    echo get_table_body_fragment($adresse->vorname);
    echo get_table_body_fragment($adresse->nachname);
    echo get_table_body_fragment($adresse->strasse);
    echo get_table_body_fragment($adresse->plz);
    echo get_table_body_fragment($adresse->ort);
    echo "</tr>";
  }

  echo "</body></table></form>";
}

function get_table_head_fragment($title){
/*  Funktion: HTML-Fragment zur Erzeugung eines Tabellenkopfes
*   Parameter: $title(string) - Titel der Tabellenspalte
*   Ergebnis: HTML-Fragment(string)
*/
  $str_fragment = " <th><input value={$title} readonly></th>";
  return $str_fragment;
}

function get_table_body_fragment($value){
  /*  Funktion: HTML-Fragment zur Erzeugung eines Tabellenzelle
  *   Parameter: $value(string) - Adressdaten
  *   Ergebnis: HTML-Fragment(string)
  */
  $str_fragment = "<td><input type = 'text' value={$value} readonly ></td>";
  return $str_fragment;
}


 ?>
