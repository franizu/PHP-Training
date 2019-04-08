<?php
/* Dateiname: index.php
* Autor: RS
* PHP-Training: Erstellung einer Adressliste
* Funktion: Anzeige, Abrufen von Adressdaten aus Datenbank und Einfügen von Adressdaten in Datenbank
*/
require __DIR__ .  '/../vendor/autoload.php';
include __DIR__ . "/layout/header.php";
include __DIR__ . "/layout/output_map.php";
include __DIR__ . "/layout/footer.php";
include __DIR__ . "/layout/form.php";
include __DIR__ . "/layout/table.php";
include __DIR__ . "/layout/ListView.php";
include __DIR__ . "/layout/EditView.php";
include __DIR__ . "/layout/MapView.php";
include __DIR__ . "/../Model/AddressRepository.php";
include __DIR__ . "/../Geocode/Geocode.php";


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use maxh\Nominatim\Nominatim;


$url = "http://nominatim.openstreetmap.org/";
$o_nominatim = new Nominatim($url);

// Erstellung einer Datenbankverbindung
$o_pdo = new PDO('mysql:host=localhost;dbname=adressliste;charset=utf8',
    'adressliste','U6MY6gd3dquwJHj2');

$o_geocode = new \Geocode\Geocode($o_nominatim);

$o_addressRepository = new \Model\AddressRepository($o_pdo);

if (isset($_POST['senden'])){
    $a_adresse = $_POST;
    $a_adresse = $o_geocode->get_geocode($a_adresse);   // Ermitteln des Geocodes
    $o_addressRepository -> insertAddress($a_adresse); // Einfügen einer neuen Adresse in Dantenbanktabelle
}
if (isset($_POST['loeschen'])){
    $address_id = $_POST['loeschen'];
    $o_addressRepository->deleteAddress($address_id);   // löschen eines Eintrages in Datenbanktabelle
}

if (isset($_POST['speichern'])){
    $address_id = $_POST['speichern'];
    $a_adresse = $_POST['adresse'];
    $o_addressRepository->updateAddress($address_id,$a_adresse);    // Updaten eines Eintrages in Datenbanktabelle

}

if(isset($_POST['import'])){
    $a_files = $_POST['files'];
    $file = $a_files[0];

    // Importieren von Adressdaten aus Spreadsheet

    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
    $xls_data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
    $a_import_addresses = $o_addressRepository->transform_import_array($xls_data);
    $nr = count($a_import_addresses); //number of rows

    for($i=0; $i<$nr; $i++){
        $a_adresse = $a_import_addresses[$i];
        $a_adresse = $o_geocode->get_geocode($a_adresse); // Ermitteln des Geocodes
        $o_addressRepository -> insertAddress($a_adresse); // Einfügen der Adressdaten in datenbanktabelle
    }

}
$a_adressen = $o_addressRepository->fetchAll(); // Abrufen der Adressdaten aus Datenbanktabelle

function compare_vorname($o_address_a, $o_address_b)
{
    return strcasecmp($o_address_a->vorname, $o_address_b->vorname);
}

usort($a_adressen, "compare_vorname"); // Sortieren der Adressdaten alphabetisch nach Vornamen



$o_listView = new \View\ListView();
$o_editView = new \View\EditView('index.php');
$o_mapView = new \View\MapView();





output_header(); // Funktion erzeugt einen Header

if (isset($_POST['bearbeiten'])) {
    $edit_id = $_POST['bearbeiten'];
    //output_table($o_adressen,$edit_id); // Erzeugung einer HTML-Tabelle mit Adressdaten
    $o_editView->output_form($a_adressen,$edit_id);
}
elseif (isset($_POST['karte'])){
    $address_id = $_POST['karte'];
    $o_mapView ->output_map($address_id,$a_adressen); // Darstellung der Karte
} else{
    $o_listView->output_table($a_adressen); //Tabelle mit Adressdaten erzeugen
    $o_listView->output_form('POST','index.php'); // Eingabeformular erzeugen
    $o_listView->output_import('index.php'); // Importer erzeugen
}

output_footer(); // Funktion erzeugt einen Footer

?>
