<?php
/*
 * Related posts */
// WP_Query arguments
$exclude_ids = array( (int)get_the_ID() );
$tags = get_the_tags();

if(is_array($tags) &&
	sizeof($tags) > 0)
{

// Appending to get_tags variable
if(sizeof($tags) > 0)
foreach($tags as $tag) $get_tags[] = $tag->term_id;

$args = array (
	'post_type'              => 'post',
	'order'                  => 'DESC',
	'orderby'                => 'date',
	'posts_per_page'         => 4,
	'tag__in'                => $get_tags,
	'post__not_in'           => $exclude_ids
);

// The Query
$wpquery = new WP_Query( $args );

if($wpquery->have_posts()): ?>
	<section class="related-posts">
        <h4><?php _e( 'Related blog posts', 'jkanne-bootstrap' ); ?></h4>
		<?php while ( $wpquery->have_posts() ) : $wpquery->the_post(); ?>
			<?php get_template_part('templates/post'); ?>
		<?php endwhile; wp_reset_postdata(); ?>
	</section>
<?php endif; ?>

<?php } ?>
