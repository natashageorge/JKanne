<?php
get_header();
// Setting archive parameters. To get field use the_field("field",$archive_page_object->ID);
$archive_page_object = get_archive_page_object();
if($archive_page_object) $archive_title = $archive_page_object->post_title;
if($archive_page_object) $archive_content = apply_filters('the_content', $archive_page_object->post_content);
?>
<main id="main" role="main">
<?php echo (isset($archive_title) && $archive_title != "" ? "<h1>" . $archive_title . "</h1>":""); ?>
<?php echo (isset($archive_content) && $archive_content != "" ? $archive_content:""); ?>

<?php if(is_search() || ( is_archive() && !is_post_type_archive())) : ?>
	<article class="container-fluid">
		<div class="row">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part('templates/post'); ?>
			<?php endwhile; ?>
		</div>
		<div class="row">
			<nav class="col-md-12 pagination">
				<?php
					global $wp_query;
					$big = 999999999; // need an unlikely integer
					echo paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $wp_query->max_num_pages
					) );
				?>
			</nav>
		</div>
	</article>
<?php endif; ?>
</main><!-- /#main -->
<?php get_footer(); ?>
