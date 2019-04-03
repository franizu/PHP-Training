<?php
/* Dateiname: form.php
* Autor: RS
* PHP-Training: Erzeugung einer Adressliste
* Funktion: Erzeugung eines Formulars zur Eingabe einer Adresse und zum Speichern/Löschen einer Adresse
*/

include __DIR__ . "/style.php";

function output_form($method,$action){
  /*  Funktion: Funktion erzeugt ein Formular zur Eingabe einer Adresse und Buttons zum Speichern und Löschen einer Adresse
  *   Parameter: $method(string) - HTTP-Methode ; $action(string) - Aktion, die ausgeführt wird, wenn Formular submitted wird
  *   Ergebnis: HTML-Formular
  */
  echo "<br /><br />";
  echo "<form method={$method} action={$action}>" ;
  echo get_form_fragment('Vorname','vorname');
  echo get_form_fragment('Nachname','nachname');
  echo get_form_fragment('Straße/Hausnummer','straße');
  echo get_form_fragment('Postleitzahl','plz');
  echo get_form_fragment('Ort','ort');
  echo "<br />\n";
  echo "<button type='submit'>Eingaben absenden</button>\n";
  echo "</form";
}
function get_form_fragment($title,$name){
  /*  Funktion: HTML-Fragment zur Erzeugung eines Eingabefeldes und dessen Bezeichnung
  *   Parameter: $title(string) - Titel des Eingabefeldes, $name(string) - Name des Eingabefeldes
  *   Ergebnis: HTML-Fragment(string)
  */
  $str_form_fragment = "<div id ='content'><strong>{$title}:</strong><br><input type='text' name={$name}></div>";

  return $str_form_fragment;

}






 ?>
