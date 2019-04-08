<?php

/* Dateiname: AddressRepository.php
* Autor: RS
* PHP-Training: Erstellung einer Adressliste
* Funktion: Erzeugung einer Klasse zum Abrufen und Einfügen von Addressdaten aus/in Datenbanktabelle
*/

namespace Model;

use PDO;



class AddressRepository
{

  private $o_pdo;



  public function __construct(PDO $o_pdo)
  {

    $this->o_pdo = $o_pdo;
  }

  /*  Funktion: Aenderung der Schlüssel des importierten Arrays
  *   Parameter: $a_import_addresses (Array) - importiertes Array
  *   Ergebnis: Array mit Adressdaten und neuen Schlüsseln
  */

  public function transform_import_array($a_import_addresses){

    $nr = count($a_import_addresses); //number of rows
    $a_addresses = [];
    $a_newkey = ['vorname',
                  'nachname',
                  'strasse',
                    'plz',
                    'ort'];


    $a_oldkeys = array_keys($a_import_addresses[2]);
    $a_keys = array_combine($a_newkey,$a_oldkeys);

    for($i=2; $i<=$nr; $i++){
      $a_address = $a_import_addresses[$i];
      $a_address_new = [];
      foreach ($a_keys as $newkey => $oldkey) {
        $a_address_new[$newkey] = $a_address[$oldkey];
      }
      $a_addresses[] = $a_address_new;
    }
    return $a_addresses;

  }

  /*  Funktion: Abruf von Adressdaten aus Datenbanktabelle und Speichern der Adressdaten in AddressModel
  *   Parameter: keine
  *   Ergebnis: Objekt mit Adressdaten
  */
  public function fetchAll()
  {
    $stmt = $this->o_pdo->prepare("SELECT id, vorname, nachname, strasse, plz, ort, longitude, latitude FROM `adressen`");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS, "Model\\AddressModel");
    $o_adressen = $stmt->fetchAll(PDO::FETCH_CLASS);

    return $o_adressen;


  }

  /*  Funktion: Einfügen von Adressdaten in Datenbanktabelle
  *   Parameter: keine
  *   Ergebnis: keine
  */
  public function insertAddress($a_adresse)
  {

    $stmt = $this->o_pdo->prepare(
        "INSERT INTO `adressen` (`id`, `vorname`, `nachname`, `strasse`, `plz`, `ort`, `longitude`, `latitude`) VALUES (:id, :vorname, :nachname, :strasse, :plz, :ort, :longitude, :latitude)"
    );
    // Adressdaten in Datenbanktabelle einfügen
    $stmt->execute([
        'id' => NULL,
        'vorname' => $a_adresse['vorname'],
        'nachname' => $a_adresse['nachname'],
        'strasse' => $a_adresse['strasse'],
        'plz' => $a_adresse['plz'],
        'ort' => $a_adresse['ort'],
        'longitude' => $a_adresse['longitude'],
        'latitude' => $a_adresse['latitude']

    ]);
  }

  /*  Funktion: Löschen eines Eintrages in Datenbanktabelle
  *   Parameter: $address_id - id des Eintrages in Datenbanktabelle
  *   Ergebnis: keine
  */
  public function deleteAddress($address_id)
  {

    $stmt = $this->o_pdo->prepare("DELETE FROM `adressen` WHERE `adressen`.`id` = '$address_id'");
    $stmt->execute();

  }

  /*  Funktion: Updaten eines Eintrages in Datenbanktabelle
  *   Parameter: $address_id - id des Eintrages in Datenbanktabelle, $a_adresse(Array) - Adressdaten
  *   Ergebnis: keine
  */
  public function  updateAddress($address_id,$a_adresse){
    $stmt = $this->o_pdo->prepare("UPDATE `adressen` SET `vorname` = \"{$a_adresse['vorname']}\", `nachname` = \"{$a_adresse['nachname']}\", `strasse` = \"{$a_adresse['strasse']}\", `plz` = \"{$a_adresse['plz']}\", `ort` = \"{$a_adresse['ort']}\" WHERE `adressen`.`id` = '$address_id'");
    $stmt->execute();
  }
}
 ?>
