<?php
/**
 * Template Name: Downloads page
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

	<div id="primary" class="content-area downloads">		
		<?php
		while ( have_posts() ) :
			the_post(); 
			$cats = get_field('categories');
			$instagram = get_field('instagram', 'option');

			?>
			<section id="downloads">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-1 empty"></div>
						<div class="col-lg-10 title">
							<h3><?php the_field('overtitle'); ?></h3>
							<h1><?php the_title(); ?></h1>
							<hr>
						</div>
						<div class="col-lg-1 empty"></div>

					</div>
					<div class="row">
						<div class="col-lg-1 empty"></div>
						<div class="col-lg-10">
							<div class="nav nav-tabs">
							<a class="nav-link active" id="tab-all" data-toggle="tab" href="#content-all" role="tab" aria-controls="content-all" aria-selected="true">
								All
							</a>
							<?php

							$i = 1;
							
							foreach ($cats as $cat) { ?>
								<a class="nav-link" id="tab-<?php echo $i; ?>" data-toggle="tab" href="#content-<?php echo $i; ?>" role="tab" aria-controls="content-<?php echo $i; ?>"><?php echo $cat->name; ?></a>
							<?php  $i++; } ?>
							</div>

							<div class="tab-content">
								<div class="tab-pane fade show active" id="content-all" role="tabpanel">
									<div class="container-fluid">
									<div class="row downloadlist">
									<?php 
									$dargs = array('post_type' => 'downloads', 'posts_per_page' => -1);
									$downs = get_posts($dargs); 
									foreach ($downs as $down) { 
									$image = get_the_post_thumbnail_url($down->ID);
									$file = get_field('file', $down->ID);
									$cat = get_the_category($down->ID);
									?>	
									<div class="col-lg-3 download">
										<a class="inner" href="<?php echo $file; ?>" target="_blank">	
											<img src="<?php echo $image; ?>">
											<div class="cnt">
											<span class="category"><?php echo $cat[0]->name; ?></span>
											<h3><?php echo $down->post_title; ?></h3>
											</div>
										</a>
									</div>

									<?php } ?>
									</div>
									</div>
								</div>
								<?php $j=1; foreach ($cats as $cat) { ?>
								<div class="tab-pane fade" id="content-<?php echo $j; ?>" role="tabpanel">
									<div class="container-fluid">
									<div class="row downloadlist">
									<?php 
									$dargs = array('post_type' => 'downloads', 'posts_per_page' => -1, 'category__in' => $cat);
									$downs = get_posts($dargs); 
									foreach ($downs as $down) { 
									$image = get_the_post_thumbnail_url($down->ID);
									$file = get_field('file', $down->ID);
										
									?>	
									<div class="col-lg-3 download">
										<a class="inner" href="<?php echo $file; ?>" target="_blank">	
											<img src="<?php echo $image; ?>">
											<div class="cnt">
											<h3><?php echo $down->post_title; ?></h3>
											</div>
										</a>
									</div>

									<?php }

									?>
									</div>
									</div>
								</div>
								<?php $j++; } ?>
							</div>
						</div>
						<div class="col-lg-1 empty"></div>

					</div>
				</div>
			</section>		

			<section id="instagram">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-1 empty"></div>
						<div class="col-lg-10">
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
