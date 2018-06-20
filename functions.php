<?php 
function university_files() {
    wp_enqueue_script( 'bundledJS', get_theme_file_uri('./js/scripts-bundled.js'), NULL, '1.0' , true);
    wp_enqueue_style( 'Roboto', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i' );
    wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
    wp_enqueue_style( 'university_main_styles', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'university_files' );

function university_features() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'professorLandscape', 400, 260, true );
    add_image_size( 'professorPortrait', 480, 650, true );
}

add_action( 'after_setup_theme', 'university_features');

function university_post_types() {
    register_post_type( 'event', array(
        'supports' => array('title', 'editor', 'excerpt'),
        'rewrite' => array('slug' => 'events'),
        'has_archive' => true,
        'public' => true,
        'menu_icon' => 'dashicons-calendar',
        'labels' => array(
            'name' => 'Events',
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit Event',
            'all_items' => 'All Events', 
            'singular_name' => 'Event'
        )
    ) );
    // Program Post Type
    register_post_type( 'program', array(
        'supports' => array('title', 'editor'),
        'rewrite' => array('slug' => 'programs'),
        'has_archive' => true,
        'public' => true,
        'menu_icon' => 'dashicons-awards',
        'labels' => array(
            'name' => 'Programs',
            'add_new_item' => 'Add New Program',
            'edit_item' => 'Edit Program',
            'all_items' => 'All Programs', 
            'singular_name' => 'Program'
        )
    ) );
    
    // Professor Post Type
    register_post_type( 'professor', array(
        'supports' => array('title', 'editor', 'thumbnail'),
        'public' => true,
        'menu_icon' => 'dashicons-welcome-learn-more',
        'labels' => array(
            'name' => 'Professors',
            'add_new_item' => 'Add New Professor',
            'edit_item' => 'Edit Professor',
            'all_items' => 'All Professors', 
            'singular_name' => 'Professor'
        )
    ) );
}
add_action( 'init', 'university_post_types');

function university_adjust_queries($query) {
    // ajusting the program archive query
    if (!is_admin() AND is_post_type_archive( 'program' ) AND $query->main_query()) {
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
        $query->set('posts_per_page', -1);
    }
    // adjusting the even archive query
    if(!is_admin() AND is_post_type_archive( 'event' ) AND $query->is_main_query()){
        $today = date('Ymd');
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_query', array(
            array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'numeric'
            )
        ));

    }
}

add_action( 'pre_get_posts', 'university_adjust_queries' );
