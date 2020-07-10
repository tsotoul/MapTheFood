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
        <style>
            body {background-color: #f4623a;}
            #mapid {position: absolute; top: 70px; bottom: 50px; left: 10px; right: 10px;}
        </style>
    </head>
<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="home">MapTheFood</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto my-2 my-lg-0">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="home #about">About</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="home #services">Projects</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="home #contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="mapid"></div>
 









<script>
    //Map object
	var mymap = L.map('mapid').setView([55.953251, -3.188267], 13);

    //Map properties
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 18,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
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
    

    <?php foreach($data['ratings'] as $rating) : ?>

    var marker = L.marker([<?php echo $rating->latitude; ?>, <?php echo $rating->longitude; ?>]).bindPopup("<b><?php echo $rating->name; ?></b>");
    
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
    <?php endforeach; ?>

    alert(counter);
    var overlays = {
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

    L.control.layers(null, overlays, {position: 'topright', collapsed: false}).addTo(mymap);

</script>