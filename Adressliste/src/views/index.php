<?php
/* Dateiname: index.php
* Autor: RS
* PHP-Training: Erstellung einer Adressliste
* Funktion: Anzeige
*/

include __DIR__ . "/layout/header.php";
include __DIR__ . "/layout/footer.php";
include __DIR__ . "/layout/form.php";
include __DIR__ . "/layout/table.php";

output_header(); // Funktion erzeugt einen Header

$o_pdo = new PDO(
    'mysql:host=localhost;dbname=adressliste;charset=utf8',
    'adressliste','U6MY6gd3dquwJHj2');

  if (!empty($_POST)){
    $stmt = $o_pdo->prepare(
      "INSERT INTO `adressen` (`id`, `vorname`, `nachname`, `strasse`, `plz`, `ort`) VALUES (:id, :vorname, :nachname, :strasse, :plz, :ort)"
    );
    // Adressdaten in Datenbanktabelle einfügen
    $stmt->execute([
      'id' => NULL,
      'vorname' => $_POST['vorname'],
      'nachname' => $_POST['nachname'],
      'strasse' => $_POST['straße'],
      'plz' => $_POST['plz'],
      'ort' => $_POST['ort']

    ]);
  }

// Alle Adressdaten von Datenbank abrufen

$adressen = $o_pdo->query("SELECT * FROM `adressen`");

output_table($adressen); // Erzeugung einer HTML-Tabelle mit Adressdaten

output_form('POST',"index.php");  // Funktion erzeugt ein Formular zur Eingabe einer Adresse

output_footer(); // Funktion erzeugt einen Footer

?>
