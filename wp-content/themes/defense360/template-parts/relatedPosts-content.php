<?php
/**
 * Template part for displaying related posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package defense360
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
		<div class="post-thumbnail col-xs-12 col-md-4">
			<div class="post-thumbnailContainer">
				<?php
					if (has_post_thumbnail()) :
						the_post_thumbnail( 'medium' );
					endif;
					?>
			</div>
		</div>
		<div class="post-content col-xs-12 col-md-8">
			<header class="entry-header">
				<?php
				// Post Content Type & Category
				defense360_entry_contentType();

				// Post Title
				the_title( '<h2 class="entry-title '.$isHomepage.'"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
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
		</div>
	</div>
</article><!-- #post-## -->