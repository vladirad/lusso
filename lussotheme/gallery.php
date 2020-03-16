<?php
/**
 * Template Name: Gallery page
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

	<div id="primary" class="content-area gallery">		
		<?php
		while ( have_posts() ) :
			the_post(); 

			$instagram = get_field('instagram', 'option');

			?>
			<section id="gallery">
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
						<div class="col-lg-10 title gutter">
							<div class="nav nav-tabs">
							<a class="nav-link active" id="tab-all" data-toggle="tab" href="#content-all" role="tab" aria-controls="content-all" aria-selected="true">
								All
							</a>
							<?php

							$cats = get_terms( array(
							    'taxonomy' => 'category',
							    'hide_empty' => false,
							    'exclude' => array(1)
							) );

							$i = 1;
							
							foreach ($cats as $cat) { ?>
								<a class="nav-link" id="tab-<?php echo $i; ?>" data-toggle="tab" href="#content-<?php echo $i; ?>" role="tab" aria-controls="content-<?php echo $i; ?>"><?php echo $cat->name; ?></a>
							<?php  $i++; } ?>
							</div>

							<div class="tab-content">
								<div class="tab-pane masonrypane fade show active" id="content-all" role="tabpanel">
									<div class="grid">
									<?php
									$gargs = array('post_type' => 'gallery_images', 'posts_per_page' => -1);
									$galimgs = get_posts($gargs); 
									foreach ($galimgs as $gimage) { 
									$image = get_the_post_thumbnail_url($gimage->ID);
									$thumb = get_the_post_thumbnail_url($gimage->ID, 'medium');
									?>
										<a rel="lightbox" href="<?php echo $image; ?>"><img class="col-3 galerija " src="<?php echo $image; ?>"></a>
									<?php }

									?></div>
								</div>
							<?php $j = 1; foreach ($cats as $cat) { ?>
								<div class="tab-pane masonrypane fade" id="content-<?php echo $j; ?>" role="tabpanel">
									<div class="grid">
									<?php
									$cgargs = array('post_type' => 'gallery_images', 'posts_per_page' => -1, 'category__in' => $cat->term_id);
									$cgalimgs = get_posts($cgargs); 
									foreach ($cgalimgs as $cgimage) { 
									$cimage = get_the_post_thumbnail_url($cgimage->ID);
									$cthumb = get_the_post_thumbnail_url($cgimage->ID, 'medium');
									?>
										<a rel="lightbox" href="<?php echo $cimage; ?>"><img class="col-3 galerija " src="<?php echo $cimage; ?>"></a>
									<?php }
									?>
									</div>
								</div>
							<?php  $j++; } ?>
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
