<?php get_header(); ?>
<main id="main" role="main">
	<article class="page-wrapper">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php if ( have_rows( 'page_components' ) && ! post_password_required() ) : ?>
				<?php while ( have_rows( 'page_components' ) ) : the_row(); ?>
					<?php
						if(get_row_layout() == 'global-components') :
							$layout = get_sub_field('global_components');
							$name = get_the_title($layout);
							$slug = sanitize_title($name);

							get_template_part( 'templates/components/' . $slug );
						else :
							get_template_part( 'templates/components/' . get_row_layout() );
						endif;
					?>
				<?php endwhile; ?>
			<?php endif; ?>
		<?php endwhile; ?>
	</article>
</main><!-- /#main -->

<?php get_footer(); ?>
