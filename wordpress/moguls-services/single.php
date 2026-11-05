<?php
/**
 * A single blog post.
 */
get_header();
?>
<main id="main" class="mm-page">
  <div class="wrap">
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class( 'entry' ); ?>>
			<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>
		</article>
	<?php endwhile; ?>
  </div>
</main>
<?php
get_footer();
