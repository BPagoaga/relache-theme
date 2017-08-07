<?php
/**
 * Template Name: Lieux
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Relache
 */

get_header(); ?>

<div class="row">

    <h1 class="col-xs-12"><?php wp_title(); ?></h1>

<?php 

$posts = get_posts(array(
            'numberposts' => -1,
            'post_type' => 'lieux',
        ));

$array_lieux = [];

// for the buttons
foreach ($posts as $post) {
    $lieu = get_fields();
    array_push($array_lieux, $lieu['lieu']);
}

// if no place is selected, we display in full width the buttons and the google map

if(!empty($_GET['lieu'])) {

    foreach ($posts as $post) : ?>

        <?php if($post) {

            $lieu = get_fields();
            $image = get_field('Photo');
            $lat = get_field('Lat');
            $lng = get_field('Lng');

            ?>
            <!-- CAS 1 : UN LIEU A ETE SELECTIONNE-->

            <?php if ($lieu['lieu'] == $_GET['lieu']) : ?>

            <article class="article-description col-xs-12  col-sm-6">

                <h2><?= $lieu['lieu']?></h2>    <!--php : get_lieux lieu-->

                <figure>
                    <img src="<?= $image['url']?>" alt="Image Lieux Bordeaux Relache 2015" title="<?= $image['title']?>"> <!--php : get_lieux img-->
                    <figcaption> <!--php : get_lieux description-->
                        <?= $lieu['Description']?>
                    </figcaption>
                </figure>


               <!--  <h3>Vous pourrez y retrouver à l'occasion de Relache 2016 :</h3>

                <ul>

                    <?php $prog=get_prog_lieu($_GET['lieu']);

                    if ($prog == "Aucun évènement n'est prévu à cet endroit pour le moment") {
                        echo '<p>'.$prog.'</p>';
                    }else {

                        foreach ($prog as $lieu_prog): ?>

                            <li> <a href="?page_id=132&amp;artiste=<?=$lieu_prog['artiste']?>"> <?= ucfirst($lieu_prog['artiste']) ?> </a> le  <a href="programmation.php"> <?=$lieu_prog['jour']?> / <?=$lieu_prog['mois']?> </a> </li>

                        <?php endforeach;

                    } ?>


                </ul> -->

            </article>

            <article class="article-map col-xs-12 col-sm-6">

                <h3>Sélectionnez un lieu pour afficher sa localisation :</h3>

                <div class="row">

                <?php foreach ($array_lieux as $btn_lieu): ?>

                    <div class="links col-xs-5">
                        <a href="?lieu=<?=$btn_lieu?>#map-canvas"><?=$btn_lieu?></a>
                    </div>

                <?php endforeach ?>

                </div>

                <div id="map-canvas"></div>

            </article>

            <div id="coordonnees">

            <?php if($_GET['lieu']) { ?>

                <div id="lat"><?=$lat ;?></div>
                <div id="lng"><?=$lng ;?></div>


                <?php


                }else{      //si pas de lieu sélectionné, on donne par défaut les coordonnées de la mairie de bordeaux

                    ?>

                    <div id="lat">44.838086</div>
                    <div id="lng">-0.579626</div>

                    <?php

                }

            ?>
            </div>

            <?php endif; ?>

        <?php
        } // if $post

    endforeach; // foreach $post 

} // if not empty $get lieux ?>

<?php if( empty($_GET['lieu']) ) : ?>

    <article class="article-map col-xs-12">

        <h3>Sélectionnez un lieu pour afficher sa localisation :</h3>

        <div class="row around-xs">

        <?php foreach ($array_lieux as $btn_lieu): ?>

            <div class="links col-xs-5 col-sm-4 col-md-3">
                <a href="?lieu=<?=$btn_lieu?>#map-canvas"><?=$btn_lieu?></a>
            </div>

        <?php endforeach ?>

        </div>

        <div id="map-canvas"></div>

    </article>

    <div id="coordonnees">

    <?php if($_GET['lieu']) { ?>

        <div id="lat"><?=$lat ;?></div>
        <div id="lng"><?=$lng ;?></div>


        <?php


        }else{      //si pas de lieu sélectionné, on donne par défaut les coordonnées de la mairie de bordeaux

            ?>

            <div id="lat">44.838086</div>
            <div id="lng">-0.579626</div>

            <?php

        }

    ?>
    </div>

    <?php endif; ?>


</div> <!--fin row-->

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1fD1UeEesqm8Gy3GgI2SbV2zNlayZkZY" type="text/javascript"></script>

    <!--<script type="text/javascript" src="http://maps.google.com/maps/api/js?language=fr-FR"></script>-->

    <script type="text/javascript">
        function initialize() {
            map = new google.maps.Map(document.getElementById("map-canvas"), {
                zoom: 15,
                center: new google.maps.LatLng(44.834417, -0.565051),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
        }
    </script>

    <script id="map_parameters">

        function initialize() {

            var data = "<?=$_GET['lieu']?>";

            var lat = $("#lat").html();
            var lng = $("#lng").html();

            var myLatLng = new google.maps.LatLng(lat, lng);

            /*$.ajax({
                type: "GET",
                url: "marker.php",
                data: data,
                success: function(server_response){

                    $("#coordonnees").html(server_response).show();
                    var coordonnees = $("#coordonnees").html();
                    alert(coordonnees);

                    var myLatlng = new google.maps.LatLng(coordonnees);

                }
            });*/



            var mapOptions = {
            zoom: 15,
            center: myLatLng
            };

            var map = new google.maps.Map(document.getElementById('map-canvas'),
              mapOptions);

            var contentString = '<h2>'+data+'</h2>';

            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });

            var marker = new google.maps.Marker({
                map: map,
                animation: google.maps.Animation.DROP,
                position: myLatLng,
                icon: '//relache.fr/wordpress/wp-content/themes/relache/img/icons/flag.png'
            });

            google.maps.event.addListener(marker, 'click', function() { //ouverture de la fenêtre d'info au clic sur un marqueur
                infowindow.open(map,marker);
            });

            var transitLayer = new google.maps.TransitLayer();  //lignes de tram
            transitLayer.setMap(map);

            var trafficLayer = new google.maps.TrafficLayer();  //bouchons sur la route
            trafficLayer.setMap(map);

        }

        function loadScript() {
            var script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp' +
              '&signed_in=true&callback=initialize';
            document.body.appendChild(script);
        }

        window.onload = loadScript();

    </script>

<?php get_footer(); ?>

