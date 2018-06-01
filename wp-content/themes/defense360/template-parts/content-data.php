<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package defense360
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('row'); ?>>
	<div class="post-thumbnail col-xs-12 col-md-3">
		<div class="post-thumbnailContainer">
			<?php
				if (has_post_thumbnail()) :
					echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
					the_post_thumbnail( 'medium' );
					echo '</a>';
				endif;
				?>
		</div>
	</div>
	<div class="post-content col-xs-12 col-md-9">
		<header class="entry-header">
			<?php
			defense360_entry_contentType();
			the_title( '<h2 class="entry-title '.$isHomepage.'"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<div class="entry-meta">
				<?php defense360_last_updated(); ?>
			</div><!-- .entry-meta -->
		</footer><!-- .entry-footer -->
	</div>
</article><!-- #post-## -->
