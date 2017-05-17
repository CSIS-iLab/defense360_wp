<?php
/**
 * Template part for displaying posts
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
	<div class="row">
		<div class="post-thumbnailContainer col-xs-12 col-md-3">
			<?php
			if (has_post_thumbnail()) :
				the_post_thumbnail( 'medium' );
			endif;
			?>
		</div>
		<div class="col-xs-12 col-md-9">
			<div class="entry-content">
				<?php the_excerpt(); ?>
			</div><!-- .entry-content -->

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
