<?php

// enqueue the style and script files
add_action('wp_enqueue_scripts', 'test_theme_script');
function test_theme_script() {
  wp_enqueue_style('custom-styling', get_stylesheet_uri());
  wp_enqueue_style('custom-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_script('custom-script', get_template_directory_uri().'/assets/js/script.js', array('jquery'), '', true);
}

// theme support
add_action('after_setup_theme', 'custom_theme_setup');
function custom_theme_setup() {
  register_nav_menus( array(
    'primary' => __('Primary Menu', 'customtheme')
  ) );
}

// custom post type
add_action( 'init', function() { custom_post_type('car', 'dashicons-car'); });
function custom_post_type($cpt, $icon = '') {
  $capitalize_cpt = ucfirst($cpt);
  $labels = array(
    'name'                => _x( $capitalize_cpt, 'Post Type General Name', 'customtheme' ),
    'singular_name'       => _x( $cpt, 'Post Type Singular Name', 'customtheme' ),
    'menu_name'           => __( $capitalize_cpt, 'customtheme' ),
    'all_items'           => __( 'All '.$capitalize_cpt, 'customtheme' ),
    'add_new'             => __( 'Add New', 'customtheme' ),
    'edit_item'           => __( 'Edit '.$capitalize_cpt, 'customtheme' ),
    'update_item'         => __( 'Update '.$capitalize_cpt, 'customtheme' ),
    'search_items'        => __( 'Search '.$capitalize_cpt, 'customtheme' ),
    'not_found'           => __( 'Not Found', 'customtheme' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'customtheme' ),
  );
  $args = array(
    'label'               => __( $cpt, 'customtheme' ),
    'description'         => __( $cpt.' description', 'customtheme' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail' ),
    'hierarchical'        => true,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 4,
    'menu_icon'           => $icon,
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => true,
    'publicly_queryable'  => true,
    'capability_type'     => 'page',
  );
  register_post_type( $cpt, $args );
}

// custom taxonomy
add_action( 'init', function() {
  custom_taxonomy('brand', 'car');
  custom_taxonomy('tag', 'car');
});
function custom_taxonomy($tax_name, $cpt) {
  $capitalize_tax_name = ucfirst($tax_name);
  $labels = array(
    'name' => _x( $capitalize_tax_name, 'taxonomy general name' ),
    'singular_name' => _x( $capitalize_tax_name, 'taxonomy singular name' ),
    'search_items' =>  __( 'Search '.$capitalize_tax_name ),
    'all_items' => __( 'All '.$capitalize_tax_name ),
    'parent_item' => __( 'Parent '.$capitalize_tax_name ),
    'parent_item_colon' => __( 'Parent '.$capitalize_tax_name ),
    'edit_item' => __( 'Edit '.$capitalize_tax_name ),
    'update_item' => __( 'Update '.$capitalize_tax_name ),
    'add_new_item' => __( 'Add New '.$capitalize_tax_name ),
    'new_item_name' => __( 'New '.$capitalize_tax_name ),
    'menu_name' => __( $capitalize_tax_name ),
  );
  register_taxonomy( $tax_name, array($cpt), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => $tax_name ),
  ));
}

// for classic editor
add_filter('use_block_editor_for_post', '__return_false');

?>