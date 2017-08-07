<?php
/**
 * Template Name: Galerie
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Relache
 */

get_header(); 

$posts = get_posts(array(
			'numberposts' => -1,
			'post_type' => 'gallery',
		)); 
?>
	
<h1><?php wp_title() ?></h1>

<div class="row">

	<article class="col-xs-12">

	    <div class="row">

	    <?php 

	    if($posts) {

			foreach($posts as $post) {
			$fields = get_fields();
			
			$Titre = get_field('Titre');
			$Legende = get_field('Legende');
			$Auteur = get_field('Auteur');
			$Type = get_field('Type');
			$Lien = get_field('image');

		?>

	    	<div class="col-xs-6 col-sm-4 col-md-3<?= $Type; ?> item-galerie">
	    		<figure>
	            	<img src="<?= $Lien ?>" alt=" <?= $Titre; ?> ">
	            
	            	<figcaption>
	                <?= $Legende; ?>
	            	</figcaption>
	            </figure>
	        </div>

	    <?php

	    	} //end foreach

	    } //end if

	    ?>

		</div>

    </article>

</div>

<?php get_footer(); ?>
