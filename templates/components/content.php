<?php get_header(); ?>
<?php
$content  = get_sub_field('content');
$content2 = get_sub_field('content2');
$content3 = get_sub_field('content3');
$content4 = get_sub_field('content4');
$content5 = get_sub_field('content5');

?>

<section class="component component_content">
  <div class="input-page-wrapper">
    <div class="container">
      <div class="ruta col-sm-12">
        <div class="row">

          <div class="ruta1 col-sm-4">
            <div class="ruta2">
              <p class="paragraph">
              <?php echo $content; ?>
            </p>
          </div>
        </div>

          <div class="ruta1 col-sm-4">
            <div class="ruta3">
            <?php echo $content2; ?>
          </div>
        </div>

          <div class="ruta1 col-sm-4">
            <div class="ruta4">
            <?php echo $content3; ?>
          </div>
        </div>

        <div class="ruta1 col-sm-4">
          <div class="ruta5">
          <?php echo $content4; ?>
        </div>
      </div>

      <div class="ruta1 col-sm-4">
        <div class="ruta6">
        <?php echo $content5; ?>
      </div>
    </div>

          </div>
        </div>
      </div>
    </div>
</section>
