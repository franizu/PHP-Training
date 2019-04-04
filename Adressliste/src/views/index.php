<?php
/* Dateiname: index.php
* Autor: RS
* PHP-Training: Erstellung einer Adressliste
* Funktion: Anzeige, Abrufen von Adressdaten aus Datenbank und Einfügen von Adressdaten in Datenbank
*/

include __DIR__ . "/layout/header.php";
include __DIR__ . "/layout/footer.php";
include __DIR__ . "/layout/form.php";
include __DIR__ . "/layout/table.php";
include __DIR__ . "/../Model/AddressRepository.php";

// Erstellung einer Datenbankverbindung
$o_pdo = new PDO('mysql:host=localhost;dbname=adressliste;charset=utf8',
    'adressliste','U6MY6gd3dquwJHj2');



$o_addressRepository = new \Model\AddressRepository($o_pdo);

if (isset($_POST['senden'])){
    $a_adresse = $_POST;
    $o_addressRepository -> insertAddress($a_adresse); // Einfügen einer neuen Adresse in Dantenbanktabelle
}
if(isset($_POST['löschen'])){
    $address_id = $_POST['löschen'];
    $o_addressRepository->deleteAddress($address_id);
}

if (isset($_POST['speichern'])){
    $address_id = $_POST['speichern'];
    $a_adresse = $_POST['adresse'];
    $o_addressRepository->updateAddress($address_id,$a_adresse);

}
$o_adressen = $o_addressRepository->fetchAll(); // Abrufen der Adressdaten aus Datenbanktabelle


output_header(); // Funktion erzeugt einen Header

if (isset($_POST['bearbeiten'])) {
    $edit_id = $_POST['bearbeiten'];
    output_table($o_adressen,$edit_id); // Erzeugung einer HTML-Tabelle mit Adressdaten
}
else{
    $edit_id = null;
    output_table($o_adressen,$edit_id);
}

output_form('POST',"index.php");  // Funktion erzeugt ein Formular zur Eingabe einer Adresse

output_footer(); // Funktion erzeugt einen Footer

?>
