<?php


use yii\web\JsExpression;


$this->title = 'Karte';
$this->params['breadcrumbs'][] = ['label' => 'Adressen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;




echo <<<EOF
 <script src="http://openlayers.org/api/OpenLayers.js"></script>
 <script type="text/javascript">
 var map, mappingLayer, vectorLayer, selectMarkerControl, selectedFeature;
EOF;
/*echo "function onFeatureSelect(feature) {";
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
echo "}";*/

echo <<<EOF
    function init(){
    
        map = new OpenLayers.Map( 'mapdiv');
        mappingLayer = new OpenLayers.Layer.OSM("Simple OSM Map");
    
        map.addLayer(mappingLayer);
        vectorLayer = new OpenLayers.Layer.Vector("Vector Layer", {projection: "EPSG:4326"});
        selectMarkerControl = new OpenLayers.Control.SelectFeature(vectorLayer, {onSelect: onFeatureSelect, onUnselect: onFeatureUnselect});
        map.addControl(selectMarkerControl);
    
        selectMarkerControl.activate();
        map.addLayer(vectorLayer);
        map.setCenter(
                        new OpenLayers.LonLat(0, 0).transform(
                            new OpenLayers.Projection("EPSG:4326"),
                            map.getProjectionObject())
        
                        , 1
                    );
    }

    </script>
EOF;

function output_section($lon_start, $lat_start, $lon_end, $lat_end){

    echo <<<EOF

        <script>

        var start_point = new OpenLayers.Geometry.Point($lon_start,$lat_start);
        var end_point = new OpenLayers.Geometry.Point($lon_end,$lat_end);

        var vector = new OpenLayers.Layer.Vector();
        vector.addFeatures([new OpenLayers.Feature.Vector(start_point.clone().transform(new OpenLayers.Projection("EPSG:4326"), new OpenLayers.Projection("EPSG:900913")),
                               {
                                 name: "Hans",
                                     age: 32
                                 }),
                                    
                                    new OpenLayers.Feature.Vector(end_point.clone().transform(new OpenLayers.Projection("EPSG:4326"), new OpenLayers.Projection("EPSG:900913"))),
                                 
                                    
                                    new OpenLayers.Feature.Vector(new OpenLayers.Geometry.LineString([start_point, end_point]).transform(new OpenLayers.Projection("EPSG:4326"), new OpenLayers.Projection("EPSG:900913")))
                                    
                                    ]);
    

        map.addLayers([mappingLayer,vector]);
        map.addLayer(new OpenLayers.Layer.OSM());
        var lonLat = new OpenLayers.LonLat( $lon_start ,$lat_start )
                    .transform(
                    new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
                    map.getProjectionObject() // to Spherical Mercator Projection
                    );
        map.setCenter(lonLat,10);



        </script>

EOF;
}

function placeMarker($model)
{
    for ($i = 0; $i < count($model)-1; $i++) {

        output_section($model[$i]->longitude, $model[$i]->latitude, $model[$i + 1]->longitude, $model[$i + 1]->latitude);

    }

    output_section($model[count($model)-1]->longitude, $model[count($model)-1]->latitude, $model[0]->longitude, $model[0]->latitude);

}
echo "</script>";
echo "<div id=\"mapdiv\" style=\"height:600px; width: 1000px;\"></div>";
echo "<script>init();</script>";
placeMarker($model);
?>