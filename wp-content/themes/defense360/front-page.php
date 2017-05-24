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
		<main id="main" class="site-main home-container content-wrapper" role="main">

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
			<!-- Most Recent Posts -->
			<div class="home-latestContainer col-xs-12 col-md-4 last-xs first-md">
				<h3 class="latest-title"><span>The Latest</span></h3>
				<?php
					$latest_post_args = array(
						'numberposts' => 4,
						'exclude' => array(
							get_theme_mod('hp_feature_1'),
							get_theme_mod('hp_feature_2'),
							get_theme_mod('hp_feature_3')
							)
					);
					$latest_posts = wp_get_recent_posts($latest_post_args, OBJECT);
					foreach($latest_posts as $post) : setup_postdata($post);
						get_template_part( 'template-parts/hp-latest-content', get_post_format() );
					endforeach;
					wp_reset_postdata();
				?>
			</div>
			<!-- Secondary Features -->
			<div class="home-secondaryFeaturesContainer col-xs-12 col-md-8">
				<?php
					if(get_theme_mod('hp_feature_2') || get_theme_mod('hp_feature_3')) {

						$featuredPostsArgs = array(
							'post__in' => array(
								get_theme_mod('hp_feature_2'),
								get_theme_mod('hp_feature_3')
								)
						);
						$featured_posts = get_posts($featuredPostsArgs);

						foreach($featured_posts as $post) : setup_postdata($post);
							get_template_part( 'template-parts/hp-secondary-features-content', get_post_format() );
						endforeach;
						wp_reset_postdata();
					}
				?>
			</div>
		</div>
		
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
