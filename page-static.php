<?php

/**
 * Template Name: Static Page Template
 *
 * Template for all static related page.
 *
 * @package understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = get_theme_mod('understrap_container_type');

?>
<main class="main-content" id='content' tabindex="-1">
  <?php if (have_posts()): while (have_posts()): the_post();?>
		  <?php get_template_part('global-templates/hero-banner');?>
			<?php $base_text = get_field('static_page_text');?>
			<?php if ($base_text): ?>
		  <div class="<?php echo esc_attr($container); ?> mt-3">
		    <div class='row'>
          <?php echo $base_text;?>
		    </div>
		</div>
		<?php endif?>
			<?php

				// Check rows exists.
        if (have_rows('static')):
            $counter = 0;
            // Loop through rows.
            while (have_rows('static')): the_row();
                $counter++;
                // Load sub field value.
                $static_heading = get_sub_field('static_heading');
                $static_text = get_sub_field('static_text');

                // General Council
                if ($counter == 1) {?>
				         <h2 class='mt-3'><?php echo $static_heading; ?></h2>
				          <div class="<?php echo esc_attr($container); ?> mt-4">
				            <div class='row'>
				              <div class='col-12'>
				                <?php echo $static_text; ?>
				              </div>
				            </div>
				          </div>
				       <?php }
                if ($counter == 2) {?>
				          <div class='background-one'>
				          <h2 class='mt-5'><?php echo $static_heading; ?></h2>
				          <div class="<?php echo esc_attr($container); ?> mt-4">
				            <div class='row'>
				              <div class='col-12 background shadow'>
				                <?php echo $static_text; ?>
				              </div>
				            </div>
				          </div>
				        </div>
				        <?php }
                if ($counter == 3) {?>
				          <div class='background-two'>
				          <h2><?php echo $static_heading; ?></h2>
				          <div class="<?php echo esc_attr($container); ?> mt-4">
				            <div class='row'>
				              <div class='col-12'>
				                <?php echo $static_text; ?>
				              </div>
				            </div>
				          </div>
				        </div>
				        <?php }
                if ($counter == 4) {?>
				          <div class='background-one'>
				          <h2 class='mt-3'><?php echo $static_heading; ?></h2>
				          <div class="<?php echo esc_attr($container); ?> mt-4">
				            <div class='row'>
				              <div class='col-12 background shadow'>
				                <?php echo $static_text; ?>
				              </div>
				            </div>
				          </div>
				        </div>
				        <?php }
                // End loop.
            endwhile;

            // No value.
        else:
            // Do something...
        endif;?>

			<?php endwhile;
else: ?>
		<p>Sorry no posts matched your criteria.</p>
    <?php endif;?>
</main> <!-- #main-content -->
<?php get_footer();?>
