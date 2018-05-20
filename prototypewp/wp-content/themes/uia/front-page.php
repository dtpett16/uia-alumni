<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

        <?php $layout = get_field('layout_frontpage'); ?>

        <?php 
        if ($layout == "bigbanner" ) {
          //echo "bigbanner";?>
          <div class="container-outer-front-page-banner">
          <div class="front-page-bigbanner">

            <a href="<?php the_field('lenke_hovedbanner'); ?>" class="tile tile1 <?php the_field('tekstjustering_hovedbanner'); ?>">
                  <?php if(get_field('bilde_hovedbanner')) : ?>
                    <?php $image = get_field('bilde_hovedbanner'); ?>
                    <div style="background:url(<?php echo $image['url']; ?>) top center no-repeat;background-size: cover;">
                  <?php else : ?>
                    <div>
                  <?php endif ?>

                <div class="overlay">
                  <div class="caption">
                    <?php if(get_field('tekst_hovedbanner')) : ?>
                      <h2><?php the_field('tekst_hovedbanner'); ?></h2>
                    <?php endif ?>
                    <?php if(get_field('knappetekst_hovedbanner')) : ?>
                      <div class="cta"><?php the_field('knappetekst_hovedbanner'); ?></div>
                    <?php endif ?>
                  </div>
                </div>
              </div>
            </a>
            </div>
            </div>
<?php 
        }
        elseif ($layout == "banners" ) {
          //echo "banners";
          $banner1_image = get_field('hovedbanner_bilde');$banner2_image = get_field('banner_2_bilde');$banner3_image = get_field('banner_3_bilde'); ?>

          <div class="front-page-banner">
          <a href="<?php the_field('hovedbanner_lenke'); ?>" class="tile-no1" style="background:url(<?php echo $banner1_image['url']; ?>) center center;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">
            <div class="tile-content">
              <h2><?php the_field('hovedbanner_tekst'); ?></h2>
            </div>
          </a>

          <a href="<?php the_field('banner_2_lenke'); ?>" class="tile-no2" style="background:url(<?php echo $banner2_image['url']; ?>) center center;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">
            <div class="tile-content">
              <h2><?php the_field('banner_2_tekst'); ?></h2>
            </div>
          </a>

          <a href="<?php the_field('banner_3_lenke'); ?>" class="tile-no3" style="background:url(<?php echo $banner3_image['url']; ?>) center center;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;">
            <div class="tile-content">
              <h2><?php the_field('banner_3_tekst'); ?></h2>
            </div>
          </a>

          </div>
<?php 
        }
?>
        
        
        <div class="wrap">
        <div id="primary" class="site-content">
          <div id="content" role="main">

          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="entry-content">
              <?php the_field('innhold'); ?>
            </div><!-- .entry-content -->
          </article><!-- #post-## -->
           
           

          </div><!-- #content -->
        </div><!-- #primary -->
        </div><!-- wrap -->
        
<?php get_footer(); ?>