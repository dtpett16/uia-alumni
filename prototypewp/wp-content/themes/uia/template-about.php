<?php
/*
 * Template Name: About
 * Description: Special template for about page with teams
 */

get_header(); ?>
        
<div class="wrap">    
    <div id="primary" class="content-area">

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

          <header class="entry-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            <?php twentyseventeen_edit_link( get_the_ID() ); ?>
          </header><!-- .entry-header -->

          <div class="entry-content">

          <?php the_field('tekst'); ?>

          <?php $arr = array(1, 2, 3);
          foreach ($arr as &$value) {

                if( have_rows('persons'.$value) ): ?>
                  <h2><?php the_field('heading'.$value); ?></h2>
                  
                  <div class="row list-employees">

                    <?php while( have_rows('persons'.$value) ): the_row(); 
                      // vars
                      $image = get_sub_field('bilde');
                      $size = 'thumbnail';
                      $thumb = $image['sizes'][ $size ];

                      $name = get_sub_field('navn');
                      $title = get_sub_field('tittel');
                      $email = get_sub_field('epost');
                      $link = get_sub_field('profilside_lenke');
                      ?>
                      <div class="listelement-employee col-lg-3 col-md-4 col-xs-6">
                        <?php if( $link ): ?>
                          <a href="<?php echo $link; ?>" target="_blank">
                        <?php endif; ?>
                          <img src="<?php echo $thumb; ?>" alt="<?php echo $image['alt'] ?>" />
                        <?php if( $link ): ?>
                          </a>
                        <?php endif; ?>
                          <div class="name"><?php echo $name; ?></div>
                          <div class="pos"><?php echo $title; ?></div>
                          <?php if( $email ): ?>
                            <div class="email"><a href="mailto:<?php echo $email; ?>"><i class="fa fa-envelope" aria-hidden="true"></i> Email</a></div>
                          <?php endif; ?>
                      </div>
                    <?php endwhile; ?>

                  </div>
                <?php endif;

          } //end for each
  

          
          $sponsor_arr = array(4, 5);
          foreach ($sponsor_arr as &$value) {

            if( have_rows('sponsorer'.$value) ): ?>
              <h2><?php the_field('heading'.$value); ?></h2>
              
              <div class="row">

                <?php while( have_rows('sponsorer'.$value) ): the_row(); 
                  // vars
                  $image = get_sub_field('logo');
                  $content = get_sub_field('navn');
                  $link = get_sub_field('lenke');
                  ?>
                  <div class="listelement-sponsor col-md-4 col-xs-6">
                    <?php if( $link ): ?>
                      <a href="<?php echo $link; ?>" target="_blank">
                    <?php endif; ?>
                      <img src="<?php echo $image['url']; ?>" alt="<?php echo $content ?>" />
                    <?php if( $link ): ?>
                      </a>
                    <?php endif; ?>
                  </div>
                <?php endwhile; ?>

              </div>
            <?php endif; 

          } //end for each ?>          

          </div><!-- .entry-content -->
        </article><!-- #post-## -->
</div><!-- #primary -->
</div>

<?php get_footer(); ?>