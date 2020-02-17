<?php
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}

register_nav_menus(
    array(
    'primary-menu' => __( 'Primary Menu' ),
    'secondary-menu' => __( 'Secondary Menu' )
    )
);


function add_menu_link_class($atts, $item, $args)
{
    $atts['class'] = 'nav-link';
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_menu_link_class', 1, 3);
?>



<?php
add_theme_support('post-thumbnails');

add_action('wp_enqueue_scripts', 'flora_enqueue_styles');

function flora_enqueue_styles()
{
    wp_enqueue_style('style-css', get_stylesheet_directory_uri() . '/style.css');
    wp_enqueue_style('font-awesome.min', get_stylesheet_directory_uri() . '/css/font-awesome.min.css');
   
   
    wp_enqueue_style('custom', get_stylesheet_directory_uri() . '/css/style.css');
    wp_enqueue_style('responsive', get_stylesheet_directory_uri() . '/css/responsive.css');
    wp_enqueue_style('bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.css');

	 
}

/* Add Jquery */

add_action('wp_enqueue_scripts', 'flora_enqueue_scripts');

function flora_enqueue_scripts()

{

    wp_enqueue_script('steller', get_stylesheet_directory_uri() . '/js/stellarnav.min.js', array(), '1.0.0', true); 
    wp_enqueue_script('typing', get_stylesheet_directory_uri() . '/js/typing-core.js', array(), '1.0.0', true);
    
    wp_enqueue_script('propper', get_stylesheet_directory_uri() . '/js/propper.js', array(), '1.0.0', true);
    wp_enqueue_script('jquery_bootstrap', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array(), '1.0.0', true);
    wp_enqueue_script('bootnavbar', get_stylesheet_directory_uri() . '/js/bootnavbar.js', array(), '1.0.0', true);
 
 
    wp_enqueue_script('jquery_custom', get_stylesheet_directory_uri() . '/js/custom.js', array(), '1.0.0', true);
	
    

}





/**
 * Disable the emoji's
 */
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param    array  $plugins  
 * @return   array             Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

// Our custom post type function
function create_posttype() {

    register_post_type( 'solutions',
        // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Solutions' ),
                'singular_name' => __( 'Solution' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'solutions'),
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );

/*
* Creating a function to create our CPT
*/

function custom_post_type() {

// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Solutions', 'Post Type General Name', 'twentythirteen' ),
        'singular_name'       => _x( 'Solution', 'Post Type Singular Name', 'twentythirteen' ),
        'menu_name'           => __( 'Solutions', 'twentythirteen' ),
        'parent_item_colon'   => __( 'Parent Solutions', 'twentythirteen' ),
        'all_items'           => __( 'All Solutions', 'twentythirteen' ),
        'view_item'           => __( 'View Solutions', 'twentythirteen' ),
        'add_new_item'        => __( 'Add New Solution', 'twentythirteen' ),
        'add_new'             => __( 'Add New', 'twentythirteen' ),
        'edit_item'           => __( 'Edit Solution', 'twentythirteen' ),
        'update_item'         => __( 'Update Solution', 'twentythirteen' ),
        'search_items'        => __( 'Search Solution', 'twentythirteen' ),
        'not_found'           => __( 'Not Found', 'twentythirteen' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentythirteen' ),
    );

// Set other options for Custom Post Type

    $args = array(
        'label'               => __( 'solutions', 'twentythirteen' ),
        'description'         => __( 'Solutions', 'twentythirteen' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', ),
        // You can associate this CPT with a taxonomy or custom taxonomy.
        'taxonomies'          => array( 'genres' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */
        'hierarchical'        => true,
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
        // 'taxonomies'          => array( 'product_category' ),
    );
    register_taxonomy('solution_category', 'solutions', array('hierarchical' => true, 'label' => 'Category', 'query_var' => true, 'rewrite' => array( 'slug' => 'solution_category' )));
    // Registering your Custom Post Type
    register_post_type( 'solutions', $args );


}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not
* unnecessarily executed.
*/

add_action( 'init', 'custom_post_type', 0 );

add_theme_support('post-thumbnails');
add_post_type_support( 'solutions', 'thumbnail' );
function create_post_type() {
    register_post_type( 'solutions',
        array(
            'labels' => array(
                'name' => __( 'Solutions' ),
                'singular_name' => __( 'Solution' )
            ),
            'public' => true,
            'has_archive' => true
        )
    );
}
add_action( 'init', 'create_post_type' );
// register taxonomy

// Our custom post type function
function create_posttype_casestudy() {

    register_post_type( 'casestudy',
        // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Casestudy' ),
                'singular_name' => __( 'Casestudy' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'casestudy'),
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );

/*
* Creating a function to create our CPT
*/

function custom_post_type_casestudy() {

// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Casestudy', 'Post Type General Name', 'twentythirteen' ),
        'singular_name'       => _x( 'Casestudy', 'Post Type Singular Name', 'twentythirteen' ),
        'menu_name'           => __( 'Casestudy', 'twentythirteen' ),
        'parent_item_colon'   => __( 'Parent Casestudy', 'twentythirteen' ),
        'all_items'           => __( 'All Casestudy', 'twentythirteen' ),
        'view_item'           => __( 'View Casestudy', 'twentythirteen' ),
        'add_new_item'        => __( 'Add New Casestudy', 'twentythirteen' ),
        'add_new'             => __( 'Add New', 'twentythirteen' ),
        'edit_item'           => __( 'Edit Casestudy', 'twentythirteen' ),
        'update_item'         => __( 'Update Casestudy', 'twentythirteen' ),
        'search_items'        => __( 'Search Casestudy', 'twentythirteen' ),
        'not_found'           => __( 'Not Found', 'twentythirteen' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentythirteen' ),
    );

// Set other options for Custom Post Type

    $args = array(
        'label'               => __( 'casestudy', 'twentythirteen' ),
        'description'         => __( 'Casestudy', 'twentythirteen' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', ),
        // You can associate this CPT with a taxonomy or custom taxonomy.
        'taxonomies'          => array( 'genres' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */
        'hierarchical'        => true,
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
        // 'taxonomies'          => array( 'product_category' ),
    );
    register_taxonomy('casestudy_category', 'casestudy', array('hierarchical' => true, 'label' => 'Category', 'query_var' => true, 'rewrite' => array( 'slug' => 'casestudy_category' )));
    // Registering your Custom Post Type
    register_post_type( 'casestudy', $args );


}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not
* unnecessarily executed.
*/

add_action( 'init', 'custom_post_type_casestudy', 0 );

add_theme_support('post-thumbnails');
add_post_type_support( 'casestudy', 'thumbnail' );
function create_post_type_casestudy() {
    register_post_type( 'casestudy',
        array(
            'labels' => array(
                'name' => __( 'Casestudy' ),
                'singular_name' => __( 'Casestudy' )
            ),
            'public' => true,
            'has_archive' => true
        )
    );
}
add_action( 'init', 'create_post_type_casestudy' );
// register taxonomy

add_filter( 'body_class', 'custom_class' );
function custom_class( $classes ) {
    if ( is_page( 'about-us' ) ) {
        $classes[] = 'inner-page about-us';
    }
    return $classes;
}

add_filter( 'body_class', 'custom_class_contact' );
function custom_class_contact( $classes ) {
    if ( is_page( 'contact-us' ) ) {
        $classes[] = 'contact-us';
    }
    return $classes;
}
