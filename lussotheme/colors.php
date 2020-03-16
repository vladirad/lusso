<?php
/**
 * Template Name: Colors page
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

	<div id="primary" class="content-area colors">		
		<?php
		while ( have_posts() ) :
			the_post(); 
			$category = get_field('category');
			$types = get_field('types');
			$instagram = get_field('instagram', 'option');

			?>
			<section id="colors">
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
							if ($types) {


							$i = 1;
							
							foreach ($types as $type) { ?>
								<a class="nav-link" id="tab-<?php echo $i; ?>" data-toggle="tab" href="#content-<?php echo $i; ?>" role="tab" aria-controls="content-<?php echo $i; ?>"><?php echo $type->name; ?></a>
							<?php  $i++; } }?>
							</div>

							<div class="tab-content">
								<div class="tab-pane fade show active" id="content-all" role="tabpanel">
									<div class="container-fluid">
									<div class="row colorlist">
									<?php 
									$gargs = array('post_type' => 'colors', 'posts_per_page' => -1, 'category__in' => $category, 'orderby' => 'title', 'order' => 'ASC',);
									$galimgs = get_posts($gargs); 
									foreach ($galimgs as $gimage) { 
									$image = get_the_post_thumbnail_url($gimage->ID);
									$thumb = get_field('icon', $gimage->ID);
									?>	
										<div class="col-lg-3 color" data-toggle="modal" data-target="#modal-<?php echo $gimage->ID; ?>">
											<img src="<?php echo $thumb['sizes']['coloricon']; ?>">
											<h3><?php echo $gimage->post_title; ?></h3>
										</div>
										<div class="colormodal modal fade" id="modal-<?php echo $gimage->ID; ?>">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-body">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												          <span aria-hidden="true">&times;</span>
												        </button>
														<img class="icon" src="<?php echo $thumb['sizes']['coloricon']; ?>">
														<h3><?php echo $gimage->post_title; ?></h3>
														<hr>
														<img class="feature" src="<?php echo $image; ?>">
														<div class="desc">
															<?php echo wpautop($gimage->post_content); ?>
														</div>	
													</div>
												</div>
											</div>	
										</div>
									<?php }

									?>
									</div>
									</div>
								</div>

							<?php if ($types) { $j = 1; foreach ($types as $type) { ?>
								<div class="tab-pane fade" id="content-<?php echo $j; ?>" role="tabpanel">
									<div class="container-fluid">
									<div class="row colorlist">
									<?php
									$cgargs = array(
										'post_type' => 'colors',
										'posts_per_page' => -1,
										'orderby' => 'title',
										'order' => 'ASC',
										'tax_query' =>  array(
											'relation' => 'AND',
											array(
												'taxonomy' => 'types',
												'terms'    => $type->term_id,
												'field'    => 'term_id'
											),
											array(
												'taxonomy' => 'category',
												'terms'    => $category,
												'field'    => 'term_id'
											)
										)
									);
									$cgalimgs = get_posts($cgargs); 
									foreach ($cgalimgs as $cgimage) { 
									$cimage = get_the_post_thumbnail_url($cgimage->ID);
									$cthumb = get_field('icon', $cgimage->ID);
									?>
										<div class="col-lg-3 color" data-toggle="modal" data-target="#modal-<?php echo $j. '-' .$cgimage->ID; ?>">
											<img src="<?php echo $cthumb['sizes']['coloricon']; ?>">
											<h3><?php echo $cgimage->post_title; ?></h3>
										</div>
										<div class="modal fade" id="modal-<?php echo $j. '-' .$cgimage->ID; ?>">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-body">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												          <span aria-hidden="true">&times;</span>
												        </button>
														<img class="icon" src="<?php echo $cthumb['sizes']['coloricon']; ?>">
														<h3><?php echo $cgimage->post_title; ?></h3>
														<hr>
														<img class="feature" src="<?php echo $cimage; ?>">
														<div class="desc">
															<?php echo wpautop($cgimage->post_content); ?>
														</div>	
													</div>
												</div>
											</div>		
										</div>
									<?php } ?>
									</div>
									</div>
								</div>
							<?php  $j++; } }?>
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
