<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lusso_Theme
 */

get_header();
$instagram = get_field('instagram','option'); 
?>

	<div id="primary" class="content-area blog">
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-1 empty"></div>
				<div class="col-lg-10">
					<h3>WELCOME TO LUSSO GROUP</h3>
					<h2>BLOG</h2>
					<hr>
					<div class="posts row">
					<?php if ( have_posts() ) : /* Start the Loop */
						while ( have_posts() ) :
							the_post(); ?>
							<div class="article col-lg-6">
								<img class="feat-image" src="<?php echo get_the_post_thumbnail_url($post, 'blog-listing'); ?>">
								<a href="<?php echo get_the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
								<span class="date"><?php the_date(); ?></span>
								<p><?php echo wp_trim_words(get_the_content(),20); ?></p>
								<a href="<?php echo get_the_permalink(); ?>" class="readmore"><button>Read More</button></a>
							</div>
					<?php	endwhile;

						the_posts_navigation();

					endif;
					?>
						
					</div>
				</div>
				<div class="col-lg-1 empty"></div>	
			</div>
		</div>

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

	</div><!-- #primary -->

<?php
get_footer();
