<?php
/**
 * Template: Single Posts
 */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="content-wrapper-narrow entry-header">
				<?php
				// Post Content Type & Category
				defense360_entry_contentType();

				// Post Title
				if ( is_single() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;

				// Post Series
				defense360_entry_series();

				// Post Date & Author
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
							<div class="col-xs-2">
								<a href="<?php echo $authorURL; ?>" <?php echo $authorRel." ".$authorTarget; ?>><?php echo coauthors_get_avatar($coauthor, 70); ?></a>
							</div>
							<div class="col-xs-10">
								<p><a href="<?php echo $authorURL; ?>" <?php echo $authorRel." ".$authorTarget; ?>><strong><?php echo $coauthor->display_name; ?></strong></a> <?php echo $coauthor->description; ?></p>

							</div>
						</div>
					</div>
				<?php 
					endforeach;
					endif;

					// echo "<div class='post-relatedPostsContainer content-wrapper-narrow'>";
					// echo '<h3 class="relatedPosts-title"><span>Related</span></h3>';
					// echo do_shortcode( '[jprel]' );
					// echo "</div>";
				?>

				<div class="post-relatedPostsContainer content-wrapper-narrow">
				<h3 class="relatedPosts-title"><span>Related</span></h3>
<article id="post-43" class="post-43 post type-post status-publish format-standard has-post-thumbnail hentry category-acquisition category-budget category-reports tag-fy-2016">
	<div class="row">
		<div class="post-thumbnail col-xs-12 col-md-4">
			<div class="post-thumbnailContainer">
				<img width="300" height="194" src="http://defense360.wpengine.com/wp-content/uploads/2015/08/15615454465_f5e392f601_k-300x194.jpg" class="attachment-medium size-medium wp-post-image" alt="" srcset="http://defense360.wpengine.com/wp-content/uploads/2015/08/15615454465_f5e392f601_k-300x194.jpg 300w, http://defense360.wpengine.com/wp-content/uploads/2015/08/15615454465_f5e392f601_k-768x497.jpg 768w, http://defense360.wpengine.com/wp-content/uploads/2015/08/15615454465_f5e392f601_k-1024x663.jpg 1024w" sizes="(max-width: 300px) 100vw, 300px">			</div>
		</div>
		<div class="post-content col-xs-12 col-md-8">
			<header class="entry-header">
				<div class="post-contentCategoriesContainer"><span class="post-categories"><a href="http://defense360.wpengine.com/category/acquisition/" rel="category tag">Acquisition</a>, <a href="http://defense360.wpengine.com/category/budget/" rel="category tag">Budget</a>, <a href="http://defense360.wpengine.com/category/reports/" rel="category tag">Reports</a></span></div><h1 class="entry-title ">Defense Acquisition 2015: Acquisition Trends in an Era of Budgetary Uncertainty</h1>			</header><!-- .entry-header -->

			<footer class="entry-footer">
								<div class="entry-meta">
					<span class="posted-on"><a href="http://defense360.wpengine.com/acquisition-and-beyond/" rel="bookmark"><time class="entry-date published" datetime="2016-01-27T00:00:08+00:00">January 27, 2016</time></a> — </span><a href="http://defense360.wpengine.com/author/andrew-hunter/" title="Posts by Andrew Hunter" class="author url fn" rel="author">Andrew Hunter</a> and <a href="http://defense360.wpengine.com/author/defense360/" title="Posts by defense360" class="author url fn" rel="author">defense360</a>				</div><!-- .entry-meta -->
							</footer><!-- .entry-footer -->
		</div>
	</div>
</article><!-- #post-## -->
<article id="post-903" class="post-903 post type-post status-publish format-standard has-post-thumbnail hentry category-acquisition tag-contracts tag-oco tag-overseas-contingency-operations content-type-analysis">
	<div class="row">
		<div class="post-thumbnail col-xs-12 col-md-3">
			<div class="post-thumbnailContainer">
				<img width="300" height="163" src="http://defense360.wpengine.com/wp-content/uploads/2017/05/oco-300x163.jpg" class="attachment-medium size-medium wp-post-image" alt="Photo courtesy of U.S. Air Force: https://www.flickr.com/photos/usairforce/6337728522/" srcset="http://defense360.wpengine.com/wp-content/uploads/2017/05/oco-300x163.jpg 300w, http://defense360.wpengine.com/wp-content/uploads/2017/05/oco-768x418.jpg 768w, http://defense360.wpengine.com/wp-content/uploads/2017/05/oco-1024x557.jpg 1024w, http://defense360.wpengine.com/wp-content/uploads/2017/05/oco.jpg 1200w" sizes="(max-width: 300px) 100vw, 300px">			</div>
		</div>
		<div class="post-content col-xs-12 col-md-9">
			<header class="entry-header">
				<div class="post-contentCategoriesContainer"><span class="post-contentType"><a href="http://defense360.wpengine.com/content-type/analysis/">Analysis</a> / </span><span class="post-categories"><a href="http://defense360.wpengine.com/category/acquisition/" rel="category tag">Acquisition</a></span></div><h1 class="entry-title ">Overseas Contingency Operations Contracts After Iraq</h1>			</header><!-- .entry-header -->

			<footer class="entry-footer">
								<div class="entry-meta">
					<span class="posted-on"><a href="http://defense360.wpengine.com/oco-contracts-after-iraq/" rel="bookmark"><time class="entry-date published" datetime="2017-05-05T14:40:48+00:00">May 5, 2017</time></a> — </span><a href="http://defense360.wpengine.com/author/andrew-hunter/" title="Posts by Andrew Hunter" class="author url fn" rel="author">Andrew Hunter</a>				</div><!-- .entry-meta -->
							</footer><!-- .entry-footer -->
		</div>
	</div>
</article><!-- #post-## -->
<article id="post-258" class="post-258 post type-post status-publish format-standard has-post-thumbnail hentry category-acquisition category-budget tag-contracts content-type-analysis">
	<div class="row">
		<div class="post-thumbnail col-xs-12 col-md-3">
			<div class="post-thumbnailContainer">
				<img width="300" height="152" src="http://defense360.wpengine.com/wp-content/uploads/2016/03/141116-N-PO203-042-1-300x152.jpg" class="attachment-medium size-medium wp-post-image" alt="" srcset="http://defense360.wpengine.com/wp-content/uploads/2016/03/141116-N-PO203-042-1-300x152.jpg 300w, http://defense360.wpengine.com/wp-content/uploads/2016/03/141116-N-PO203-042-1-768x389.jpg 768w, http://defense360.wpengine.com/wp-content/uploads/2016/03/141116-N-PO203-042-1-1024x519.jpg 1024w" sizes="(max-width: 300px) 100vw, 300px">			</div>
		</div>
		<div class="post-content col-xs-12 col-md-9">
			<header class="entry-header">
				<div class="post-contentCategoriesContainer"><span class="post-contentType"><a href="http://defense360.wpengine.com/content-type/analysis/">Analysis</a> / </span><span class="post-categories"><a href="http://defense360.wpengine.com/category/acquisition/" rel="category tag">Acquisition</a>, <a href="http://defense360.wpengine.com/category/budget/" rel="category tag">Budget</a></span></div><h1 class="entry-title ">Defense “Seed Corn” R&amp;D Preserved in 2015</h1>			</header><!-- .entry-header -->

			<footer class="entry-footer">
								<div class="entry-meta">
					<span class="posted-on"><a href="http://defense360.wpengine.com/defense-seed-corn-rd-continues-preserved-2015-trough-weapons-systems-development-continues/" rel="bookmark"><time class="entry-date published" datetime="2016-03-28T07:30:57+00:00">March 28, 2016</time></a> — </span><a href="http://defense360.wpengine.com/author/jellmancsis-org/" title="Posts by JEllman@csis.org" class="author url fn" rel="author">JEllman@csis.org</a>				</div><!-- .entry-meta -->
							</footer><!-- .entry-footer -->
		</div>
	</div>
</article><!-- #post-## --><div class="post-relatedPost"></div></div>
			</footer><!-- .entry-footer -->
		</article><!-- #post-## -->
	</main><!-- #main -->
</div><!-- #primary -->
<?php get_footer(); 