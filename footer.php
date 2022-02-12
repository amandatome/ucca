<?php

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

$container = get_theme_mod('understrap_container_type');
?>

<div class="wrapper" id="wrapper-footer">
    <footer class="site-footer" id="colophon">
        <div class="<?php echo esc_attr($container); ?>">
        <hr>
            <div class="row mb-2">
                <div class="col-md-6 col-sm-12" id='footer-one'>
                    <?php dynamic_sidebar('footer_area_one');?>
                </div><!--  .col-md-5 -->
                <div class="col-md-6" id='footer-two'>
                    <?php dynamic_sidebar('footer_area_two');?>
                </div><!--  .col-md-5-->
            </div>
           
            <div class="site-info mt-3">
                <hr>
                <a  class='text-left' href="https://thechildrenremembered.ca/sitemap/">Sitemap</a>
                <p class='text-center'>Copyright © <?php echo date('Y'); ?> - United Church of Canada</p>

            </div><!-- .site-info -->
        </div><!--.container-->
    </footer><!-- #colophon -->
</div> <!--.wrapper-->
</div><!--.site-->
<?php wp_footer();?>

</body>

</html>