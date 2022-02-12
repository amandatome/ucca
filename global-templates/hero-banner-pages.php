<div class='hero'>
  <div class="container col-xxl-12 py-5">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
      <div class="col-10 col-sm-8 col-lg-4">
        <?php echo wp_get_attachment_image(get_post_thumbnail_id(), 'large-banner', false); ?>
      </div>
      <div class="col-lg-8">
        <h1 class="display-5 fw-bold lh-1 mb-3"><?php the_title()?></h1>
        <p class="lead"><?php the_field("header_text")?></p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
        <?php 
          $link = get_field('button');
          if( $link ): 
              $link_url = $link['url'];
              $link_title = $link['title'];
              $link_target = $link['target'] ? $link['target'] : '_self';
              ?>
              <a class="btn btn-lg btn-primary" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div> 
