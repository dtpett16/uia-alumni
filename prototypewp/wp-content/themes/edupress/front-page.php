<?php
/**
 * The front page template file.
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear. Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package EduPress
 */

if ( 'posts' == get_option( 'show_on_front' ) ) :

	get_template_part( 'index' );

else :

?>

	<?php get_header(); ?>

	<div id="site-main" class="content-home">

		<div class="wrapper wrapper-main clearfix">
			
			<div class="wrapper-frame clearfix">
			
				<main id="site-content" class="site-main" role="main">
				
					<div class="site-content-wrapper clearfix">
	
						<?php
						if ( 1 == get_theme_mod( 'edupress_front_featured_pages', 1 ) ) {
							get_template_part( 'template-parts/content', 'home-featured' );
						}
						
						if ( 1 == get_theme_mod( 'edupress_front_featured_pages_columns', 1 ) ) {
							get_template_part( 'template-parts/content', 'home-pages' );
						}
						?>

						<?php while ( have_posts() ) : the_post(); ?>
						
						<div class="clearfix">
		
							<?php get_template_part( 'template-parts/content', 'home' ); ?>
							
						</div><!-- .clearfix -->
						
						<?php endwhile; // End of the loop. ?>

					</div><!-- .site-content-wrapper .clearfix -->
				
				</main><!-- #site-content -->
				
				<?php get_sidebar(); ?>
			
			</div><!-- .wrapper-frame -->
		
		</div><!-- .wrapper .wrapper-main -->

	</div><!-- #site-main -->

	<?php get_footer(); ?>

<?php endif; ?>