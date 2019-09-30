<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package defense360
 */

?>

<li id="post-<?php the_ID(); ?>" class="almanac__item">
  <?php
  the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' );
  ?>
</li><!-- #post-## -->
