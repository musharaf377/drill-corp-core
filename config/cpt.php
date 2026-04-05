<?php

return array(
   // services Post type
    [
        'post_type' => 'services',
        'args' => array(
            'label' => esc_html__('Services', 'drilllcorp-core'),
            'description' => esc_html__('Services', 'drilllcorp-core'),
            'labels' => array(
                'name' => esc_html_x('Services', 'Post Type General Name', 'drilllcorp-core'),
                'singular_name' => esc_html_x('Services', 'Post Type Singular Name', 'drilllcorp-core'),
                'menu_name' => esc_html__('Services', 'drilllcorp-core'),
                'all_items' => esc_html__('Services', 'drilllcorp-core'),
                'view_item' => esc_html__('View Services', 'drilllcorp-core'),
                'add_new_item' => esc_html__('Add New Services', 'drilllcorp-core'),
                'add_new' => esc_html__('Add New Services', 'drilllcorp-core'),
                'edit_item' => esc_html__('Edit Services', 'drilllcorp-core'),
                'update_item' => esc_html__('Update Services', 'drilllcorp-core'),
                'search_items' => esc_html__('Search Services', 'drilllcorp-core'),
                'not_found' => esc_html__('Not Found', 'drilllcorp-core'),
                'not_found_in_trash' => esc_html__('Not found in Trash', 'drilllcorp-core'),
                'featured_image' => esc_html__('Services Image', 'drilllcorp-core'),
                'remove_featured_image' => esc_html__('Remove Services Image', 'drilllcorp-core'),
                'set_featured_image' => esc_html__('Set Services Image', 'drilllcorp-core'),
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
            'label' => esc_html__('Projects', 'drilllcorp-core'),
            'description' => esc_html__('Projects', 'drilllcorp-core'),
            'labels' => array(
                'name' => esc_html_x('Projects', 'Post Type General Name', 'drilllcorp-core'),
                'singular_name' => esc_html_x('Project', 'Post Type Singular Name', 'drilllcorp-core'),
                'menu_name' => esc_html__('Projects', 'drilllcorp-core'),
                'all_items' => esc_html__('All Projects', 'drilllcorp-core'),
                'view_item' => esc_html__('View Project', 'drilllcorp-core'),
                'add_new_item' => esc_html__('Add New Project', 'drilllcorp-core'),
                'add_new' => esc_html__('Add New Project', 'drilllcorp-core'),
                'edit_item' => esc_html__('Edit Project', 'drilllcorp-core'),
                'update_item' => esc_html__('Update Project', 'drilllcorp-core'),
                'search_items' => esc_html__('Search Projects', 'drilllcorp-core'),
                'not_found' => esc_html__('Not Found', 'drilllcorp-core'),
                'not_found_in_trash' => esc_html__('Not found in Trash', 'drilllcorp-core'),
                'featured_image' => esc_html__('Project Image', 'drilllcorp-core'),
                'remove_featured_image' => esc_html__('Remove Project Image', 'drilllcorp-core'),
                'set_featured_image' => esc_html__('Set Project Image', 'drilllcorp-core'),
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
    ]
);
