<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package defense360
 */
$classes = 'row card-format';
$thumbnail_size = 3;
?>

<?php if ( is_post_type_archive( 'data' ) ) { ?>
<tr id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<td class="display-column row" colspan="5">
		<?php
		if ( has_post_thumbnail() ) {
			echo '<div class="col-xs-12 col-md-' . $thumbnail_size . ' post-thumbnail"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
			the_post_thumbnail( 'medium_large' );
			echo '</a></div>';
		}
		?>
		<div class="col-xs-12 col-md entry-main">
	        <header class="entry-header">
	            <?php
	            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
	            ?>
	            <div class="entry-meta">
	                <?php defense360_last_updated(); ?>
	                <?php defense360_entry_categories(); ?>
	                <?php defense360_entry_tags(); ?>
	            </div><!-- .entry-meta -->
	        </header><!-- .entry-header -->
	    </div>
	</td>
	<td><?php the_title(); ?></td>
	<td><?php defense360_data_last_updated(); ?></td>
	<td><?php defense360_entry_data_categories(); ?></td>
	<td><?php defense360_entry_tags(); ?></td>
</tr>
<?php } else { ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<?php
	if ( has_post_thumbnail() ) {
		echo '<div class="col-xs-12 col-md-' . $thumbnail_size . ' post-thumbnail"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
		the_post_thumbnail( 'medium_large' );
		echo '</a></div>';
	}
	?>
	<div class="col-xs-12 col-md entry-main">
        <header class="entry-header">
            <?php
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
            ?>
            <div class="entry-meta">
                <?php defense360_last_updated(); ?>
                <?php defense360_entry_categories(); ?>
                <?php defense360_entry_tags(); ?>
            </div><!-- .entry-meta -->
        </header><!-- .entry-header -->
    </div>
</article>
<?php }
