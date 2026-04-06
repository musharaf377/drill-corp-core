<?php

return array(
   // services Post type
    [
        'post_type' => 'services',
        'args' => array(
            'label' => esc_html__('Services', 'drillcorp-core'),
            'description' => esc_html__('Services', 'drillcorp-core'),
            'labels' => array(
                'name' => esc_html_x('Services', 'Post Type General Name', 'drillcorp-core'),
                'singular_name' => esc_html_x('Services', 'Post Type Singular Name', 'drillcorp-core'),
                'menu_name' => esc_html__('Services', 'drillcorp-core'),
                'all_items' => esc_html__('Services', 'drillcorp-core'),
                'view_item' => esc_html__('View Services', 'drillcorp-core'),
                'add_new_item' => esc_html__('Add New Services', 'drillcorp-core'),
                'add_new' => esc_html__('Add New Services', 'drillcorp-core'),
                'edit_item' => esc_html__('Edit Services', 'drillcorp-core'),
                'update_item' => esc_html__('Update Services', 'drillcorp-core'),
                'search_items' => esc_html__('Search Services', 'drillcorp-core'),
                'not_found' => esc_html__('Not Found', 'drillcorp-core'),
                'not_found_in_trash' => esc_html__('Not found in Trash', 'drillcorp-core'),
                'featured_image' => esc_html__('Services Image', 'drillcorp-core'),
                'remove_featured_image' => esc_html__('Remove Services Image', 'drillcorp-core'),
                'set_featured_image' => esc_html__('Set Services Image', 'drillcorp-core'),
            ),
            'supports' => array('title', 'thumbnail', 'excerpt', 'editor', 'comments'),
            'taxonomies' => array('post_tag'), // this is IMPORTANT
            'hierarchical' => false,
            'public' => true,
            "publicly_queryable" => true,
            'show_ui' => true,
            "rewrite" => array('slug' => 'services', 'with_front' => true),
            'can_export' => true,
            'capability_type' => 'post',
            "show_in_rest" => true,
            'query_var' => true
        )
    ],
    
    // Projects Post type
    [
        'post_type' => 'projects',
        'args' => array(
            'label' => esc_html__('Projects', 'drillcorp-core'),
            'description' => esc_html__('Projects', 'drillcorp-core'),
            'labels' => array(
                'name' => esc_html_x('Projects', 'Post Type General Name', 'drillcorp-core'),
                'singular_name' => esc_html_x('Project', 'Post Type Singular Name', 'drillcorp-core'),
                'menu_name' => esc_html__('Projects', 'drillcorp-core'),
                'all_items' => esc_html__('All Projects', 'drillcorp-core'),
                'view_item' => esc_html__('View Project', 'drillcorp-core'),
                'add_new_item' => esc_html__('Add New Project', 'drillcorp-core'),
                'add_new' => esc_html__('Add New Project', 'drillcorp-core'),
                'edit_item' => esc_html__('Edit Project', 'drillcorp-core'),
                'update_item' => esc_html__('Update Project', 'drillcorp-core'),
                'search_items' => esc_html__('Search Projects', 'drillcorp-core'),
                'not_found' => esc_html__('Not Found', 'drillcorp-core'),
                'not_found_in_trash' => esc_html__('Not found in Trash', 'drillcorp-core'),
                'featured_image' => esc_html__('Project Image', 'drillcorp-core'),
                'remove_featured_image' => esc_html__('Remove Project Image', 'drillcorp-core'),
                'set_featured_image' => esc_html__('Set Project Image', 'drillcorp-core'),
            ),
            'supports' => array('title', 'thumbnail', 'excerpt', 'editor', 'comments'),
            'taxonomies' => array('post_tag'), // this is IMPORTANT
            'hierarchical' => false,
            'public' => true,
            "publicly_queryable" => true,
            'show_ui' => true,
            "rewrite" => array('slug' => 'projects', 'with_front' => true),
            'can_export' => true,
            'capability_type' => 'post',
            "show_in_rest" => true,
            'query_var' => true
        )
    ],

    // Career post type
    [
        'post_type' => 'career',
        'args' => array(
            'label' => esc_html__('Careers', 'drillcorp-core'),
            'description' => esc_html__('Careers', 'drillcorp-core'),
            'labels' => array(
                'name' => esc_html_x('Careers', 'Post Type General Name', 'drillcorp-core'),
                'singular_name' => esc_html_x('Career', 'Post Type Singular Name', 'drillcorp-core'),
                'menu_name' => esc_html__('Careers', 'drillcorp-core'),
                'all_items' => esc_html__('All Careers', 'drillcorp-core'),
                'view_item' => esc_html__('View Career', 'drillcorp-core'),
                'add_new_item' => esc_html__('Add New Career', 'drillcorp-core'),
                'add_new' => esc_html__('Add New Career', 'drillcorp-core'),
                'edit_item' => esc_html__('Edit Career', 'drillcorp-core'),
                'update_item' => esc_html__('Update Career', 'drillcorp-core'),
                'search_items' => esc_html__('Search Careers', 'drillcorp-core'),
                'not_found' => esc_html__('Not Found', 'drillcorp-core'),
                'not_found_in_trash' => esc_html__('Not found in Trash', 'drillcorp-core'),
                'featured_image' => esc_html__('Career Image', 'drillcorp-core'),
                'remove_featured_image' => esc_html__('Remove Career Image', 'drillcorp-core'),
                'set_featured_image' => esc_html__('Set Career Image', 'drillcorp-core'),
            ),
            'supports' => array('title', 'thumbnail', 'excerpt', 'editor', 'comments'),
            'taxonomies' => array('post_tag'), // this is IMPORTANT
            'hierarchical' => false,
            'public' => true,
            "publicly_queryable" => true,
            'show_ui' => true,
            "rewrite" => array('slug' => 'careers', 'with_front' => true),
            'can_export' => true,
            'capability_type' => 'post',
            "show_in_rest" => true,
            'query_var' => true
        )
    ]

);
