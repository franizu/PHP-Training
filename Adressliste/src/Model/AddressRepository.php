<?php
namespace Model;

use PDO;

//indclude __DIR__ . "/AddressModel.php";


class AddressRepository {

  private $o_pdo;

  public function __construct(PDO $o_pdo){

    $this->o_pdo = $o_pdo;
  }

  public function fetchAll(){
    $stmt = $this->o_pdo->prepare("SELECT * FROM `adressen`");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_CLASS,"Model\\AddressModel");
    $o_adressen = $stmt->fetchAll(PDO::FETCH_CLASS);

    return $o_adressen;


  }

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
