<?php
/**
 * Home Page: Secondary Featured Posts Layout
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
			the_title( '<h2 class="entry-title home-secondaryFeature"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>
	</header><!-- .entry-header -->
	<div class="row">
		<div class="post-thumbnail col-xs-12 col-md-4 last-md">
			<div class="post-thumbnailContainer home-secondaryFeature">
				<?php
					if (has_post_thumbnail()) :
						echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
						the_post_thumbnail( 'full' );
						echo '</a>';
					endif;
					?>
			</div>
		</div>
		<div class="col-xs-12 col-md-8">
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