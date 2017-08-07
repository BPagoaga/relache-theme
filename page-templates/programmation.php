<?php
/**
 * Template Name: Programmation
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Relache
 */
include $_SERVER['DOCUMENT_ROOT'].'/wordpress/wp-content/themes/relache/DateService.class.php';

$today = DateService::getToday();
$currentYear = DateService::getYear();
$firstYear = DateService::START_YEAR;

$years = [];

for ($i = $firstYear; $i <= $currentYear ; $i++) { 
	$years[] = $i;
}


get_header();

?>

	<div class="row">

		<h1 class="col-xs-12"><?php wp_title(); ?></h1>

		<?php
		$posts = get_posts(array(
			'numberposts' => -1,
			'post_type' => 'lieux'
		));

		if($posts) : ?>

		<aside class="aside-filtre col-xs-12 col-sm-3">

			<div class="row">

				<!-- <section class="filtre-mois col-xs-12">

					<h3>Choix par mois</h3>

					<ul>
						<li class="selecta"><a href="#juin">Juin</a></li>
						<li><a href="#juillet">Juillet</a></li>
						<li><a href="#aout">Août</a></li>
						<li><a href="#septembre">Septembre</a></li>
					</ul>

				</section> -->

				<section class="filtre-lieux col-xs-12">

					<h3>Choix par lieux</h3>

					<div class="button-group filter-places-button-group">

						<div class="radio">
							<input type="radio" id="tous" name="lieux" data-filter="*" checked>
							<label for="tous"></label>
							<a href="lieux.php?lieu=Mairie de Bordeaux">Tous</a>
						</div>

						<?php foreach ($posts as $post): ?>

						<?php $lieu = get_field('lieu'); ?>


						<div class="radio">
							<input type="radio" id="<?=recup_dernier_mot($lieu);?>" name="lieux" data-filter=".<?=recup_dernier_mot($lieu);?>">
							<label for="<?=recup_dernier_mot($lieu);?>"></label>
		    	            <a href="?page_id=130&amp;lieu=<?= $lieu ?>"> <?=$lieu ?></a>
		            	</div>

		    	        <?php endforeach; ?>

					</div>

				</section>

				<section class="col-xs-12 filtre-years">
					<h3>Voir les programmations de l'année :</h3>

					<div class="button-group filter-years-button-group">
						<?php foreach ($years as $key => $year) : ?>
						<!-- <div class="radio">
							<input name="years" type="radio" <?= ($year == $currentYear) ? 'checked' : '' ?> data-filter=".<?= 'year-'.$year;?>">
							<label for="<?='year-'.$year;?>"></label>
							<a href="#" ><?=$year;?></a>
						</div> -->

						<div class="radio">
							<input id="<?='year-'.$year;?>" name="years" type="radio" <?= ($year == $currentYear) ? 'checked' : '' ?> data-filter=".<?= 'year-'.$year;?>">
							<label for="<?='year-'.$year;?>"></label>
							<a href="#"><?=$year;?></a>
						</div>

						<?php endforeach; ?>
					</div>
				</section>

			</div><!-- .row-->

		</aside>

		<?php endif ?>

		<article class="article-programmation col-xs-12 col-sm-9">

		<?php

		$posts = get_posts(array(
			'numberposts' => -1,
			'post_type' => 'programmation',
			'meta_key' => 'date', // name of custom field
			'orderby' => 'meta_value',
			'order' => 'ASC'
		));

		if($posts) {

			foreach($posts as $post) {

				setup_postdata( $post );

				$fields = get_fields();

				$field = get_field('artiste');

				$artistes = get_field('artiste');

				$lieux = get_field('lieu');

				if( $fields ) : ?>

					<div class="row">

						<!-- position relative for isotope -->

						<div class="por col-xs-12">

							<!--BLOC MOIS JOUR EVT LIEU-->

							<?php if( $lieux ): ?>

								<?php foreach( $lieux as $lieu ): ?>

								<?php

								$date_prog  = new DateTime($fields['date']);
								$year_prog = $date_prog->format('Y');
								$date_class = 'year-'.$year_prog;

								?>

							<div class="evenement <?= recup_dernier_mot( get_the_title( $lieu->ID ) ).' '.$date_class ; ?>">

							<?php if($today>$date_prog) echo '<div class="past--event"></div>'; ?>

								<div class="<?= recup_dernier_mot($fields['type']) ?>">

									<label>
										<?= $date_prog->format('d / m');?>
										<br>
										<time><?=$fields['heure']?></time> <br>
									</label>

									<a href="?page_id=130&amp;lieu=<?= get_the_title( $lieu->ID ) ?>">
										<h2>&mdash;<br><?= get_the_title( $lieu->ID ) ?><br>&mdash;</h2>
									</a>

									<!--lien vers les siestes souls et dancing, pas de lien pour les concerts-->
									<?php if ($fields['type'] == "Concert") : ?>

									<h4><?= $fields['type'] ?></h4>

									<?php else : ?>

										<?php foreach ($artistes as $artiste) : ?>

									<a href="?page_id=132&amp;artiste=<?= $artiste->ID ?>"><h4><?= $fields['type'] ?></h4></a>

										<?php endforeach ?>

									<?php endif ?>

									<!-- lien vers l'évènement, n'apparait que si la date n'est pas encore passée et que le lien a été rempli sur wordpress -->

									<?php



									if ( !empty($fields['lien_facebook']) && $date_prog < $today ) : ?>

									<a href="<?= $fields['lien_facebook'] ?>" class="btn" style="font-size: 1rem" target="_blank">Événement >> <img src="<?= get_template_directory_uri().'/img/icons/facebook.png' ?>" alt="facebook relache 2015 bordeaux" width="20px" style="display: inline-block; vertical-align: bottom"></i></a>

									<br>

									<?php endif ?>

								</div><!-- .concert/dancing/sieste-->

							</div><!-- .evenement-->

								<?php endforeach; ?><!-- foreach lieu-->

							<?php endif; ?><!-- if lieu-->

							<!-- Cette div n'apparait que pour les concerts -->

							<?php if( $artistes && $fields['type'] == 'Concert' ): ?>

								<?php foreach( $artistes as $artiste ): ?>

								<div class="evenement <?=$fields['date']?> <?= recup_dernier_mot( get_the_title( $lieu->ID ) ).' '.$date_class ; ?>">

									<a href="?page_id=132&amp;artiste=<?= $artiste->ID; ?>">

										<div class="zone-img calque">

											<?= wp_get_attachment_image( $artiste->image ); ?>

										</div>

										<label for="">
											<?= get_the_title( $artiste->ID ) ?>
										</label>

										<p>
											<?= $artiste->Type_Art ?> - <?= $artiste->Pays_Art ?>
										</p>

									</a>

								</div><!-- .evenement .lieu-->


								<?php endforeach; ?><!-- foreach artiste-->

							<?php endif; ?><!-- if artiste-->


						</div><!-- .por-->

					</div><!-- .row-->


				<?php endif ?>

			<?php } // endforeach

			wp_reset_postdata();

		}

		?>

		</article>

	</div><!-- .row-->


<?php //get_sidebar(); ?>
<?php get_footer(); ?>
