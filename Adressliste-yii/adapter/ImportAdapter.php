<?php
/**
 * Created by PhpStorm.
 * User: rober
 * Date: 10.04.2019
 * Time: 15:52
 */

namespace app\adapter;

use app\models\Adressen;

class ImportAdapter{

    /*private $target_dir;

    public function __construct($target_dir)
    {
       $this->target_dir = $target_dir;
    }


    public function upload_target_file($file) {
        //$target_dir = __DIR__ . "/../uploads/";
        $target_file = $this->target_dir . basename($file ["name"]);
        //$uploadOk = 1;
        //$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        move_uploaded_file($file ["tmp_name"], $target_file);
        return $target_file;
    }*/

    private function transform_import_array($a_import_addresses){

        $nr = count($a_import_addresses); //number of rows
        $a_addresses = [];
        $a_newkey = ['vorname',
            'nachname',
            'strasse',
            'plz',
            'ort'];


        $a_oldkeys = array_keys($a_import_addresses[2]);
        $a_keys = array_combine($a_newkey,$a_oldkeys);

        for($i=1; $i<=$nr; $i++){
            $a_address = $a_import_addresses[$i];
            $a_address_new = [];
            foreach ($a_keys as $newkey => $oldkey) {
                $a_address_new[$newkey] = $a_address[$oldkey];
            }
            $a_addresses[] = $a_address_new;
        }
        return $a_addresses;

    }



    public function get_addresses($target_file){
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader->setReadFilter( new ReadFilter() );
        $o_spreadsheet = $reader->load($target_file);
        $xls_data = $o_spreadsheet->getActiveSheet()->toArray(null ,true,true,true);

        $a_addresses = $this->transform_import_array($xls_data);


        $a_model = [];
        $o_geocode = new GeocodeAdapter();
        foreach ($a_addresses as $a_address){

            $a_address = array_filter($a_address); // Filtern von leeren Zellen
            if (count($a_address)==5) {
                $model = new Adressen();
                $model->vorname = $a_address['vorname'];
                $model->nachname = $a_address['nachname'];
                $model->strasse = $a_address['strasse'];
                $model->plz = $a_address['plz'];
                $model->ort = $a_address['ort'];

                $model = $o_geocode->get_geocode($model);

                $a_model[] = $model;
            }
        }

        return $a_model;
    }
}
?>