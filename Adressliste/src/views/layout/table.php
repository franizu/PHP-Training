<?php
/* Dateiname: table.php
* Autor: RS
* PHP-Training: Erzeugung einer Adressliste
* Funktion: Erzeugung einer Tabelle mit Adressdaten
*/

/*  Funktion: Erzeugung einer HTML-Tabelle mit Adressdaten
  *   Parameter: $o_adressen (Objekt) - Adressdaten von Datenbanktabelle
  *   Ergebnis: HTML-Tabelle
  */
function output_table($o_adressen,$edit_id){

  echo "<br/><br/>";
  echo "<form id = 'table' method='POST' action='index.php'>";
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
    echo get_table_body_fragment('vorname',$adresse->vorname,$edit_id,$adresse->id);
    echo get_table_body_fragment('nachname',$adresse->nachname,$edit_id,$adresse->id);
    echo get_table_body_fragment('strasse',$adresse->strasse,$edit_id,$adresse->id);
    echo get_table_body_fragment('plz',$adresse->plz,$edit_id,$adresse->id);
    echo get_table_body_fragment('ort',$adresse->ort,$edit_id,$adresse->id);
    echo "<td><button type=\"submit\" name='löschen' value='$adresse->id'>Löschen</button></td>";
    echo "<td><button type=\"submit\" name='bearbeiten' value='$adresse->id'>Bearbeiten</button></td>";
    echo "<td><button type=\"submit\" name='speichern' value='$adresse->id'>Speichern</button></td>";
    echo "</tr>";
  }

  echo "</body></table></form>";
}

/*  Funktion: HTML-Fragment zur Erzeugung eines Tabellenkopfes
*   Parameter: $title(string) - Titel der Tabellenspalte
*   Ergebnis: HTML-Fragment(string)
*/
function get_table_head_fragment($title){

  $str_fragment = " <th><input value=\"$title\" readonly></th>";
  return $str_fragment;
}

/*  Funktion: HTML-Fragment zur Erzeugung eines Tabellenzelle
*   Parameter: $value(string) - Adressdaten
*   Ergebnis: HTML-Fragment(string)
*/
function get_table_body_fragment($title,$addressdata,$edit_id,$address_id){
  if ($edit_id!=$address_id) {
    $str_fragment = "<td><input type = 'text' value=\"$addressdata\" readonly ></td>";
  }else{
    $str_fragment = "<td><input name=\"adresse[$title]\" type = 'text' value=\"$addressdata\" ></td>";
  }
  return $str_fragment;
}


 ?>
