<?php

/**
 * Template Name: Archives Page Template
 *
 * Template for archives related page.
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
  <div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">
  <div class='row'>
      <div class='col-12'>
      <?php the_field("holdings_text")?>
      </div> 
    
  

  </div>  
    
	<?php endwhile;
		else : ?>
		<p>Sorry no posts matched your criteria.</p>
    <?php endif; ?>
    </div>
</main> <!-- #main-content -->
<?php get_footer();?>
