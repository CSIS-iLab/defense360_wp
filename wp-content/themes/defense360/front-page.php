<?php
/**
 * Home Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package defense360
 */

require_once( get_template_directory() . '/inc/hp-series.php' );

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main home-container" role="main">

		<div class="content-wrapper">

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
							'post_status' => 'publish',
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
									),
								'orderby' => 'post__in'
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
		</div>

		<!-- Series -->
		<div class="home-seriesContainer">
			<div class="content-wrapper row">
				<div class="home-seriesSpotlight col-xs-12 col-md-4">
					<h4 class="series-sectionTitle">Series Spotlight</h4>

					<?php
					if(get_theme_mod('hp_series_1')) {
						$featuredSeries = get_term_by('id', get_theme_mod('hp_series_1'), 'series');
						$featuredSeriesURL = get_term_link($featuredSeries->term_id);
						$featuredSeriesImageURL = get_term_meta( get_theme_mod('hp_series_1'), 'series_feature_image', true );
						?>
						<h2 class="series-featuredTitle"><a href="<?php echo $featuredSeriesURL; ?>"><?php echo $featuredSeries->name; ?></a></h2>
						<p><?php echo $featuredSeries->description; ?></p>
						<a href="<?php echo $featuredSeriesURL; ?>" class="series-learnMore">Learn More</a>
						<?php
					}
					?>
					
				</div>
				<div class="home-seriesAdditional col-xs-12 col-md-4 last-xs">
					<h4 class="series-sectionTitle">Additional Series</h4>
					<?php
						$series_category_query = get_transient('series_category_query');
						if ( !$series_category_query ){
						   	$series_category_query = series_category_cache();
						}

					    foreach ( $series_category_query as $series_cat ) { ?>
							<h3 class="series-additionalTitle"><a href="<?php echo $series_cat['term_link']; ?>" class="title-overlay"><?php echo $series_cat['name']; ?></a></h3>
							<p>Last Updated <?php echo $series_cat['most_recent_date']; ?></p>
					    <?php 
						}	
					?>

					<a href="/series" class="series-exploreMore">Explore More</a>
					
				</div>
				<div class="home-seriesFeaturedImage col-xs-12 col-md-4 last-md" style="background-image:url(<?php echo $featuredSeriesImageURL; ?>);">
				</div>
			</div>
		</div>
		
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
