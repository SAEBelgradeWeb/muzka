<?php
/**
 * muzka functions and definitions
 *
 * @package muzka
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'muzka_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function muzka_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on muzka, use a find and replace
	 * to change 'muzka' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'muzka', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'muzka' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'muzka_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // muzka_setup
add_action( 'after_setup_theme', 'muzka_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function muzka_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'muzka' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'muzka_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function muzka_scripts() {
	wp_enqueue_style( 'muzka-style', get_stylesheet_uri() );
	wp_enqueue_style( 'zgrid', get_template_directory_uri() ."/css/zerogrid.css" );
	wp_enqueue_style( 'styleg', get_template_directory_uri() ."/css/style.css" );
	wp_enqueue_style( 'responsive', get_template_directory_uri() ."/css/responsive.css" );
	wp_enqueue_style( 'rslides', get_template_directory_uri() ."/css/responsiveslides.css" );
	

	wp_enqueue_script( 'muzka-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'rslidesjs' ,get_template_directory_uri() . '/js/responsiveslides.js');

	wp_enqueue_script( 'muzka-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'muzka_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

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


// Register Custom Post Type
function custom_post_type() {
	add_theme_support( 'post-thumbnails' );	

	$labels = array(
		'name'                => _x( 'Slides', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Slide', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Slider', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Slide:', 'text_domain' ),
		'all_items'           => __( 'All Slides', 'text_domain' ),
		'view_item'           => __( 'View Slide', 'text_domain' ),
		'add_new_item'        => __( 'Add New Slide', 'text_domain' ),
		'add_new'             => __( 'New Slide', 'text_domain' ),
		'edit_item'           => __( 'Edit Slide', 'text_domain' ),
		'update_item'         => __( 'Update Slide', 'text_domain' ),
		'search_items'        => __( 'Search Slides', 'text_domain' ),
		'not_found'           => __( 'No Slides found', 'text_domain' ),
		'not_found_in_trash'  => __( 'No Slides found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'slide', 'text_domain' ),
		'description'         => __( 'Slide information pages', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail' ),
		'taxonomies'          => array( ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'slider', $args );

		$labels = array(
		'name'                => _x( 'Albums', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Album', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Albums', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Album:', 'text_domain' ),
		'all_items'           => __( 'All Albums', 'text_domain' ),
		'view_item'           => __( 'View Album', 'text_domain' ),
		'add_new_item'        => __( 'Add New Album', 'text_domain' ),
		'add_new'             => __( 'New Album', 'text_domain' ),
		'edit_item'           => __( 'Edit Album', 'text_domain' ),
		'update_item'         => __( 'Update Album', 'text_domain' ),
		'search_items'        => __( 'Search Albums', 'text_domain' ),
		'not_found'           => __( 'No Albums found', 'text_domain' ),
		'not_found_in_trash'  => __( 'No Albums found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'album', 'text_domain' ),
		'description'         => __( 'Album information pages', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail' ),
		'taxonomies'          => array( ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'albums', $args );

		$labels = array(
		'name'                => _x( 'Events', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Event', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Events', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Event:', 'text_domain' ),
		'all_items'           => __( 'All Events', 'text_domain' ),
		'view_item'           => __( 'View Event', 'text_domain' ),
		'add_new_item'        => __( 'Add New Event', 'text_domain' ),
		'add_new'             => __( 'New Event', 'text_domain' ),
		'edit_item'           => __( 'Edit Event', 'text_domain' ),
		'update_item'         => __( 'Update Event', 'text_domain' ),
		'search_items'        => __( 'Search Events', 'text_domain' ),
		'not_found'           => __( 'No Events found', 'text_domain' ),
		'not_found_in_trash'  => __( 'No Events found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'event', 'text_domain' ),
		'description'         => __( 'Event information pages', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail' ),
		'taxonomies'          => array( ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'events', $args );

	add_image_size('front_thumb', 182, 110, true );
	   /**
		* Creates a sidebar
		* @param string|array  Builds Sidebar based off of 'name' and 'id' values.
		*/
		$args = array(
			'name'          => __( 'Footer Widgets', 'muzka' ),
			'id'            => 'footer_side',
			'description'   => '',
			'class'         => '',
			'before_widget' => '<div class="col-1-4">
				<div class="wrap-col">
					<div class="box">',
			'after_widget'  => '</div>
					</div>
				</div>',
			'before_title'  => '<div class="heading"><h2>',
			'after_title'   => '</h2></div>'
		);
	
		register_sidebar( $args );
	

}

// Hook into the 'init' action
add_action( 'init', 'custom_post_type', 0 );

function custom_excerpt_length( $length ) {
	global $post;
	
	$terms = wp_get_post_terms($post->ID, 'category' );
	$kategorija =  $terms[0]->slug;
	if($kategorija == 'featured') {
		return 10;
	} else {
		return 15;
	}
	
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more( $more ) {
	global $post;
	
	$terms = wp_get_post_terms($post->ID, 'category' );
	$kategorija =  $terms[0]->slug;
	if($kategorija == 'featured') {
		return '';
	} else {
		return '[...]';
	}
	
}
add_filter('excerpt_more', 'new_excerpt_more');


// <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=belgrade&amp;aq=&amp;sll=37.0625,-95.677068&amp;sspn=52.020054,82.001953&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear=Belgrade,+City+of+Belgrade,+Serbia&amp;t=m&amp;z=11&amp;ll=44.820556,20.462222&amp;output=embed"></iframe><br /><small><a href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=belgrade&amp;aq=&amp;sll=37.0625,-95.677068&amp;sspn=52.020054,82.001953&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear=Belgrade,+City+of+Belgrade,+Serbia&amp;t=m&amp;z=11&amp;ll=44.820556,20.462222" style="color:#0000FF;text-align:left">View Larger Map</a></small>











