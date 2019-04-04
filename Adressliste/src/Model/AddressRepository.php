<?php

/* Dateiname: AddressRepository.php
* Autor: RS
* PHP-Training: Erstellung einer Adressliste
* Funktion: Erzeugung einer Klasse zum Abrufen und Einfügen von Addressdaten aus/in Datenbanktabelle
*/

namespace Model;

use PDO;



class AddressRepository {

  private $o_pdo;

  public function __construct(PDO $o_pdo){

    $this->o_pdo = $o_pdo;
  }

  /*  Funktion: Abruf von Adressdaten aus Datenbanktabelle und Speichern der Adressdaten in AddressModel
  *   Parameter: keine
  *   Ergebnis: Objekt mit Adressdaten
  */
  public function fetchAll(){
    $stmt = $this->o_pdo->prepare("SELECT * FROM `adressen`");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS,"Model\\AddressModel");
    $o_adressen = $stmt->fetchAll(PDO::FETCH_CLASS);

    return $o_adressen;


  }

  /*  Funktion: Einfügen von Adressdaten in Datenbanktabelle
  *   Parameter: keine
  *   Ergebnis: keine
  */
  public function insertAddress(){

    $stmt = $this->o_pdo->prepare(
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



}





 ?>
