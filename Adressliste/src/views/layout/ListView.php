<?php

namespace View;

//include __DIR__ . "/style.php";

class ListView {



    /*  Funktion: HTML-Fragment zur Erzeugung eines Tabellenkopfes
    *   Parameter: $title(string) - Titel der Tabellenspalte
    *   Ergebnis: HTML-Fragment(string)
    */
    private function get_table_head_fragment($title){

        return "<th>$title</th>";
    }

    /*  Funktion: HTML-Fragment zur Erzeugung eines Tabellenzelle
    *   Parameter: $value(string) - Adressdaten
    *   Ergebnis: HTML-Fragment(string)
    */
    private function get_table_body_fragment($addressdata){

        //return "<td><input type = 'text' value=\"$addressdata\" readonly ></td>";
        return "<td>$addressdata</td>";
    }

    private function get_button($title,$name,$address_id){

        return "<td><button type=\"submit\" name='$name' value='$address_id' >$title </button></td>";
    }

    public function output_table($o_adressen){

        echo "<br/><br/>";
        echo "<form id = 'table' method='POST' action='index.php'>";
        echo "<table border='1'>";
        echo "<thead><tr>";
        echo $this->get_table_head_fragment('Vorname');
        echo $this->get_table_head_fragment('Nachname');
        echo $this->get_table_head_fragment('Straße/Hausnummer');
        echo $this->get_table_head_fragment('Postleitzahl');
        echo $this->get_table_head_fragment('Ort');
        echo "</tr></thead>";

        echo "<tbody>";


        foreach ($o_adressen as $adresse) {
            echo "<tr>";
            echo $this->get_table_body_fragment($adresse->vorname);
            echo $this->get_table_body_fragment($adresse->nachname);
            echo $this->get_table_body_fragment($adresse->strasse);
            echo $this->get_table_body_fragment($adresse->plz);
            echo $this->get_table_body_fragment($adresse->ort);

            echo $this->get_button('Löschen','loeschen',$adresse->id);
            echo $this->get_button('Bearbeiten','bearbeiten',$adresse->id);
            echo $this->get_button('Karte anzeigen','karte',$adresse->id);

            echo "</tr>";
        }

        echo "</tbody></table></form>";
    }

    /*  Funktion: Funktion erzeugt ein Formular zur Eingabe einer Adresse und Buttons zum Speichern und Löschen einer Adresse
     *   Parameter: $method(string) - HTTP-Methode ; $action(string) - Aktion, die ausgeführt wird, wenn Formular submitted wird
     *   Ergebnis: HTML-Formular
     */

    public function output_form($method,$action){

        echo "<br /><br />";
        echo "<form name='adresseingabe' method='$method' action='$action'>" ;
        echo $this->get_form_fragment('Vorname','vorname');
        echo $this->get_form_fragment('Nachname','nachname');
        echo $this->get_form_fragment('Straße/Hausnummer','strasse');
        echo $this->get_form_fragment('Postleitzahl','plz');
        echo $this->get_form_fragment('Ort','ort');
        echo "<br />\n";
        echo "<button name='senden' type='submit'>Eingaben absenden</button>\n";
        echo "</form>";
    }

    /*  Funktion: HTML-Fragment zur Erzeugung eines Eingabefeldes und dessen Bezeichnung
    *   Parameter: $title(string) - Titel des Eingabefeldes, $name(string) - Name des Eingabefeldes
    *   Ergebnis: HTML-Fragment(string)
    */
    private function get_form_fragment($title,$name)
    {

        return "<div id ='content'><strong>{$title}:</strong><br><input type='text' name={$name}></div>";

    }

    public function output_import($action){

        echo "<div>";
        echo "<form name='import_excel' method='POST' action='$action'>" ;
        echo "<button name='import' type='submit'>Import</button>\n";
        echo "<input type=\"file\" id=\"files\" name= \"files[]\" multiple />";
        echo "<output id=\"list\" name='file'></output>";

        echo "<script>";
          echo "function handleFileSelect(evt) {";
              echo "var files = evt.target.files;"; // FileList object

              // files is a FileList of File objects. List some properties.
              echo "var output = [];";
              echo "for (var i = 0, f; f = files[i]; i++) {";
                  echo "output.push('<li><strong>', escape(f.name), '</strong> (', f.type || 'n/a', ') - ',
                      f.size, ' bytes, last modified: ',
                      f.lastModifiedDate.toLocaleDateString(), '</li>');";
              echo "}";
            echo "document.getElementById('list').innerHTML = '<ul>' + output.join('') + '</ul>';";
         echo "}";

          echo "document.getElementById('files').addEventListener('change', handleFileSelect, false);";
        echo "</script>";
        echo "</form>";
        echo "</div>";
    }
}






?>