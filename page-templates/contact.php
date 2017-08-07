<?php
/**
 * Template Name: Contact
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Relache
 */

get_header(); ?>

<div class="row">

	<div id="primary" class="content-area col-xs-12">
		<main id="main" class="site-main" role="main">

		<!-- Get the contact page content -->

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>


			<?php endwhile; // End of the loop. ?>

			<!-- Get the parners -->

			<!-- Get the contacts -->

		</main><!-- #main -->
	</div><!-- #primary -->

	<!-- <div id="Partenaires" class="col-xs-4">

        <h2>Partenaires Relache</h2>

        <div class="row">

		<?php

		$partenaires_type = ['Institutionnels','Culturels', 'Médias', 'Privés'];

		foreach ($partenaires_type as $type) {

			get_partners($type);
		}

		?>

		</div> --><!-- .row -->

    <!--</div><!-- #Partenaires -->

</div><!-- .row -->
<?php get_footer(); ?>


