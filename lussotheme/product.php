<?php
/**
 * Template Name: Product page
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

	<div id="primary" class="content-area product">		
		<?php
		while ( have_posts() ) :
			the_post(); 

			$category = get_field('category');
			$hero = get_field('hero');
			$about = get_field('about');
			$advantages = get_field('advantages');
			$colorsf = get_field('colors');
			$hastypes = $colorsf['has_types'];
			if ($hastypes === true) {
				$types = $colorsf['types'];
			}
			$gallery = get_field('gallery');
			$downloads = get_field('downloads');
			$hasviewall = get_field('hasviewall');
			$warranty = get_field('warranty');
			$haswarranty = $warranty['haswarranty'];
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
							<div class="productlogo">
								<img src="<?php echo $hero['logo']; ?>">
							</div>
							<div class="overlay">
								<img src="<?php echo $hero['overlay']; ?>">
							</div>
						</div>
					</div>
				</div>
			</section>

			<section id="product">
				<div class="container-fluid">
					<div class="row row-eq-height">
						<div class="col-lg-1 empty"></div>
						
						<div class="col-lg-5 image" style="background-image: url(<?php echo $about['image']; ?>);">
							<img class="d-none d-lg-inline" src="">
						</div>

						<div class="col-lg-5 desc">
							<h3><?php echo $about['overtitle']; ?></h3>
							<h2><?php echo $about['title']; ?></h2>
							<hr>
							<div class="pro"><?php echo $about['description']; ?></div>
						</div>

						<div class="col-lg-1 empty"></div>
					</div>
				</div>
			</section>
			
			<section id="advantages">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-1 empty"></div>

						<div class="col-lg-5 desc">
							<h2><?php echo $advantages['title']; ?></h2>
							<hr>
							<?php echo $advantages['content']; ?>
						</div>
						
						<div class="col-lg-5 tabs">
							<div class="accordion row" id="accor">
							<?php $i = 1; foreach ($advantages['tabs'] as $tab) { ?>
								<div class="col-lg-6">
								<a class="tabbutton" data-toggle="collapse" href="#collapse-<?php echo $i; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $i; ?>">
								   	<?php echo $tab['title']; ?>
								</a>
								<div id="collapse-<?php echo $i; ?>" class="collapse" data-parent="#accor">
									<?php echo $tab['description']; ?>
								</div>
								</div>
							<?php  $i++; } ?>
							</div>
						</div>

						<div class="col-lg-1 empty"></div>
					</div>
				</div>
			</section>

			<section id="colors">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12 title text-center">
							<h2><?php echo $colorsf['title']; ?></h2>
							<hr class="col0">
						</div>
						<?php if ($hastypes === true) { ?>
							<div class="col-12 types">
								<ul class="nav nav-tabs" role="tablist">
									<?php $j = 1; foreach ($types as $type) { ?>
									<li role="presentation" <?php if($j == 1) { echo 'class="active"'; } ?>>
										<a class="nav-link" href="#content-<?php echo $j; ?>" aria-controls="content-<?php echo $j; ?>" role="tab" data-toggle="tab"><?php echo $type->name; ?></a>
									</li>
								<?php  $j++; } ?>
								</ul>
								
								<div class="tab-content">
								<?php $k = 1; foreach ($types as $type) { 
									$args = array(
										'post_type' => 'colors',
										'posts_per_page' => -1,
										'tax_query' =>  array(
											'relation' => 'AND',
											array(
												'taxonomy' => 'types',
												'terms'    => $type,
												'field'    => 'term_id'
											),
											array(
												'taxonomy' => 'category',
												'terms'    => $category,
												'field'    => 'term_id'
											)
										)
									);

									$colors = get_posts($args);
								?>
								<div role="tabpanel" class="tab-pane <?php if($k == 1) { echo 'active'; } ?>" id="content-<?php echo $k; ?>">
									<div class="desci container">
										<?php echo $type->description; ?>
									</div>

									<div class="colors natural sliderx">
										<?php foreach ($colors as $color) { ?> 
										<div class="colorx">
											<div class="desc row">
												<div class="icon col-12 col-lg-12 col-xl-4">
													<?php $coloricon = get_field('icon', $color->ID); ?>
													<img src="<?php echo $coloricon['sizes']['coloricon']; ?>">
													
												</div>
												<div class="text col-12 col-lg-12 col-xl-8">
													<h2><?php echo $color->post_title; ?></h2>
													<?php echo wpautop($color->post_content); ?>
												</div>
											</div>
											<div class="image">
												<img src="<?php echo get_the_post_thumbnail_url($color->ID); ?>">
											</div>
										</div>
										<?php } ?>

									</div>
								</div>
								<?php $k++; }  ?>	
								</div>	
							</div>
						<?php } else { 
							$args = array(
									'post_type' => 'colors',
									'posts_per_page' => -1,
									'category__in' => $category		
								);
							$colors = get_posts($args);
							?>
							<div class="col-12">
							<div class="colorsx sliderx">
								<?php foreach ($colors as $color) { ?> 
									<div class="colorx">
										
										<div class="desc row">
											
											<div class="icon col-12 col-lg-12 col-xl-4">
												<?php $coloricon = get_field('icon', $color->ID); ?>
												<img src="<?php echo $coloricon['sizes']['coloricon']; ?>">
											</div>
											<div class="text col-12 col-lg-12 col-xl-8">
												<h2><?php echo $color->post_title; ?></h2>
												<?php echo wpautop($color->post_content); ?>
											</div>
										
									</div>
										<div class="image  child-element">
											<img src="<?php echo get_the_post_thumbnail_url($color->ID); ?>">
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
						<?php } ?>
					</div>
				
					<div class="row">
						<div class="col-12 text-center dugme">
							<a href="<?php echo $colorsf['viewall']; ?>" class="viewall">View all</a>
						</div>
					</div>		
				</div>
			</section>

			<section id="gallery">
				<div class="container-fluid">
					<div class="row title">
						<div class="col-lg-1 empty"></div>

						<div class="col-10">
							<h3><?php echo $gallery['overtitle']; ?></h3>
							<h2><?php echo $gallery['title']; ?></h2>
							<hr>
						</div>
						
						<div class="col-lg-1 empty"></div>
					</div>

					<div class="row images">
						<div class="col-lg-1 empty"></div>

						<div class="col-12 col-lg-10 imgs gutter">
							<div class="grid">
							<?php 
								$gargs = array('post_type' => 'gallery_images', 'posts_per_page' => 16, 'category__in' => $category);
								$galimgs = get_posts($gargs); 
								foreach ($galimgs as $gimage) { 
									$image = get_the_post_thumbnail_url($gimage->ID);
									$thumb = get_the_post_thumbnail_url($gimage->ID, 'medium');
								?>
									<a rel="lightbox" href="<?php echo $image; ?>"><img class="col-4 col-lg-3 galerija" src="<?php echo $image; ?>"></a>
							<?php }

 							?>
						</div>
						</div>
						<div class="col-lg-1 empty"></div>
					</div>

					</div>
				</div>
			</section>

			<section id="downloads">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-1 empty"></div>
						
						<div class="col-12 col-lg-10">
							<div class="row dow">
								<?php foreach ($downloads as $download) { ?>
									<div class="col-lg-6 download gutter">
										<img class="boxbg" src="<?php echo get_the_post_thumbnail_url($download->ID); ?>">
										<div class="overlay"></div>
										<div class="fulllink">
										<h3><?php the_field('overtitle', $download->ID); ?></h3>
										<h2><?php echo $download->post_title; ?></h2>
										<hr>
										<?php $file = get_field('file', $download->ID);?>
										<a class="dload" href="<?php echo $file; ?>">Download</a>
									</div>
    								</div>
								<?php } ?>			
							</div>
							<?php if ($hasviewall) { ?>
							<div class="row all">
								<div class="col-12">
									<a class="viewalldown" href="/downloads">View All Downloads</a>
								</div>
							</div>			
							<?php } ?>
						</div>
						
						<div class="col-lg-1 empty"></div>
					</div>
				</div>
			</section>
			
			<?php if ($haswarranty) { ?>
			<section id="warranty">
				<div class="container-fluid">
					<div class="row row-eq-height">
						<div class="col-lg-1 empty"></div>
						
						<div class="col-lg-7 desc">
							<h2><?php echo $warranty['title']; ?></h2>
							<p><?php echo $warranty['text']; ?></p>
						</div>
						<div class="col-lg-3 wbtn align-self-center text-right">
							<button data-toggle="modal" data-target="#warrantymodal">Register Now</button>
						</div>
						<div class="col-lg-1 empty"></div>
					</div>
				</div>
				<div class="modal fade" id="warrantymodal">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-body">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
								</button>
								<?php echo do_shortcode($warranty['form_code']); ?>
							</div>
						</div>
					</div>		
				</div>
			</section>
			<?php } ?>

		<?php endwhile; // End of the loop.
		?>
		</div>	
	</div><!-- #primary -->

<?php

get_footer();
