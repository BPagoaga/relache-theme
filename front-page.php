<?php
/**
 * Template Name: Accueil
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Relache
 */
get_header(); ?>

    <h1 class="h1"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1> -
    <h2 class="h1"><a href="//allezlesfilles.net" target="_blank"><?php bloginfo( 'description' ); ?></a></h2>

    <article class="article-slider">

        <?php if ( function_exists( 'meteor_slideshow' ) ) { meteor_slideshow(); } ?>

    </article>

    <article class="article-newsletter">

        <form action="newsletter.php" method="post" class="row center-xs start-sm">

                <label class="col-xs-12 col-sm-6">>> Abonnez-vous à la Newsletter</label>

                <div class="email col-xs-12 col-sm-6">

                    <input class="" type="email" name="email" id="email" placeholder="&nbsp;&nbsp;Adresse e-mail">

                    <input class="" type="submit" value="GO">

                </div>

        </form>

    </article>

    <div class="row">

        <div class="col-xs-12 col-sm-5">

            <article class="programmation">

                <?php
                $mois = date('F');
                $mois_relache = array('June', 'July', 'August', 'September');
                $today = new Datetime();
                $todayformat = $today->format('Y-m-d');


                $posts = get_posts(array(
                    'numberposts' => 3,
                    'post_type' => 'programmation',
                    'meta_query'=> array(
                        array(
                          'key' => 'date',
                          'compare' => '>',
                          'value' => $todayformat,
                          //'type' => 'DATE',
                        )),
                    'meta_key' => 'date', // name of custom field
                    'orderby' => 'meta_value',
                    'order' => 'ASC'
                ));

                ?>
                
                <a href="programmation">
                    <h2>Prochainement à <?php bloginfo( 'name' ); ?></h2>
                </a>

                <div class="row">

                <!-- ajouter une boucle foreach une fois que les custom field auront été définis-->

                <!--BLOC MOIS JOUR EVT LIEU-->

                <?php foreach($posts as $post) {

                    $fields = get_fields();

                    $artistes = get_field('artiste');

                    $lieux = get_field('lieu');

                    if( $lieux ): ?>

                        <?php foreach( $lieux as $lieu ): 
                    	$date_prog  = new DateTime($fields['date']);
                    	$interval = $today->diff($date_prog);

                    	?>



                        <div class="zone-img col-xs-4 col-sm-4">

                            <div class="evenement <?= recup_dernier_mot( get_the_title( $lieu->ID ) ); ?>">

                                <div class="<?= recup_dernier_mot($fields['type']); ?>">

                                    <label>

                                        <?php
                                      
                                        echo $date_prog->format('d / m');

                                        ?>

                                        <br>
                                        <time><?=$fields['heure']?></time> <br>
                                    </label>

                                    <a href="?page_id=130&amp;lieu=<?= get_the_title( $lieu->ID ) ?>">
                                        <h2>&mdash;<br><?= get_the_title( $lieu->ID ) ?><br>&mdash;</h2>
                                    </a>

                                    <!--lien vers les siestes souls et dancing, pas de lien pour les concerts-->
                                    <?php if ($fields['type'] == "Concert") : ?>

                                    <h4><a href="programmation"> <?= $fields['type'] ?></a></h4>

                                    <?php else : ?>

                                        <?php foreach ($artistes as $artiste) : ?>

                                    <a href="?page_id=132&amp;artiste=<?= $artiste->ID ?>"><h4><?= $fields['type'] ?></h4></a>

                                        <?php endforeach ?>

                                    <?php endif ?>

                                    <!-- lien vers l'évènement, n'apparait que si la date n'est pas encore passée et que le lien a été rempli sur wordpress -->

                                    <?php

                                    //$today = new DateTime();


                                    if ( !empty($fields['lien_facebook']) && $interval->days>0 ) : ?>
                                    	<?= $interval->day; ?>

                                    <a href="<?= $fields['lien_facebook'] ?>" class="btn" style="font-size: .7rem" target="_blank">Événement >> <img src="<?= get_template_directory_uri().'/img/icons/facebook.png' ?>" alt="facebook relache 2016 bordeaux" width="20px" style="display: inline-block; vertical-align: bottom"></i></a>

                                    <br>

                                    <?php endif ?>

                                </div><!-- .concert/dancing/sieste-->

                            </div><!-- .evenement-->

                        </div><!-- .zone-img-->

                        <?php endforeach; ?><!-- foreach lieu-->

                    <?php endif; // if lieu

                } ?><!-- end foreach-->

                </div><!-- .row-->

            </article><!-- .programmation-->

        </div><!-- .col-xs-12 col-sm-5 -->

        <div class="col-xs-12 col-sm-offset-1 col-sm-6">

            <article class="article-relache">

                <h2><a href="contact.php"> Qu'est-ce que Relache&nbsp;?</a></h2>

                    <p>
                    À Paris, il y a Paris-Plage. À Bordeaux, nous c’est RELACHE ! Un vrai
        festival urbain et en kit, à assembler soi-même de Juin à Septembre. Pas de problème de douche ou bien même de t-shirt de 3 jours : l’ambiance festival est calée en plein centre-ville le temps d’un soir et vous êtes chez vous dans l’heure. 15 dates de
        concerts, près de 10 Dancing in the street et de douces après midi avec les Siestes Soul sur les Quais et au Jardin Public.
                    </p><br>

                    <p class="article-relache-hidden">
                    La programmation, historiquement dédiée aux musiques rock, avec des groupes tels que Jim Jones Revue, Ty Segall, Thee Oh Sees et Lisa & The Lips, s'est aujourd'hui métissée et accueille les artistes de la scène montante ainsi que des piliers de black music comme Sugar Ray, Naomie Shelton ou encore The Excitements.<br><br>
                    Retrouvez chaque soir les meilleurs Food trucks du coin, des stands DIY et des disquaires.
                    <br><br>
                    <strong>Relache, c’est un événement atypique, festif et décomplexé pour un été surexcité à Bordeaux&nbsp;!</strong></p>

                    <a id="article-relache-expand" class="btn">>> Lire plus +</a>

            </article><!-- .article-relache -->

         </div><!-- .col-xs-12 col-sm-offset-1 col-sm-6 -->

        <div class="col-xs-12 col-sm-5">

            <aside>

                <h2>Suivez-nous !</h2>

                <section class="playlist">

                    <h3>
                        <a href="https://soundcloud.com/relache-1" target="_blank">
                            <img src="<?= get_template_directory_uri().'/img/icons/vinyl.svg' ?>" alt="" width="30px" style="vertical-align: middle">&nbsp;&nbsp;La playlist relache
                        </a>
                    </h3>

                    <iframe width="100%" height="300" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/playlists/129199530&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>
                </section>

                <section class="instagramlive">

                    <h3>
                        <a href="https://instagram.com/relachefestival/" target="_blank">
                            <img src="<?= get_template_directory_uri().'/img/icons/yeu.svg' ?>" alt="" width="30px" style="vertical-align: middle">&nbsp;&nbsp;Instagram #relache<?= $today->format('Y'); ?>
                        </a>
                    </h3>

                    <blockquote class="instagram-media" data-instgrm-captioned data-instgrm-version="7" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:658px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:8px;"> <div style=" background:#F8F8F8; line-height:0; margin-top:40px; padding:33.3333333333% 0; text-align:center; width:100%;"> <div style=" background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACwAAAAsCAMAAAApWqozAAAABGdBTUEAALGPC/xhBQAAAAFzUkdCAK7OHOkAAAAMUExURczMzPf399fX1+bm5mzY9AMAAADiSURBVDjLvZXbEsMgCES5/P8/t9FuRVCRmU73JWlzosgSIIZURCjo/ad+EQJJB4Hv8BFt+IDpQoCx1wjOSBFhh2XssxEIYn3ulI/6MNReE07UIWJEv8UEOWDS88LY97kqyTliJKKtuYBbruAyVh5wOHiXmpi5we58Ek028czwyuQdLKPG1Bkb4NnM+VeAnfHqn1k4+GPT6uGQcvu2h2OVuIf/gWUFyy8OWEpdyZSa3aVCqpVoVvzZZ2VTnn2wU8qzVjDDetO90GSy9mVLqtgYSy231MxrY6I2gGqjrTY0L8fxCxfCBbhWrsYYAAAAAElFTkSuQmCC); display:block; height:44px; margin:0 auto -44px; position:relative; top:-22px; width:44px;"></div></div> <p style=" margin:8px 0 0 0; padding:0 4px;"> <a href="https://www.instagram.com/p/BF9w_R4MYNd/" style=" color:#000; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none; word-wrap:break-word;" target="_blank">Henri Herbert sur scene yeeeaahh (C) @aboutlightandmen #relache #relachefestival2016 #allezlesfilles #festival #bordeaux #bordeauxmaville #igersgironde #igg_nosconcerts #blues #rock #psyche #live #show #liveshow #concerts #instalive #instamusic #music #aboutlightandmen #picsbykami #henriherbert</a></p> <p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;">Une photo publiée par relachefestival (@relachefestival) le <time style=" font-family:Arial,sans-serif; font-size:14px; line-height:17px;" datetime="2016-05-28T20:54:58+00:00">28 Mai 2016 à 13h54 PDT</time></p></div></blockquote>
                    <script async defer src="//platform.instagram.com/en_US/embeds.js"></script>

                    <div id="instafeed"></div>

                </section>

            </aside>

        </div><!-- .col-xs-12 col-sm-4 -->

        <div class="col-xs-12 col-sm-offset-1 col-sm-6">

            <article class="article-actualite">

                <h2>Carnet de voyage</h2>

                <?php

                //The Query

                $the_query = new WP_Query();
                $the_query -> query('showposts=2');

                if ( have_posts() ) : while ( $the_query -> have_posts() ) : $the_query -> the_post(); ?>

                <section class="article-blog">

                    <div class="thumbnail">

                        <?php the_post_thumbnail(); ?>

                    </div><!-- end .thumbnail-->

                    <h1><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>

                    <div class="head-info">

                        Écrit&nbsp;par&nbsp;<em><?php the_author_posts_link(); ?></em>,&nbsp;le
                        <time datetime="<?php the_time('c'); ?>">
                            <em><?php the_date(); ?></em>
                        </time>.

                    </div>
                    <br>
                    <?php the_excerpt(); ?>
                    <a href="<?php the_permalink(); ?>" class="btn" title="<?php the_title ?>">+ En savoir plus</a>

                </section>

                <?php endwhile; ?>

                <?php else: ?>
                <!-- no posts found -->
                    <p> Aucun article n'a été posté ! </p>
                <?php endif;?>

            </article><!-- article-actualite -->

        </div><!-- .col-xs-12 -->

        <div class="col-xs-12">

            <article class="article-galerie">

                <h2>Ambiance Relache</h2>

                <section class="galerie row">

                    <div class="col-xs-12 col-sm-6 col-md-4 zone-img">

                            <a href="galerie">
                                <img src="<?= get_template_directory_uri().'/img/galerie/concert/concert.jpg' ?>" alt="galerie relache 2016 bordeaux">

                                <p class="concert">Concerts <br>
                                Relache 2016</p>

                                <div class="hover-img concert"></div>
                            </a>

                    </div><!-- .col-xs-12 col-sm-6 col-md-4-->

                    <div class="col-xs-12 col-sm-6 col-md-4 zone-img">

                            <a href="galerie">
                                <img src="<?= get_template_directory_uri().'/img/galerie/dancing/dancing.jpg '?>" alt="galerie relache 2016 bordeaux">

                                <p class="dancing">Dancing in the street <br>
                                Relache 2016</p>

                                <div class="hover-img dancing"></div>
                            </a>

                    </div><!-- .col-xs-12 col-sm-6 col-md-4-->

                    <div class="col-xs-12 col-sm-6 col-md-4 zone-img">

                            <a href="galerie">
                                <img src="<?= get_template_directory_uri().'/img/galerie/soul/soul.jpg' ?>" alt="galerie relache 2016 bordeaux">

                                <p class="sieste">Siestes Soul <br>
                                Relache 2016</p>

                                <div class="hover-img sieste"></div>
                            </a>

                    </div><!-- .col-xs-12 col-sm-6 col-md-4-->

                </section>

            </article>

        </div><!-- .col-xs-12 -->

    </div><!--.row-->

<?php get_footer(); ?>
