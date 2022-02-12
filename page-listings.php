<?php

/**
 * Template Name: Archives Listing Page Template
 *
 * Template for listing of archival fonds.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = get_theme_mod('understrap_container_type');

?>
<main class="main-content" id='content'tabindex="-1">
	<?php if (have_posts()) : while ( have_posts() ) : the_post(); ?>
  <?php get_template_part('global-templates/hero-banner');?>

		<div class="<?php echo esc_attr($container); ?>" tabindex="-1"> 
			<div class='row'>
		
					<ul class='list-division'>
				<?php
        // Check rows exists.
        if( have_rows('listing') ):
            // Loop through rows.
            while( have_rows('listing') ) : the_row();
                // Load sub field value.
								$section_heading = get_sub_field('section_heading');
                $fonds_link = get_sub_field('fonds_link');
								$fonds_title = get_sub_field('fonds_title');
								
								if ($fonds_title):?>
								<li><?php echo $fonds_title;?></li>
								<?php endif;?>
								
								<?php if( $fonds_link ): 
										$fonds_link_url = $fonds_link['url'];
										$fonds_link_title = $fonds_link['title'];
										$fonds_link_target = $fonds_link['target'] ? $fonds_link['target'] : '_self';
										?>
										<li><a href="<?php echo esc_url( $fonds_link_url ); ?>" target="<?php echo esc_attr( $fonds_link_target ); ?>"><?php echo esc_html( $fonds_link_title ); ?></a></li>
								<?php endif; ?>

        		<?php // End loop.
            endwhile;
        		// No value.
        	else :
            // Do something...
        	endif;?>
					</ul>
			
			</div>	
    
    </div>
     
	<?php endwhile;
		else : ?>
		<p>Sorry no posts matched your criteria.</p>
    <?php endif; ?>
 
</main> <!-- #main-content -->
<?php get_footer();?>
