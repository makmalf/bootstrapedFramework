<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package aegis
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php global $redux_demo; ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href="http://fonts.googleapis.com/css?family=<?php echo $redux_demo['opt-typography-body']['font-family']; ?>" rel="stylesheet" type="text/css">
<link rel="icon" type="image/png" href="<?php echo $iconimg;?>"/>

<?php wp_head(); ?>

<style>
	body {
		font-family: '<?php echo $redux_demo['opt-typography-body']['font-family']; ?>', sans-serif;
	}

	<?php if($redux_demo['screen_layout'] == '2') { ?>
	.container-fluid {
		max-width: 1200px;
		width: 100%;
	}
	<?php } ?>
</style>

</head>

<body <?php body_class('aegis-body'); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'aegis' ); ?></a>

	<?php 
		if($redux_demo['header_layout'] == '1') {
			include(dirname( __FILE__ ) . '/layouts/header.center.php');
		} elseif($redux_demo['header_layout'] == '3') {
			include(dirname( __FILE__ ) . '/layouts/header.header-logo.php');
		} else {
			include(dirname( __FILE__ ) . '/layouts/header.logo-header.php');
		}
	?>

	<div id="content" class="site-content">
		<div class="container-fluid">
