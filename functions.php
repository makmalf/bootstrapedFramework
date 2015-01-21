<?php
/**
 * aegis functions and definitions
 *
 * @package aegis
 */

/**
 * Register Custom Navigation Walker
 */
require_once(dirname( __FILE__ ) . '/inc/wp_bootstrap_navwalker.php');


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'aegis_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function aegis_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on aegis, use a find and replace
	 * to change 'aegis' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'aegis', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'aegis' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'aegis_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // aegis_setup
add_action( 'after_setup_theme', 'aegis_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function aegis_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'aegis' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
			'name'          => "Woocomerce Widget",
			'id'            => 'woocommercewidget',
			'description'   => '',
			'before_widget' => '<div class="widget"><div class="widget-content">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
	));
}
add_action( 'widgets_init', 'aegis_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function aegis_scripts() {
	wp_enqueue_style( 'aegis-style', get_stylesheet_uri() );
	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css' );

	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array('jquery'), '3.3.1', true );
	wp_enqueue_script( 'aegis-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'aegis-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'aegis_scripts' );

/**
 * Register Portfolio Post Type
 */
// Register Custom Post Type
function aegis_portfolio() {

	$labels = array(
		'name'                => _x( 'Portfolio Items', 'Post Type General Name', 'aegis' ),
		'singular_name'       => _x( 'Portfolio Item', 'Post Type Singular Name', 'aegis' ),
		'menu_name'           => __( 'Portfolio', 'aegis' ),
		'parent_item_colon'   => __( 'Parent Portfolio Item:', 'aegis' ),
		'all_items'           => __( 'All Portfolio Items', 'aegis' ),
		'view_item'           => __( 'View Portfolio Item', 'aegis' ),
		'add_new_item'        => __( 'Add New Portfolio Item', 'aegis' ),
		'add_new'             => __( 'Add New', 'aegis' ),
		'edit_item'           => __( 'Edit Portfolio Item', 'aegis' ),
		'update_item'         => __( 'Update Portfolio Item', 'aegis' ),
		'search_items'        => __( 'Search Portfolio Item', 'aegis' ),
		'not_found'           => __( 'Portfolio not found ', 'aegis' ),
		'not_found_in_trash'  => __( 'Portfolio not found in Trash', 'aegis' ),
	);
	$args = array(
		'label'               => __( 'post_portfolio', 'aegis' ),
		'description'         => __( 'Post Type Description', 'aegis' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions'),
		'taxonomies'          => array( 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'post_portfolio', $args );

}

// Hook into the 'init' action
add_action( 'init', 'aegis_portfolio', 0 );

/** 
 * Register Woocommerce Support
 */
add_theme_support( 'woocommerce' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
