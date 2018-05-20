<?php
/*
 * Template Name: Contact
 * Description: Special template for contact page with people
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

          <?php
          if( have_rows('persons') ): ?>
                  <h2><?php the_field('heading'); ?></h2>
                  
                  <div class="row list-employees">

                    <?php while( have_rows('persons') ): the_row(); 
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
                            <div class="icon-wrapper"><a href="mailto:<?php echo $email; ?>"><i class="fa fa-envelope" aria-hidden="true"><span class="fix-editor">&nbsp;</span></i> </a></div>
                          <?php endif; ?>
                      </div>
                    <?php endwhile; ?>

                  </div>
                <?php endif; ?>      

                <?php the_field('tekst'); ?> 

          </div><!-- .entry-content -->
        </article><!-- #post-## -->
</div><!-- #primary -->
</div>

<?php get_footer(); ?>