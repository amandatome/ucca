<?php

/**
 * Template Name: Holdings Page Template
 *
 * Template for holdings related page.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = get_theme_mod('understrap_container_type');

?>
<main class="main-content" id='content' tabindex="-1">
  <?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>
  <?php get_template_part('global-templates/hero-banner-pages');?>	
  <div class='pt-5 holdings'>
  <h2>General Acquisition Areas</h2>
    <div class="<?php echo esc_attr($container); ?> pb-4"> 
       <div class='card p-2 shadow-lg rounded mb-4'>
         <div class='card-body'>
          <?php the_field('acquisitions_text')?>
        </div>
      </div>
  <div class='row row-cols-1 row-cols-md-3 g-4'>
  <?php

    // Check rows exists.
    if( have_rows('holding_info') ):
   
        // Loop through rows.
        while( have_rows('holding_info') ) : the_row();
    
            // Load sub field value.
            $heading = get_sub_field('heading');
            $program = get_sub_field('program_info');
            $holdings_link = get_sub_field('holdings_link');?>
            
          <div class='col my-4'>
          <div class="card shadow-lg rounded h-100">
            <div class="card-body">
              <h3 class="card-title"><?php echo $heading ?></h3>
              <?php echo $program; ?>
              
            </div>
            <div class='card-footer'>
            <?php
                    if( $holdings_link ): 
                    $holdings_link_url = $holdings_link['url'];
                    $holdings_link_title = $holdings_link['title'];
                    $holdings_link_target = $holdings_link['target'] ? $holdings_link['target'] : '_self';
                    ?>
                    <a class="btn btn-md btn-primary" href="<?php echo esc_url( $holdings_link_url ); ?>" target="<?php echo esc_attr( $holdings_link_target ); ?>"><?php echo esc_html( $holdings_link_title ); ?></a>
                    <?php endif;?>
            </div> 
          </div>
          </div>  



            

        <?php // End loop.
        endwhile;

    // No value.
    else :
        // Do something...
    endif;?>
    </div>
    </div>
  </div> <!--.holdings-->
	<?php endwhile;
		else : ?>
		<p>Sorry no posts matched your criteria.</p>
    <?php endif; ?>
</main> <!-- #main-content -->
<?php get_footer();?>
