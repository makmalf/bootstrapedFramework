<?php
/**
 * @package aegis
 */
global $redux_demo;
?>

<?php if($redux_demo['blog_layout'] == '2') {
	include(dirname( __FILE__ ) . '/layouts/blog-timeline.php');
} else {
	include(dirname( __FILE__ ) . '/layouts/blog-grid.php');
} ?>