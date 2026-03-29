<?php

return array(
    [
        'post_type' => 'case_study',
        'args' => array(
            'label' => esc_html__('Case Study', 'drilllcorp-core'),
            'description' => esc_html__('Case Study', 'drilllcorp-core'),
            'labels' => array(
                'name' => esc_html_x('Case Study', 'Post Type General Name', 'drilllcorp-core'),
                'singular_name' => esc_html_x('Case Study', 'Post Type Singular Name', 'drilllcorp-core'),
                'menu_name' => esc_html__('Case Study', 'drilllcorp-core'),
                'all_items' => esc_html__('Case Study', 'drilllcorp-core'),
                'view_item' => esc_html__('View Case Study', 'drilllcorp-core'),
                'add_new_item' => esc_html__('Add New Case Study', 'drilllcorp-core'),
                'add_new' => esc_html__('Add New Case Study', 'drilllcorp-core'),
                'edit_item' => esc_html__('Edit Case Study', 'drilllcorp-core'),
                'update_item' => esc_html__('Update Case Study', 'drilllcorp-core'),
                'search_items' => esc_html__('Search Case Study', 'drilllcorp-core'),
                'not_found' => esc_html__('Not Found', 'drilllcorp-core'),
                'not_found_in_trash' => esc_html__('Not found in Trash', 'drilllcorp-core'),
                'featured_image' => esc_html__('Case Study Image', 'drilllcorp-core'),
                'remove_featured_image' => esc_html__('Remove Case Study Image', 'drilllcorp-core'),
                'set_featured_image' => esc_html__('Set Case Study Image', 'drilllcorp-core'),
            ),
            'supports' => array('title', 'thumbnail', 'excerpt', 'editor', 'comments'),
            'taxonomies' => array('post_tag'), // this is IMPORTANT
            'hierarchical' => false,
            'public' => true,
            "publicly_queryable" => true,
            'show_ui' => true,
            "rewrite" => array('slug' => 'case_study', 'with_front' => true),
            'can_export' => true,
            'capability_type' => 'post',
            "show_in_rest" => true,
            'query_var' => true
        )       
    ]
);
