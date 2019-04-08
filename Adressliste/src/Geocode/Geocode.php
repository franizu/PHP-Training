<?php
namespace Geocode;

class Geocode{

    private $o_nominatim;

    public function __construct(\maxh\Nominatim\Nominatim $o_nominatim)
    {
       $this->o_nominatim = $o_nominatim;
    }

    public function get_geocode($a_address){

        $search = $this->o_nominatim->newSearch()
            //->country('Germany')
            ->city($a_address['ort'])
            ->postalCode($a_address['plz'])
            ->polygon('geojson')    //or 'kml', 'svg' and 'text'
            ->street($a_address['strasse'])
            ->addressDetails();

        $result = $this->o_nominatim->find($search);

        $a_geocode = $result[0];

        $a_address['longitude'] = $a_geocode['lon'];
        $a_address['latitude'] = $a_geocode['lat'];

        return $a_address;
    }
}



?>