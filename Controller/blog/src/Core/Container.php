<?php

/* Dateiname: Container.php
*  Autor: RS
*  Training PHP Udemy - Blog-Programmierung
*  Funktion: Erzeugung von Objekten für Datenbankabruf
*
*/

namespace App\Core;

use PDO;
use App\Post\PostsRepository;
use App\Post\PostsController;

class Container
{
  private $receipts = [];
  private $instances = [];

  public function __construct()
  {
    /*
      * Funktion: Erzeugt eine Bauanleitung für die einzelnen Objekte
      * Parameter:keine
      * Ergebnis: Array welches Closures für Datenbankabruf enthält

  // Bauanleitung Erzeugung eines PostsControllers
      */
    $this->receipts = [
      'postsController' => function() {
        return new PostsController(
          $this->make('postsRepository')
        );
      },

      // Bauanleitung zur Erzeugung eines PostsRepositories

      'postsRepository' => function() {
        return new PostsRepository(
          $this->make("pdo")
        );
      },

      //Bauanleitung zur Erzeugung eines Objektes zum Aufbau einer Datenbankverbindung
      'pdo' => function() {
        $pdo = new PDO(
          'mysql:host=localhost;dbname=blog;charset=utf8',
          'blog',
          'rAx2j5lUqNPiRFN1'
        );
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $pdo;
      }
    ];
  }

  public function make($name)
  {
      /*
      * Funktion: make-Funktion erzeugt die Objekte
      * Parameter: $name - postsController, postsRepository, pdo
      * Ergebnis: Objekte für Datenbankabruf
      */
    if (!empty($this->instances[$name])) // Verhindert, dass mehrere Datenbankverbindungen aufgebaut werden
    {
      return $this->instances[$name];
    }

    if (isset($this->receipts[$name])) {
      $this->instances[$name] = $this->receipts[$name]();
    }

    return $this->instances[$name];
  }

}
 ?>
