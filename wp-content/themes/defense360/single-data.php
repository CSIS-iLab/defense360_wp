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
			<div class="content-wrapper entry-content">
				<?php

					the_content( sprintf(
						/* translators: %s: Name of current post. */
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'defense360' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );

					if ( 'above' === $content_placement ) {
						echo $interactive;
					}

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'defense360' ),
						'after'  => '</div>',
					) );
				?>
				<div class='repository-view-container'>
					<p><span class="repository-view"><a>View in Data Repository</a></span></p>
					<div class="interactive-footer">
						<?php
							$thumbnail_id    = get_post_thumbnail_id($post->ID);
							$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);

							if ($alt) {
									echo '<span>Photo: '.$alt.'</span><br />';
							}

							the_tags('<h3>TAGS: ',',','</h3>');

							if ( function_exists( 'sharing_display' ) ) {
									sharing_display( '', true );
							}
						?>
					</div>
				</div>
				<?php

				?>

			</div><!-- .entry-content -->
				<footer class="entry-footer">
						<?php
						echo "<div class='post-relatedPostsContainer content-wrapper-narrow'>";
						echo '<h3 class="relatedPosts-title"><span>Related</span></h3>';
						echo do_shortcode( '[jprel]' );
						echo "</div>";
					?>
				</footer><!-- .entry-footer -->
		</article><!-- #post-<?php the_ID(); ?> -->
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
