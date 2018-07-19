<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package defense360
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main content-wrapper" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<div class="content-wrapper-narrow">
				<?php
					if ( is_author() ) {
						$author = get_queried_object();
						echo coauthors_get_avatar($author, 100);
					}

					the_archive_title( '<h1 class="page-title">', '</h1>' );

					the_archive_description( '<div class="archive-description">', '</div>' );

					if(is_tax('series')) {
						$featuredSeriesImageURL = get_term_meta( get_queried_object()->term_id, 'series_feature_image', true );
						echo "<img src='".$featuredSeriesImageURL."' alt='".$featuredSeries->name."' class='archive-featuredImage' />";
					}
				?>
				</div>
				<div class="archive-searchFilter">
					<?php
						echo do_shortcode( '[searchandfilter fields="search,content-type,category,post_tag,series" headings="Filter Results:" all_items_labels=",All Content,,,"]' );
					?>
				</div>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				
				if ( 'data' === $post->post_type ) {
					get_template_part( 'template-parts/content-data' );
				} else {
					get_template_part( 'template-parts/content', get_post_format() );
				}

			endwhile;

			echo "<div class='pagination-container'>".paginate_links()."</div>";

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
