<?php
/**
 * Template Name: Artiste
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Relache
 */

get_header();

$post = get_post($_GET['artiste']);

if($post) {

	$artiste = get_fields();

	?>

	<?php if ($artiste) : ?>

	<div class="row">

		<h1 class="col-xs-12"><?php wp_title(); ?></h1>

		<!--Cas 1 : Dancing et Siestes-->

		<?php

		if ($artiste['Type_Art'] === "Siestes Soul" || $artiste['Type_Art'] === "Dancing in the Street") :

			$events=get_events($artiste['artiste']);

		?>

		<article class="article-artiste col-xs-12 col-md-4">

			<h2>Les <?= $artiste['Type_Art']; ?></h2>

			<p><?= $artiste['Desc_Art']; ?></p>

			<h2>Liste des <?= $artiste['Type_Art']; ?> à Relache 2015</h2>

			<ul>

			<?php if ($artiste['Type_Art'] === "Siestes Soul") { // if event Type == Siestes Soul, there is only one fb event, so no need to get the link into the foreach?>

				<?php foreach ($events as $event) : ?>

					<li>
					Le <?= $event['jour']; ?> / <?= $event['mois']; ?> à <a href="lieux.php?lieu=<?= $event['lieu']; ?>"> <?= $event['lieu']; ?></a>

					</li>

				<?php endforeach;

				if ($event['evenement'] !== 0 && !empty($event['evenement'])) { ?>

				<li><a href="<?= $event['evenement'] ?>" class="btn" target="_blank">Retrouvez l'évènement sur facebook !</a></li>

				<br>

				<?php

				}

			}else{ ?>

				<?php foreach ($events as $event) : ?>

				<li>
				Le <?= $event['jour']; ?> / <?= $event['mois']; ?> à <a href="lieux.php?lieu=<?= $event['lieu']; ?>"> <?= $event['lieu']; ?></a>

				</li>

				<?php

				if ($event['evenement'] !== 0 && !empty($event['evenement'])) { ?>

				<li><a href="<?= $event['evenement'] ?>" class="btn" target="_blank">Retrouvez l'évènement sur facebook !</a></li>

				<br>

			<?php } ?>

			<?php endforeach;

			}

			?>



			</ul>

		</article>

		<article class="article-video col-10 col-l-5 col-offset-1 ">

			<div class="zone-img">
				<img src="<?= $event['image']; ?>" alt="<?= $GET_['artiste']; ?> Relache 2015">
			</div>

		</article>



		<!--Cas 2 : Concerts-->

		<?php else : ?>

		<article class="article-artiste col-xs-12 col-sm-6">

			<h2><?= $artiste['artiste']; ?></h2>

			<div class="zone-img">
				<img src="<?= $artiste['image']['url']; ?>" alt="<?= $artiste['artiste']; ?>">
			</div>

			<?php if ($artiste['Desc_Art']) : ?>

			<p><?= $artiste['Desc_Art']; ?></p>

			<br>

			<p>

				<?php

				$social_media_icons = [
					$artiste['Site'] => 'link.png',
					$artiste['Facebook'] => 'facebook.png',
					$artiste['Twitter'] => 'twitter.png',
					$artiste['Instagram'] => 'instagram.png',
					$artiste['Youtube'] => 'youtube.png',
					$artiste['Soundcloud'] => 'soundcloud.png'
				];

				foreach ($social_media_icons as $key => $value) {
					if( !empty($key)) { ?>

					<a href="<?= $key ?>" target="_blank">
						<img src="<?= get_template_directory_uri().'/img/icons/'.$value ?>" alt="website relache 2015 bordeaux">
					</a>

					<?php }
				}

				?>

			</p>

			<br>

			<?php endif ?>

			<?php

			if ($artiste['evenement'] !== 0 && !empty($artiste['evenement'])) { ?>

			<a href="<?= $artiste['evenement'] ?>" class="btn">Retrouvez l'évènement sur facebook !</a>

			<?php } ?>

		</article>

		<article class="article-video col-xs-12 col-sm-5 col-sm-offset-1">

			<?php if (!empty($artiste['Video'])) : ?>

			<?= $artiste['Video']; ?>

			<?php endif ?>

		</article>

		<?php endif ?>

	</div><!-- .row -->


	<?php endif ?>

<?php } ?>

<?php get_footer(); ?>
