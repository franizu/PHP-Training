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
        "INSERT INTO `adressen` (`id`, `vorname`, `nachname`, `strasse`, `plz`, `ort`) VALUES (:id, :vorname, :nachname, :strasse, :plz, :ort)"
    );
    // Adressdaten in Datenbanktabelle einfügen
    $stmt->execute([
        'id' => NULL,
        'vorname' => $a_adresse['vorname'],
        'nachname' => $a_adresse['nachname'],
        'strasse' => $a_adresse['strasse'],
        'plz' => $a_adresse['plz'],
        'ort' => $a_adresse['ort']

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
