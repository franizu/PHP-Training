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
include __DIR__ . "/../Model/AddressRepository.php";

$o_pdo = new PDO(
    'mysql:host=localhost;dbname=adressliste;charset=utf8',
    'adressliste','U6MY6gd3dquwJHj2');


$o_addressRepository = new \Model\AddressRepository($o_pdo);
if (!empty($_Post)){
    $o_addressRepository -> insertAdress();
}

$o_adressen = $o_addressRepository->fetchAll();

output_header(); // Funktion erzeugt einen Header

output_table($o_adressen); // Erzeugung einer HTML-Tabelle mit Adressdaten

output_form('POST',"index.php");  // Funktion erzeugt ein Formular zur Eingabe einer Adresse

output_footer(); // Funktion erzeugt einen Footer

?>
