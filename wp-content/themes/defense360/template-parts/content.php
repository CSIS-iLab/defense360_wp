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
	<header class="content-wrapper-narrow entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php defense360_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif;

		// Feature Image
		if (is_single() && has_post_thumbnail()) :
			the_post_thumbnail( 'medium_large' );
		endif;
		?>

	</header><!-- .entry-header -->

	<div class="content-wrapper-narrow entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'defense360' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'defense360' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
<!-- 		- Share Icons
		- Tags
		- Authors
		- Related Posts -->

		<?php
			if ( 'post' === get_post_type() ) : 
				foreach( get_coauthors() as $coauthor ):
					if(!empty($coauthor->website)) {
						$authorURL = $coauthor->website;
						$authorRel = "rel='external'";
						$authorTarget = "target='_blank'";
					}
					else {
						$authorURL = get_author_posts_url( $coauthor->ID, $coauthor->user_nicename );
						$authorRel = null;
						$authorTarget = null;
					}
					?>
				<div class="post-authorContainer">
					<div class="content-wrapper-narrow row flex-center__y">
						<div class="col-xs-3">
							<a href="<?php echo $authorURL; ?>" <?php echo $authorRel." ".$authorTarget; ?>><?php echo coauthors_get_avatar($coauthor, 100); ?></a>
						</div>
						<div class="col-xs-9">
							<p><a href="<?php echo $authorURL; ?>" <?php echo $authorRel." ".$authorTarget; ?>><strong><?php echo $coauthor->display_name; ?></strong></a> <?php echo $coauthor->description; ?></p>

						</div>
					</div>
				</div>
			<?php 
				endforeach;
				endif; 
			?>

		<?php defense360_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
