<?php
/**
 * The template for displaying single defense360 data posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package defense360
 */

$id = get_the_id();

$content_placement = get_post_meta( $id, '_data_content_placement', true );
$full_width = get_post_meta( $id, '_data_full_width', true );

if ( $full_width ) {
	$interactive = do_shortcode( '[fullWidth width="' . $full_width . '%"][data id="' . $id . '"][/fullWidth]');
} else {
	$interactive = do_shortcode( '[data id="' . $id . '"]' );
}



get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main content-wrapper">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header row">
				<div class="entry-meta-top content-padding col-xs-12 row">
					<div class="post-format-container">
					</div>
				</div>
				<div class="title-container content-padding col-xs-12">
					<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
				</div>
			</header><!-- .entry-header -->

			<div class="entry-content content-padding">
				<?php
				if ( 'below' === $content_placement ) {
					echo $interactive;
				}
				?>
				<div class="entry-content-post-body">
					<?php
					the_content(
						sprintf(
							wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'defense360'),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							get_the_title()
						)
					);
					?>
				</div>
				<?php
					if ( 'above' === $content_placement ) {
						echo $interactive;
					}
				?>
			</div><!-- .entry-content -->

			<footer class="entry-footer">
				<section class="footer-top content-padding row">
					<div class="entry-citation col-xs-12 col-md-9">
						<?php defense360_citation(); ?>
					</div>
					<div class="entry-share col-xs-12 col-md-3">
						<?php get_template_part( 'components/share-inline' ); ?>
					</div>
				</section>
				<section class="footer-middle content-padding row">
					<?php defense360_post_footnotes(); ?>
		    		<?php defense360_post_sources( $post->ID ); ?>
		    	</section>
				<?php defense360_return_to_archive(); ?>
				<?php get_template_part( 'components/explore-more' ); ?>
			</footer><!-- .entry-footer -->
		</article><!-- #post-<?php the_ID(); ?> -->
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
