<?php

/**
 * Template Name: Home Page Template
 *
 * Template for home page.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = get_theme_mod('understrap_container_type');

?>
<main class="main-content" id='content'>
	<?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>
  <?php get_template_part('global-templates/hero-banner');?>
  <div class='quick-links'>
  <div class='col-12'> 
        <h2><?php the_field("quick_links_heading")?></h2>
      </div> 
		<div class="<?php echo esc_attr($container); ?>" tabindex="-1">
    <div class='row'>
     
   
    <?php

        // Check rows exists.
        if( have_rows('quick_links') ):

            // Loop through rows.
            while( have_rows('quick_links') ) : the_row();

                // Load sub field value.
                $heading_link = get_sub_field('quick_link_heading');?>
        <div class='col-4 py-3'>
          <div class="card shadow ">
          <div class="card-body">
            <h3 class="card-title"><?php echo $heading_link?></h3>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary btn-sm">Card link</a>
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
      </div>
    
	<?php endwhile;
		else : ?>
		<p>Sorry no posts matched your criteria.</p>
    <?php endif; ?>
</main> <!-- #main-content -->
<?php get_footer();?>
