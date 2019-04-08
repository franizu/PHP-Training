<?php


function output_map()
{
    echo "<div id=\"mapdiv\"></div>";
    echo "<script src=\"http://www.openlayers.org/api/OpenLayers.js\"></script>";
    echo "<script>";
    echo "map = new OpenLayers.Map(\"mapdiv\");";
    echo "map.addLayer(new OpenLayers.Layer.OSM());";

    echo "var lonLat = new OpenLayers.LonLat( -0.1279688 ,51.5077286 )
    .transform(
        new OpenLayers.Projection(\"EPSG:4326\"), // transform from WGS 1984
        map.getProjectionObject() // to Spherical Mercator Projection
    );";

    echo "var zoom=16;";

    echo "var markers = new OpenLayers.Layer.Markers( \"Markers\" );";
    echo "map.addLayer(markers);";

    echo "markers.addMarker(new OpenLayers.Marker(lonLat));";

    echo "map.setCenter (lonLat, zoom);";
    echo "</script>";

}


?>