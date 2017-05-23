<?php
/**
 * Home Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package defense360
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main content-wrapper" role="main">

		<?php
			// Featured Item
			if(get_theme_mod('hp_feature_1')) {
				global $post;
				$post = get_post(get_theme_mod('hp_feature_1'));
				setup_postdata($post);
				$post->isFeaturedMain = true;
				get_template_part( 'template-parts/content', get_post_format() );
				wp_reset_postdata();
			}
		?>

		<div class="row">
			<div class="col-xs-12 col-md-4 last-xs first-md">
				The Latest
			</div>
			<div class="col-xs-12 col-md-8">
				2 Other Featured Posts
				<?php
					if(get_theme_mod('hp_feature_2') || get_theme_mod('hp_feature_3')) {

						$featuredPostsArgs = array(
							'post__in' => array(
								get_theme_mod('hp_feature_2'),
								get_theme_mod('hp_feature_3')
								)
						);
						$featured_posts = get_posts($featuredPostsArgs);
					}
				?>
			</div>
		</div>
		
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
