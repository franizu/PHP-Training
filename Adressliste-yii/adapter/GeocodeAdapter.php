<?php
/**
 * Created by PhpStorm.
 * User: rober
 * Date: 10.04.2019
 * Time: 14:24
 */

namespace app\adapter;

use maxh\Nominatim\Nominatim;

class GeocodeAdapter{

    public function get_geocode($model){

        $url = "http://nominatim.openstreetmap.org/";
        $o_nominatim = new Nominatim($url);
        $search = $o_nominatim->newSearch()
            //->country('Germany')
            ->city($model->ort)
            ->postalCode($model->plz)
            ->polygon('geojson')    //or 'kml', 'svg' and 'text'
            ->street($model->strasse)
            ->addressDetails();

        $a_search_result = $o_nominatim->find($search);
        $a_geocode = $a_search_result[0];
        $model->longitude = $a_geocode['lon'];
        $model->latitude = $a_geocode['lat'];

        return $model;
    }




}



?>