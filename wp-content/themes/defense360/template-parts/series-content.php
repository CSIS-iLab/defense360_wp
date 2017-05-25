<?php
/**
 * Template part for displaying series on the series landing page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package defense360
 */

$seriesURL = get_term_link($post->term_id);
$thumbnailURL = get_term_meta( $post->term_id, 'series_feature_image', true );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row flex-center__y">
		<div class="post-thumbnail col-xs-12 col-md-3">
			<div class="post-thumbnailContainer">
				<?php
					if ($thumbnailURL) :
						echo "<img src='".$thumbnailURL."' alt='".$post->name."' title='".$post->name."' />";
					endif;
					?>
			</div>
		</div>
		<div class="post-content col-xs-12 col-md-9">
			<header class="entry-header">
				<h2 class="entry-title"><a href="<?php echo $seriesURL; ?>" rel="bookmark"><?php echo $post->name; ?></a></h2>
			</header><!-- .entry-header -->
			<div class="entry-content">
				<p><?php echo $post->description; ?></p>
			</div><!-- .entry-content -->
		</div>
	</div>
</article><!-- #post-## -->
