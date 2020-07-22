<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Maps/Food" />
    <meta name="author" content="JasonT - info@mapthefood.com" />
    <title>MapTheFood</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="public/img/target.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
    <!-- Third party plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="public/css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
        crossorigin=""/>
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
        integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
            crossorigin=""></script>
    <link rel="stylesheet" href="public/css/leaflet-sidebar.css" />
    <link
      rel="stylesheet"
      href="//cdn.jsdelivr.net/npm/leaflet-sidebar-v2@3.1.1/css/leaflet-sidebar.min.css"
    />
    <style>
        body {background-color: #f4623a;}
        #mapid {position: absolute; top: 0px; bottom: 0px; left: 0px; right: 0px;}
    </style>
    </head>
<body>

    <!-- Sidebar-->
    <div id="sidebar" class="sidebar collapsed">
        <!-- Nav tabs -->
        <div class="sidebar-tabs">
            <ul role="tablist">
                <li><a href="#home" role="tab"><i class="fa fa-bars"></i></a></li>
                <li><a href="#layers" role="tab"><i class="fas fa-layer-group"></i></a></li>
                <li><a href="#share" role="tab"><i class="fa fa-share-alt-square"></i></a></li>
                <li><a href="#info" role="tab"><i class="fas fa-info-circle"></i></a></li>
                <li><a href="home" role="tab"><i class="fas fa-home"></i></a></li>
            </ul>


            <ul role="tablist">
                <li><a href="#settings" role="tab"><i class="fa fa-cog"></i></a></li>
            </ul>
        </div>

        <!-- Tab panes -->
        <div class="sidebar-content">
            <div class="sidebar-pane" id="home">
                <h1 class="sidebar-header">
                    Food Hygiene Edinburgh
                    <span class="sidebar-close"><i class="fa fa-caret-left"></i></span>
                </h1>
                <span id="layercontrol"></span>
                <p>A responsive sidebar for mapping libraries like <a href="http://leafletjs.com/">Leaflet</a> or <a href="http://openlayers.org/">OpenLayers</a>.</p>

            </div>

            <div class="sidebar-pane" id="layers">
                <h1 class="sidebar-header">Layers<span class="sidebar-close"><i class="fa fa-caret-left"></i></span></h1>
                <div id="layers"> <!--Here the layer control menu will be added--></div>
            </div>

            <div class="sidebar-pane" id="share">
                <h1 class="sidebar-header">Share<span class="sidebar-close"><i class="fa fa-caret-left"></i></span></h1>
            </div>

            <div class="sidebar-pane" id="settings">
                <h1 class="sidebar-header">Settings<span class="sidebar-close"><i class="fa fa-caret-left"></i></span></h1>
            </div>
        </div>
    </div>

    <div id="mapid"></div>  
    
    

    








    <script src="public/js/leaflet-sidebar.js"></script>

    <script>
    //Map object
	var mymap = L.map('mapid',{zoomControl: false}).setView([55.953251, -3.188267], 12);

    //Map properties
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 18,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1
    }).addTo(mymap);

    //Marker categories
    var retail = L.layerGroup();
    var takeaway = L.layerGroup();
    var hotel = L.layerGroup();
    var restaurant = L.layerGroup();
    var packers = L.layerGroup();
    var otherRetail = L.layerGroup();
    var pubBarClub = L.layerGroup();
    var otherCatering = L.layerGroup();
    var school = L.layerGroup();
    var hospital = L.layerGroup();

    var improvementRequired = L.layerGroup();
    var pass = L.layerGroup();
    var passAndEatSafe = L.layerGroup();
    var awaitingInspection = L.layerGroup();

    //Define the icon
    var dotIcon = L.icon ({
        iconUrl: 'public/img/dot.png',
        iconSize: [20,20],
    });

    //Loop through the results and categorize
    <?php foreach($data['ratings'] as $rating) : ?>

    var marker = L.marker([<?php echo $rating->latitude; ?>, <?php echo $rating->longitude; ?>], {icon:dotIcon}).bindPopup("<b><?php echo $rating->name; ?></b><br/><?php echo $rating->rating; ?>");

    //Check category
    <?php
        if($rating->business_type == 'Retailers - supermarkets/hypermarkets'){?>
            marker.addTo(retail);
    <?php } ?>
    <?php
        if($rating->business_type == 'Takeaway/sandwich shop'){?>
            marker.addTo(takeaway);
    <?php } ?>
    <?php
        if($rating->business_type == 'Hotel/bed & breakfast/guest house'){?>
            marker.addTo(hotel);
    <?php } ?>
    <?php
        if($rating->business_type == 'Restaurant/Cafe/Canteen'){?>
            marker.addTo(restaurant);
    <?php } ?>
    <?php
        if($rating->business_type == 'Manufacturers/packers'){?>
            marker.addTo(packers);
    <?php } ?>
    <?php
        if($rating->business_type == 'Retailers - other'){?>
            marker.addTo(otherRetail);
    <?php } ?>
    <?php
        if($rating->business_type == 'Pub/bar/nightclub'){?>
            marker.addTo(pubBarClub);
    <?php } ?>
    <?php
        if($rating->business_type == 'Other catering premises'){?>
            marker.addTo(otherCatering);
    <?php } ?>
    <?php
        if($rating->business_type == 'School/college/university'){?>
            marker.addTo(school);
    <?php } ?>
    <?php
        if($rating->business_type == 'Hospitals/Childcare/Caring Premises'){?>
            marker.addTo(hospital);
    <?php } ?>

    //Check rating
    <?php
        if($rating->rating == 'Improvement Required'){?>
            marker.addTo(improvementRequired);
    <?php } ?>  
    <?php
        if($rating->rating == 'Pass'){?>
            marker.addTo(pass);
    <?php } ?> 
    <?php
        if($rating->rating == 'Pass and Eat Safe'){?>
            marker.addTo(passAndEatSafe);
    <?php } ?> 
    <?php
        if($rating->rating == 'Awaiting Inspection'){?>
            marker.addTo(awaitingInspection);
    <?php } ?> 


    <?php endforeach; ?>

    var categories = {
            "Retailers - supermarkets/hypermarkets": retail,
            "Takeaway/sandwich shop": takeaway,
            "Hotel/bed & breakfast/guest house": hotel,
            "Restaurant/Cafe/Canteen": restaurant,
            "Manufacturers/packers": packers,
            "Retailers - other": otherRetail,
            "Pub/bar/nightclub": pubBarClub,
            "Other catering premises": otherCatering,
            "School/college/university": school,
            "Hospitals/Childcare/Caring Premises": hospital,
    }

    var rating = {
        "Improvement Required": improvementRequired,
        "Pass": pass,
        "Pass and Eat Safe": passAndEatSafe,
        "Awaiting Inspection": awaitingInspection,
    }
 
    //Scale
    L.control.scale({position: 'bottomright'}).addTo(mymap);

    //Zoom control
    L.control.zoom({position: 'bottomright'}).addTo(mymap);

    //Sidebar
    var sidebar = L.control.sidebar('sidebar', {autopan: "false", container: "sidebar"}).addTo(mymap);

    //Layer controls
    var layerControl = L.control.layers(null, categories, {position: 'topright', collapsed: false}).addTo(mymap);
    var layerControl2 = L.control.layers(null, rating, {position: 'topright', collapsed: false}).addTo(mymap);
    //Move Layers control to sidebar
    var layerControlContainer = layerControl.getContainer();
    var layerControlContainer2 = layerControl2.getContainer();
    var a = document.getElementById('layers');
    function setParent(el, newParent){
        newParent.appendChild(el);
    }
    setParent(layerControlContainer, a);
    setParent(layerControlContainer2, a);

    
	
</script>
<!-- Bootstrap core JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>