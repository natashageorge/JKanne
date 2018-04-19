<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package JKanne AB
 * @since VERSIONING
 */
?>

<footer class="footer1 component_content">
  <div class="input-footer-wrapper">
    <div class="container" id="container-ruta">
      <div class="ruta col-sm-12">
        <div class="row">
          <div class="ruta5">
            <p class="paragraph">
            <?php the_field("editor","options"); ?>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- HÄR SLUTAR WRAPPER DIVEN / </DIV ID = "WRAPPER"> -->
</footer>

  <?php
	 /*if(is_active_sidebar('sidebar-footer')) {
	 dynamic_sidebar('sidebar-footer');
	 }*/ ?>

	<?php wp_footer(); ?>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  </body>
  </html>
