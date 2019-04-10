<?php


use yii\web\JsExpression;


$this->title = 'Karte';
$this->params['breadcrumbs'][] = ['label' => 'Adressen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;




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

function placeMarker($model)
{

    for ($i = 0; $i<count($model);$i++){

        if ($i<count($model)-1) {
            $longitude_start = $model[$i]->longitude;
            $latitude_start = $model[$i]->latitude;
            $longitude_end = $model[$i + 1]->longitude;
            $latitude_end = $model[$i + 1]->latitude;
        }
        else {
            $longitude_start = $model[$i]->longitude;
            $latitude_start = $model[$i]->latitude;
            $longitude_end = $model[0]->longitude;
            $latitude_end = $model[0]->latitude;
        }

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
        echo "map.setCenter(lonLat,10);";



        echo "</script>";

    }
}

echo "</script>";
echo "<div id=\"mapdiv\" style=\"height:600px; width: 1000px;\"></div>";
echo "<script>init();</script>";
placeMarker($model);
?>