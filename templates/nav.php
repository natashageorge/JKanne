<header class="site-header">
<div class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container-fluid">

<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

<span class="sr-only">Toggle navigation</span>
<span class="icon-bar icon-bar1"></span>
<span class="icon-bar icon-bar2"></span>
<span class="icon-bar icon-bar3"></span>

</button>

</div>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
<a href="<?php echo get_site_url(); ?>"><?php get_theme_logo(); ?></a>

<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
</div>
<!-- <?php get_search_form(); ?> -->
</div> <!--/container-fluid-->
</header>
