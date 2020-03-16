<?php
/**
 * Template Name: Homepage
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
			//Fields
			$hero = get_field('hero');
			$about = get_field('about');
			$aboutbtns = $about['buttons'];
			$products = get_field('products');
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
						<div class="col-lg-11 hero-image gutter">
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
							<h3 class="visit"><?php echo $about['subtitle']; ?></h3>
							<div class="buttons">
							<?php foreach ($aboutbtns as $btn) { ?>
								<a target="_blank" href="<?php echo $btn['url']; ?>" class="<?php echo $btn['type']; ?>"><button><?php echo $btn['label']; ?></button></a>
							<?php } ?>
							</div>
						</div>
						<div class="col-lg-5 image d-none d-lg-flex">
							<img src="<?php echo $about['image']; ?>">
						</div>
					</div>
				</div>
			</section>

			<section id="productboxes">
				<div class="container-fluid">
					<div class="row">
						<?php foreach ($products as $product): ?>
							<div class="col-lg-4 productbox gutter">	
							<img class="boxbg" src="<?php echo $product['image']; ?>">					
								<a class="fulllink" href="<?php echo $product['url']; ?>">
									<div class="overlay"></div>
									<div class="productlogo">
										<img src="<?php echo $product['logo']; ?>">
									</div>
								</a>
							</div>
						<?php endforeach ?>
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
