<?php
/* Dateiname: MapView.php
* Autor: RS
* PHP-Training: Erstellung einer Adressliste
* Funktion: Erzeugen einer Karte mit Marker
*/
namespace View;

class MapView
{
    public function output_map($address_id, $a_addresses)
    {

        /*$nr = sizeof($a_addresses);
        $index = Array($nr);
        for ($i=0;$i<$nr;$i++){
            $index[$a_addresses[$i]->id] = $i;
        }

        $o_address = $a_addresses[$index[$address_id]];

        //$o_address = $this->find_address_object_in_a_addresses($a_addresses,$address_id);
        echo "<div id=\"mapdiv\">";
        echo "</div>";
        echo "<script src=\"http://www.openlayers.org/api/OpenLayers.js\"></script>";
        echo "<script>";
        echo "map = new OpenLayers.Map(\"mapdiv\");";

        foreach ($a_addresses as $o_address) {
            echo "map.addLayer(new OpenLayers.Layer.OSM());";
            echo "var lonLat = new OpenLayers.LonLat( {$o_address->longitude} ,{$o_address->latitude} )
            .transform(
            new OpenLayers.Projection(\"EPSG:4326\"), // transform from WGS 1984
            map.getProjectionObject() // to Spherical Mercator Projection
            );";

            echo "var zoom=16;";

            echo "var markers = new OpenLayers.Layer.Markers( \"Markers\" );";
            echo "map.addLayer(markers);";

            echo "markers.addMarker(new OpenLayers.Marker(lonLat));";
        }
        echo "map.setCenter (lonLat, zoom);";
        echo "</script>";

        echo "<form method='POST' action='index.php'>";
        echo "<button type='submit'>Zurück</button></form>";*/

        echo "<script src=\"http://openlayers.org/api/OpenLayers.js\"></script>";
        echo "<script type=\"text/javascript\">";
        echo "var map, mappingLayer, vectorLayer, selectMarkerControl, selectedFeature;";

        echo "function onFeatureSelect(feature) {";
        echo "selectedFeature = feature;";
        echo "popup = new OpenLayers.Popup.FramedCloud(\"tempId\", feature.geometry.getBounds().getCenterLonLat(),
                    null,
                    selectedFeature.attributes.salutation + \" from Lat:\" + selectedFeature.attributes.Lat + \" Lon:\" + selectedFeature.attributes.Lon,
                    null, true);";
        echo "feature.popup = popup;";
        echo "map.addPopup(popup);";
        echo "}";

        echo "function onFeatureUnselect(feature) {";
        echo "map.removePopup(feature.popup);";
        echo "feature.popup.destroy();";
        echo "feature.popup = null;";
        echo "}";

        echo "function init(){";
        echo "map = new OpenLayers.Map( 'mapdiv');";
        echo "mappingLayer = new OpenLayers.Layer.OSM(\"Simple OSM Map\");";

        echo "map.addLayer(mappingLayer);";
        echo "vectorLayer = new OpenLayers.Layer.Vector(\"Vector Layer\", {projection: \"EPSG:4326\"});";
        echo "selectMarkerControl = new OpenLayers.Control.SelectFeature(vectorLayer, {onSelect: onFeatureSelect, onUnselect: onFeatureUnselect});";
        echo "map.addControl(selectMarkerControl);";

        echo "selectMarkerControl.activate();";
        echo "map.addLayer(vectorLayer);";
        echo "map.setCenter(
                new OpenLayers.LonLat(0, 0).transform(
                    new OpenLayers.Projection(\"EPSG:4326\"),
                    map.getProjectionObject())

                , 1
            );";
        echo "}";
        echo "</script>";

        function placeMarker($a_addresses)
        {

            for ($i = 0; $i<count($a_addresses)-1;$i++){

                $longitude_start = $a_addresses[$i]->longitude;
                $latitude_start = $a_addresses[$i]->latitude;
                $longitude_end = $a_addresses[$i+1]->longitude;
                $latitude_end = $a_addresses[$i+1]->latitude;


                echo "<script>";

                echo "var start_point = new OpenLayers.Geometry.Point($longitude_start,$latitude_start);";
                echo "var end_point = new OpenLayers.Geometry.Point($longitude_end,$latitude_end);";

                echo "var vector = new OpenLayers.Layer.Vector();";
                echo "vector.addFeatures([new OpenLayers.Feature.Vector(start_point.clone().transform(new OpenLayers.Projection(\"EPSG:4326\"), new OpenLayers.Projection(\"EPSG:900913\")),
                               {
                                 name: \"Hans\",
                                     age: 32
                                 }),
                                    
                                    new OpenLayers.Feature.Vector(end_point.clone().transform(new OpenLayers.Projection(\"EPSG:4326\"), new OpenLayers.Projection(\"EPSG:900913\"))),
                                 
                                    
                                    new OpenLayers.Feature.Vector(new OpenLayers.Geometry.LineString([start_point, end_point]).transform(new OpenLayers.Projection(\"EPSG:4326\"), new OpenLayers.Projection(\"EPSG:900913\")))
                                    
                                    ]);";

                /*echo "var LonLat = new OpenLayers.Geometry.Point($longitude_start, $latitude_start);";
                echo "LonLat.transform(\"EPSG:4326\", map.getProjectionObject());";
                echo "var Feature = new OpenLayers.Feature.Vector(LonLat,
                                    { salutation: \"hello world\", Lon : $longitude_start, Lat : $latitude_start});";
                echo "vectorLayer.addFeatures(Feature);";


                echo "var popup = new OpenLayers.Popup.FramedCloud(\"tempId\", new OpenLayers.LonLat( $longitude_start, $latitude_start).transform(\"EPSG:4326\", map.getProjectionObject()),
                    null,
                    randomFeature.attributes.salutation + \" from Lat:\" + randomFeature.attributes.Lat + \" Lon:\" + randomFeature.attributes.Lon,
                    null, true);";
                echo "Feature.popup = popup;";
                echo "map.addPopup(popup);";*/

                echo "map.addLayers([mappingLayer,vector]);";
                echo "map.addLayer(new OpenLayers.Layer.OSM());";
                echo "var lonLat = new OpenLayers.LonLat( $longitude_start ,$latitude_start )
                    .transform(
                    new OpenLayers.Projection(\"EPSG:4326\"), // transform from WGS 1984
                    map.getProjectionObject() // to Spherical Mercator Projection
                    );";
                echo "map.setCenter(lonLat,8);";


                
                echo "</script>";

            }
        }


        echo "<div id=\"mapdiv\" style=\"height:600px; width: 1000px;\"></div>";
        echo "<script>init();</script>";
        placeMarker($a_addresses);
        echo "<form method='POST' action='index.php'>";
        echo "<button type='submit'>Zurück</button></form>";
    }
}

?>