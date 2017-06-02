<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package defense360
 */

if (has_post_thumbnail()) :
	$showPostThumbnail = true;
	$contentWithPostThumbnail = "col-md-9";
endif;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">
	<?php if($showPostThumbnail) { ?>
		<div class="post-thumbnail col-xs-12 col-md-3">
			<div class="post-thumbnailContainer">
				<?php the_post_thumbnail( 'medium' ); ?>
			</div>
		</div>
	<?php } ?>
		<div class="post-content col-xs-12 <?php echo $contentWithPostThumbnail; ?>">
			<header class="entry-header">
				<?php
				// Post Content Type & Category
				defense360_entry_contentType();
				?>
				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			</header><!-- .entry-header -->

			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->

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
