<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Lusso_Theme
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="container-fluid">
			<div class="row footerboxes" id="contact">
				<div class="col-lg-1 empty"></div>	
				<div class="col-lg-5 info">
					<div class="logo">
						<img src="<?php the_field('logo','option'); ?>" alt="Lusso Group">
					</div>
					<div class="desc">
						<p><?php the_field('description','option'); ?></p>
					</div>
					<div class="continfos">
						<div class="item address">
							<a href="<?php the_field('address_map','option'); ?>" target="_blank">
							<div class="icon"><i class="fas fa-map-marker-alt"></i></div>
							<div class="text"><?php the_field('address','option'); ?></div>
							</a>
						</div>
						<div class="item address">
							<a href="<?php the_field('address_2_map','option'); ?>" target="_blank">
							<div class="icon"><i class="fas fa-map-marker-alt"></i></div>
							<div class="text"><?php the_field('address_2','option'); ?></div>
							</a>
						</div>
						<div class="item phone">
							<div class="icon"><i class="fas fa-phone-alt"></i></div>
							<div class="text"><?php the_field('phone','option'); ?></div>
						</div>
						<div class="item address">
							<div class="icon"><i class="far fa-envelope"></i></div>
							<div class="text"><?php the_field('email','option'); ?></div>
						</div>
						<div class="item opening">
							<div class="icon"><i class="far fa-clock"></i></div>
							<div class="text"><?php the_field('opening','option'); ?></div>
						</div>
					</div>
					<div class="socials">
						<?php 
							$socials = get_field('socials', 'option');
							foreach ($socials as $soc) {
						?>
						<a href="<?php echo $soc['url']; ?>" title="<?php echo $soc['title']; ?>"><i class="<?php echo $soc['icon']; ?>"></i></a>
						<?php } ?>
						
					</div>
				</div>
				<div class="col-lg-5 form">
					<h2>Get in touch</h2>
					<hr>
					<?php 
					$formcode = get_field('form_shortcode', 'option'); 
					echo do_shortcode($formcode); 
					?>
				</div>
				<div class="col-lg-1 empty"></div>
			</div>
		</div>
		<div class="container-fluid copyrightcontainer">
			<div class="row copyright">
				<div class="col-1 empty"></div>
				<div class="col-11">
					<p><?php the_field('copyright', 'option'); ?></p>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
