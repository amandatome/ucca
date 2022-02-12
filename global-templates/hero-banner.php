<div class='hero'>
  <div class="container col-xxl-12 py-5">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
      <div class="col-10 col-sm-8 col-lg-4">
        <?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'large-banner', false); ?>
        

          <p class='text-center'><?php echo the_post_thumbnail_caption(); ?></p>






      </div>
      <div class="col-lg-8">
        <h1 class="display-5 fw-bold lh-1 mb-3"><?php the_title()?></h1>
       <?php the_field("header_text")?>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
        <?php

        // Check rows exists.
        if( have_rows('hero_links') ):

            // Loop through rows.
            while( have_rows('hero_links') ) : the_row();

                // Load sub field value.
                $button_link = get_sub_field('hero_buttons');
                // Do something...
                if( $button_link ): 
                  $button_link_url = $button_link['url'];
                  $button_link_title = $button_link['title'];
                  $button_link_target = $button_link['target'] ? $button_link['target'] : '_self';
                  ?>
                  <a class="btn-primary btn-md p-3 rounded " role='button' href="<?php echo esc_url( $button_link_url ); ?>" target="<?php echo esc_attr( $button_link_target ); ?>"><?php echo esc_html( $button_link_title ); ?></a>
              <?php endif; ?>
          <?php // End loop.
            endwhile;

        // No value.
        else :
            // Do something...
        endif;?>
        </div>
      </div>
    </div>
  </div>
</div> 
