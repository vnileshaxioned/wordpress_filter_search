<?php

  // for classic editor
  add_filter('use_block_editor_for_post', '__return_false');

  // enqueue the style and script files
  add_action('wp_enqueue_scripts', 'test_theme_script');
  function test_theme_script() {
    wp_enqueue_style('custom-styling', get_stylesheet_uri());
    wp_enqueue_style('custom-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_script('custom-script', get_template_directory_uri().'/assets/js/script.js', array('jquery'), null, true);
    wp_localize_script( 'custom-script', 'ajax', array('ajaxurl' => admin_url( 'admin-ajax.php' )));
  }

  // pagination function
  add_action("wp_ajax_pagination", "pagination");
  add_action("wp_ajax_nopriv_pagination", "pagination");
  function pagination() {
    $offset = $_POST['offset'];
    $post_per_page = $_POST['post_per_page'];

    $args = array(
      'post_type' => 'car',
      'orderby' => 'title',
      'order' =>'ASC',
      'post_status' => 'publish',
      'offset' => $offset,
      'posts_per_page' => $post_per_page
    );
    // var_dump($args);
    $query = new WP_Query( $args );
    $total_posts = $query->found_posts;
    if ($query -> have_posts()) {
      $args = array('query' => $query);
      get_template_part('template-parts/modules/filter/content', 'display-filter', $args);
    }
    die();
  }

  // filter and search function
  add_action("wp_ajax_filter_search", "filter_search");
  add_action("wp_ajax_nopriv_filter_search", "filter_search");
  function filter_search() {
    $post_per_page = $_POST['post_per_page'];
    $tag_name = $_POST['tag_name'];
    $tag_slug = $_POST['tag_slug'];
    $search = $_POST['search'];

    // all post query
    $args = array(
      'post_type' => 'car',
      'orderby' => 'title',
      'order' =>'ASC',
      'post_status' => 'publish',
      'posts_per_page' => $post_per_page,
    );
    
    // taxonomy query
    if ($tag_slug) {
      if (count($tag_name) > 1) {
        $tax_array = array(
          'relation' => 'OR',
        );
        foreach ($tag_name as $taxonomy) {
          $output = array(
            'taxonomy' => $taxonomy,
            'field' => 'slug',
            'terms' => $tag_slug
          );
          array_push($tax_array, $output);
        }

        $args['tax_query'] = $tax_array;
      } else {
        $args['tax_query'] = array(
          array(
            'taxonomy' => $tag_name[0],
            'field' => 'slug',
            'terms' => $tag_slug
          )
        );
      }
    }

    // search query
    if ($search) {
      $terms = get_terms(array(
        'name__like' => $search,
        'field' => 'id'
      ));

      $tax_array = array(
        'relation' => 'OR',
      );
      foreach ($terms as $term) {
        $output = array(
          'taxonomy' => $term->taxonomy,
          'field' => 'slug',
          'terms' => $term->slug
        );
        array_push($tax_array, $output);
      }
      $args['tax_query'] = $tax_array;
    }
    
    $query = new WP_Query($args);

    if ($query->have_posts()) {
      $args = array('query' => $query);
      get_template_part('template-parts/modules/filter/content', 'display-filter', $args);
    }
    die();
  }

  // theme support
  add_action('after_setup_theme', 'custom_theme_setup');
  function custom_theme_setup() {
    register_nav_menus( array(
      'primary' => __('Primary Menu', 'customtheme'),
      'secondary' => __('Secondary Menu', 'customtheme')
    ) );
  }

  //custom menu structure
  function custom_menu($location_name) {
    if (($locations = get_nav_menu_locations()) && $locations[$location_name]) {
      $menu_id = get_nav_menu_locations()[$location_name];
      $menu_items = wp_get_nav_menu_items($menu_id);

      $menu_list = '<nav class="navbar-'.$location_name.'">';
      $menu_list .= '<ul class="menu">';
      foreach ($menu_items as $menu_item) {
        $title = $menu_item->title;
        $url = $menu_item->url;
        $menu_list .= '<li class="menu-list">';
        $menu_list .= '<a href="'.$url.'" class="menu-item" title="'.$title.'">'.$title.'</a>';
        $menu_list .= '</li>';
      }
      $menu_list .= '</ul>';
      $menu_list .= '</nav>';
    }
    echo $menu_list;
  }

  // custom post type
  add_action( 'init', function() {
    custom_post_type('car', 'dashicons-car');
  });
  function custom_post_type($cpt, $icon = '') {
    $capitalize_cpt = ucfirst($cpt);
    $labels = array(
      'name'                => _x( $capitalize_cpt.'s', 'Post Type General Name', 'customtheme' ),
      'singular_name'       => _x( $cpt, 'Post Type Singular Name', 'customtheme' ),
      'menu_name'           => __( $capitalize_cpt.'s', 'customtheme' ),
      'all_items'           => __( 'All '.$capitalize_cpt.'s', 'customtheme' ),
      'add_new'             => __( 'Add New', 'customtheme' ),
      'edit_item'           => __( 'Edit '.$capitalize_cpt, 'customtheme' ),
      'update_item'         => __( 'Update '.$capitalize_cpt, 'customtheme' ),
      'search_items'        => __( 'Search '.$capitalize_cpt.'s', 'customtheme' ),
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
      'name' => _x( $capitalize_tax_name.'s', 'taxonomy general name' ),
      'singular_name'     => _x( $capitalize_tax_name, 'taxonomy singular name' ),
      'search_items'      =>  __( 'Search '.$capitalize_tax_name.'s' ),
      'all_items'         => __( 'All '.$capitalize_tax_name.'s' ),
      'parent_item'       => __( 'Parent '.$capitalize_tax_name ),
      'parent_item_colon' => __( 'Parent '.$capitalize_tax_name ),
      'edit_item'         => __( 'Edit '.$capitalize_tax_name ),
      'update_item'       => __( 'Update '.$capitalize_tax_name ),
      'add_new_item'      => __( 'Add New '.$capitalize_tax_name ),
      'new_item_name'     => __( 'New '.$capitalize_tax_name ),
      'not_found'         => __( 'No '.$tax_name.'s found' ),
      'menu_name'         => __( $capitalize_tax_name.'s' ),
    );
    register_taxonomy( $tax_name, array($cpt), array(
      'hierarchical'      => true,
      'labels'            => $labels,
      'show_ui'           => true,
      'show_in_rest'      => true,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite'           => array( 'slug' => $tax_name ),
    ));
  }

  // taxonomy name function to display in car detail
  function taxonomyName($taxonomy_name) {
    if ($taxonomy_name) {
    $result = '<ul class="taxonomy-column">';
      foreach ($taxonomy_name as $tax_name) {
        $name = $tax_name->name;
        $taxonomy = $tax_name->taxonomy;
        $result .= '<li class="table-list list-'.$taxonomy.'" data-tax-name="'.$taxonomy.'">';
        $result .= '<span class="taxonomy-name">'.$name.'</span>';
        $result .= '</li>';
      }
    $result .= '</ul>';
    echo $result;
    }
  }

  // filter taxonomy name by asc and desc order
  function taxonomySorting($taxonomy_name) {
      if ($taxonomy_name) {
        $result = '<div class="column">';
        $result .= '<span class="taxonomy-name">'.ucfirst($taxonomy_name).'</span>';
        $result .= '<select name="sort" class="sorting-'.$taxonomy_name.'" data-taxonomy="'.$taxonomy_name.'">';
        $result .= '<option value="none">Sort by</option>';
        $result .= '<option value="asc">ASC</option>';
        $result .= '<option value="desc">DESC</option>';
        $result .= '</select>';
        $result .= '</div>';
      }

    echo $result;
  }
?>