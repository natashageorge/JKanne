<?php
$gallery = get_sub_field('gallery');
?>
<section class="component component_gallery">
  <div class="container">
    <?php $size = 'medium'; // (thumbnail, medium, large, full or custom size)

if( $gallery ): ?>

<section class="component component_content">
  <div class="input-page-wrapper">
    <div class="container">
      <div class="ruta col-md-12">
        <div class="row">

    <ul class="gallery-photos-gallery">
        <?php foreach( $gallery as $image ): ?>
            <li class="gallery-photos col-md-4">
            	<a rel="lightbox" data-fancybox="images" data-caption="<?php echo $image['caption']; ?>" href="<?php echo wp_get_attachment_image_src( $image['ID'], 'full' )[0];
              ?>"><?php echo wp_get_attachment_image( $image['ID'], $size, false, array('rel'=>'lightbox') );
              ?>
            </a>
          </li>
       <?php endforeach; ?>
      </ul>
        </div>
      </div>
    </div>
  </div>
</section>
    <?php endif; ?>
  </div>
</section>
