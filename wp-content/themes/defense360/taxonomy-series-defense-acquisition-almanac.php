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
					the_archive_title( '<h1 class="page-title">', '</h1>' );

					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
				</div>
			</header><!-- .page-header -->
      <section class="content-wrapper-narrow almanac__main">
          <h2>Acquisition Categories</h2>
          <p>Click on the name of an acquisition program below to learn more.</p>
          <div class="almanac__categories">

			<?php
      $taxonomies = array('category');
      $args = array(
        'parent' => '207',
        'hide_empty' => true
      );
      $terms = get_terms($taxonomies, $args);

      foreach( $terms as $term ): ?>
        <div class="almanac__category">
          <h3 class="almanac__category-name"><?php echo $term->name; ?></h3>
          <ul class="almanac__list">
            <?php
            while ( have_posts() ) : the_post();
              if ( has_term( $term->term_id, 'category' ) ) {
                get_template_part( 'template-parts/almanac-content' );
              }
            endwhile; 
            ?>
          </ul>
        </div>
      <?php endforeach; ?>
        </div>
    </section>
    <?php 
		else :

			get_template_part( 'template-parts/content', 'none' );

    endif;
    
    $contributors = array(
      'Todd Harrison' => 'Director, Defense Budget Analysis',
      'Seamus P. Daniels' => 'Research Associate & Program Manager, Defense Budget Analysis',
      'Madison Creery' => 'Contributor',
      'Aaron Dresslar' => 'Contributor',
      'Tobin Hansen' => 'Contributor',
      'Sheldon Ruby' => 'Contributor'
    );
    
    ?>
    <section class="content-wrapper-narrow almanac__contributors">
      <h2>Contributors</h2>
      <ul class="almanac__contributors-list">
        <?php foreach( $contributors as $contributor => $title ): ?>
        <li>
          <p class="almanac__contributors-name"><?php echo $contributor; ?></p>
          <p class="almanac__contributors-title"><?php echo $title; ?></p>
        </li>
        <?php endforeach; ?>
      </ul>
    </section>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
