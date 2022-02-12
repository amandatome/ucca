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
  <div class='general-info'>
    <h2><?php the_field("general_info")?></h2>
		<div class="<?php echo esc_attr($container); ?>" tabindex="-1"> 
    <div class='row mb-5'>
      <div class='col-6'>
      <h3>Location & Hours</h3>
      <?php the_field('location_text')?>
      <?php 
      $link = get_field('contact_button');
      if( $link ): 
          $link_url = $link['url'];
          $link_title = $link['title'];
          $link_target = $link['target'] ? $link['target'] : '_self';
          ?>
          <a class="btn btn-lg btn-primary" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
      <?php endif; ?>
      </div>
      <div class='col-md-6 quick-links'>
				<h3><?php the_field('quick_links_heading')?></h3>
				<div class="card">
        <ul>
        <?php
        // Check rows exists.
        if( have_rows('quick_links') ):
            // Loop through rows.
            while( have_rows('quick_links') ) : the_row();
                // Load sub field value.
                $heading_link = get_sub_field('quick_link_heading');?>
              <li><?php echo $heading_link?></li>
              
        <?php // End loop.
            endwhile;
        // No value.
        else :
            // Do something...
        endif;?>
        </ul>
      </div> 
      </div>
    </div>
  </div>
  <div class='staff-circle'>
  <div class='container'> 
    <div class='row row-eq-height d-flex align-items-center mt-5 pt-5'>
      <div class='col-8'>
        <div class='card p-5'>
        <?php the_field('archives_staff_circle_info')?>
      </div>
      </div>  
      <div class='col-4'>
      <?php 
      $image = get_field('archives_circle_image');
      $size = 'full'; // (thumbnail, medium, large, full or custom size)
      if( $image ) {
          echo wp_get_attachment_image($image, $size, false, array('class' => 'shadow image'));
      }?>
      </div>
    </div>  
  </div>
      </div>
  <div class='contact'>
      <h2 id='get-in-touch'><?php the_field("get_in_touch")?></h2>
      <div class="<?php echo esc_attr($container); ?>" tabindex="-1"> 
        <div class='row'>
            <div class='col-10 offset-1 shadow my-3 form rounded'>
            <?php the_content()?>
           </div>
        </div>
		  </div>
    </div>
     
	<?php endwhile;
		else : ?>
		<p>Sorry no posts matched your criteria.</p>
    <?php endif; ?>
    </div><!--.general info-->
</main> <!-- #main-content -->
<?php get_footer();?>
