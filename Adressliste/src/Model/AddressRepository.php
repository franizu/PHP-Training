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

  /*  Funktion: Abruf von Adressdaten aus Datenbanktabelle und Speichern der Adressdaten in AddressModel
  *   Parameter: keine
  *   Ergebnis: Objekt mit Adressdaten
  */

  public function transform_import_array($a_import_addresses){

    $nr = count($a_import_addresses); //number of rows
    for($i=2; $i<=$nr; $i++){
      $a_address = $a_import_addresses[$i];
      $a_keys = array_keys($a_address);
      $a_address['vorname'] = $a_address[$a_keys[0]];
      unset($a_address[$a_keys[0]]);
      $a_address['nachname'] = $a_address[$a_keys[1]];
      unset($a_address[$a_keys[1]]);
      $a_address['strasse'] = $a_address[$a_keys[2]];
      unset($a_address[$a_keys[2]]);
      $a_address['plz'] = $a_address[$a_keys[3]];
      unset($a_address[$a_keys[3]]);
      $a_address['ort'] = $a_address[$a_keys[4]];
      unset($a_address[$a_keys[4]]);

      $a_import_addresses[$i] = $a_address;
    }

    return $a_import_addresses;

  }

  public function fetchAll()
  {
    $stmt = $this->o_pdo->prepare("SELECT * FROM `adressen`");
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

  public function deleteAddress($address_id)
  {

    $stmt = $this->o_pdo->prepare("DELETE FROM `adressen` WHERE `adressen`.`id` = '$address_id'");
    $stmt->execute();

  }

  public function  updateAddress($address_id,$a_adresse){
    $stmt = $this->o_pdo->prepare("UPDATE `adressen` SET `vorname` = \"{$a_adresse['vorname']}\", `nachname` = \"{$a_adresse['nachname']}\", `strasse` = \"{$a_adresse['strasse']}\", `plz` = \"{$a_adresse['plz']}\", `ort` = \"{$a_adresse['ort']}\" WHERE `adressen`.`id` = '$address_id'");
    $stmt->execute();
  }
}
 ?>
