<?php
/**
 * Template for dispaying "Series" page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package defense360
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main page-series content-wrapper" role="main">

			<header class="page-header">
				<div class="content-wrapper-narrow">
					<?php the_title('<h1 class="page-title">', '</h1>' ); ?>
					<?php the_content(); ?>
				</div>
			</header>

		<?php
		    $seriesList = get_terms( array(
			    'taxonomy' => 'series',
			    'hide_empty' => true,
			) );

			if(!empty($seriesList)) {
				foreach($seriesList as $post) : setup_postdata($post);
					get_template_part( 'template-parts/series-content', get_post_format() );
				endforeach;
				wp_reset_postdata();
			}

		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
