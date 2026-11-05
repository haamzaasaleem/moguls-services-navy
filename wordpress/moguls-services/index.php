<?php
/**
 * Fallback for blog posts, archives and anything without its own template.
 */
get_header();
?>
<main id="main" class="mm-page">
  <div class="wrap">
	<?php if ( have_posts() ) : ?>
		<?php if ( ! is_singular() ) : ?>
			<h1><?php echo esc_html( wp_strip_all_tags( get_the_archive_title() ? get_the_archive_title() : get_bloginfo( 'name' ) ) ); ?></h1>
		<?php endif; ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class( 'entry' ); ?>>
				<?php if ( is_singular() ) : ?>
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
				<?php else : ?>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php the_excerpt(); ?>
				<?php endif; ?>
			</article>
		<?php endwhile; ?>
		<?php the_posts_pagination(); ?>
	<?php else : ?>
		<h1>Page not found</h1>
		<p>Sorry, that page does not exist. <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Go to the home page</a>.</p>
	<?php endif; ?>
  </div>
</main>
<?php
get_footer();
