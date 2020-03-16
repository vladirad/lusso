<?php
/**
 * Template Name: About Us
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lusso_Theme
 */

get_header();
?>

	<div id="primary" class="content-area default">		
		<?php
		while ( have_posts() ) :
			the_post(); 

			$hero = get_field('hero');
			$about = get_field('about');
			$instagram = get_field('instagram', 'option');

			?>
			<section id="hero">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-1 title">
							<div class="vertical">
							<h3><?php echo $hero['overtitle']; ?></h3>
							<h1><?php echo $hero['title']; ?></h1>
						</div>
						</div>
						<div class="col-lg-11 main-image gutter">
							<img src="<?php echo $hero['image']; ?>">
							<div class="overlay">
								<img src="<?php echo $hero['overlay']; ?>">
							</div>
						</div>
					</div>
				</div>
			</section>		
			
			<section id="about">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-1 empty"></div>
						<div class="col-lg-6 desc">
							<h3><?php echo $about['overtitle']; ?></h3>
							<h2><?php echo $about['title']; ?></h2>
							<hr>
							<p><?php echo $about['description']; ?></p>
						</div>
						<div class="col-lg-5 image d-none d-lg-flex">
							<img src="<?php echo $about['image']; ?>">
						</div>
					</div>
				</div>
			</section>

			<section id="instagram">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-1 empty"></div>
						<div class="col-lg-10 gutter">
							<h3><?php echo $instagram['overtitle']; ?></h3>
							<h2><?php echo $instagram['title']; ?></h2>
							<hr>
							<?php echo do_shortcode('[instagram-feed]'); ?>
						</div>
						<div class="col-lg-1 empty"></div>	
						</div>
					</div>
				</div>
			</section>	

		<?php endwhile; // End of the loop.
		?>
		</div>	
	</div><!-- #primary -->

<?php

get_footer();
