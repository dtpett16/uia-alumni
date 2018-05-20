<?php
/**
 * Displays footer options
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

<aside class="widget-area" role="complementary">
	<h2 class="widget-title"><?php the_field('footerheading', 'options'); ?></h2>
	<?php the_field('footercontent', 'options'); ?>
</aside><!-- .widget-area -->