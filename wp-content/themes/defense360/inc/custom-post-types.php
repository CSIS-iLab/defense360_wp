
<?php
/**
* Custom Post Types
*
*@package defense360
*/
/*----------  Data  ----------*/
require get_template_directory() . '/inc/cpts/data.php';
/*----------  Pages  ----------*/
add_post_type_support( 'page', 'excerpt' );
