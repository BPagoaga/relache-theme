<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Relache
 */

?><!DOCTYPE html>

<html <?php language_attributes(); ?>>

    <head>

    <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
           <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">


    <link rel="profile" href="//gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

    <?php wp_head(); ?>

</head>

<body>

	<div class="row">

	    <div class="col-xs-10 col-xs-offset-1">

	    <!-- Possibility to skip to content for screen-readers -->
	    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'relache' ); ?></a>

	        <header id="header" class="row bottom-sm around-sm between-sm" role="banner">

	            <!--logo-->
	            <?php if ( get_header_image() ) : ?><!--if there is a header image in WP, and the site title is hidden, we want to display the image-->

	            <div class="logorelache col-xs-12 col-sm-5">
	                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
	                    <img src="<?php header_image(); ?>" alt="Logo Relache">
	                </a>
	            </div><!-- .logorelache -->

	            <?php endif; // End header image check. ?>

	            <div class="logoalf col-sm-2">
	                <a href="//allezlesfilles.net" target="_blank">
	                    <img src="//relache.fr/img/logoalf.png" alt="Allez Les Filles Relache Bordeaux 2015">
	                </a>
	            </div>

	             <div class="don col-sm-2">
	                <a href="#"> <!--lien paypal ? -->
	                    <img src="//relache.fr/img/icons/don.png" alt="Don Relache Bordeaux 2015">
	                </a>
	            </div>

	            <!-- social media -->
	            <?php relache_social_menu() ?>

	            <!-- Burger -->
	            <button class="burger" aria-controls="primary-menu" aria-expanded="false">
	                <span> <?php esc_html_e( 'Primary Menu', 'relache' ); ?></span>
	            </button>

	            <section class="col-sm-12">

	                <nav id="site-navigation" class="main-navigation col-sm-12" role="navigation">


	                        <!-- menu WP -->
	                        <?php wp_nav_menu( array(
	                        'theme_location' => 'primary',
	                        'menu_id' => 'primary-menu',
	                        'container_class' => '' )
	                        ); ?>

	                        <!-- search form -->
	                        <!-- <form class="search-container">
	                            <label class="search">
	                                <input type="search" name="inpt_search" placeholder="Rechercher un artiste ou un lieu" id="inpt_search">
	                            </label>
	                            <a href="#search-container" class="screen-reader-text"><?php _e('Search', 'relache') ?></a>
	                        </form> -->



	                </nav><!-- #site-navigation -->

	            </section><!-- .col-sm-12-->

	            <div class="result" id="result"></div>

	        </header>


	        <main id="content" role="main">




