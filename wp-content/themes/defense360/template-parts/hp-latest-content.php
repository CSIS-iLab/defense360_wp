<?php
/**
 * Home Page: the Latest post template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package defense360
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		// Post Content Type & Category
		defense360_entry_contentType();
		// Post Title
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>
	</header><!-- .entry-header -->

	<footer class="entry-footer">
		<?php
		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php defense360_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif;
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->