<?php

/* Dateiname: EditView.php
* Autor: RS
* PHP-Training: Erstellung einer Adressliste
* Funktion: Erzeugen einer Ansicht zum Editieren der Adressdaten
*/
namespace View;

class EditView{
    private $action;

    public function __construct($action)
    {
        $this->action = $action;

    }

    public function output_form($a_addresses,$edit_id){

        $nr = sizeof($a_addresses);
        $index = Array($nr);
        for ($i=0;$i<$nr;$i++){
            $index[$a_addresses[$i]->id] = $i;
        }

        $o_address = $a_addresses[$index[$edit_id]];

        //$o_address = $this->find_address_object_in_a_addresses($a_addresses,$edit_id);

        echo "<br /><br />";
        echo "<form name='adresseingabe' method='POST' action='$this->action'>" ;
        echo $this->get_form_fragment('ID','id',$o_address->id);
        echo $this->get_form_fragment('Vorname','vorname',$o_address->vorname);
        echo $this->get_form_fragment('Nachname','nachname',$o_address->nachname);
        echo $this->get_form_fragment('Straße/Hausnummer','strasse',$o_address->strasse);
        echo $this->get_form_fragment('Postleitzahl','plz',$o_address->plz);
        echo $this->get_form_fragment('Ort','ort',$o_address->ort);
        echo $this->get_form_fragment('Länge','longitude',$o_address->longitude);
        echo $this->get_form_fragment('Breite','latitude',$o_address->latitude);

        echo "<br />\n";
        echo "<button name='speichern' type='submit' value='$edit_id'>Eingaben absenden</button>\n";
        echo "</form";
    }

    /*  Funktion: HTML-Fragment zur Erzeugung eines Eingabefeldes und dessen Bezeichnung
    *   Parameter: $title(string) - Titel des Eingabefeldes, $name(string) - Name des Eingabefeldes
    *   Ergebnis: HTML-Fragment(string)
    */
    private function get_form_fragment($title,$name,$addressdata)
    {

        return "<div ><strong>{$title}:</strong><input name=\"adresse[$name]\" type='text' value=\"$addressdata\" ></div>";

    }


}





?>