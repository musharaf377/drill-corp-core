<?php

return array(
    array(
        'taxonomy' => 'services_cat',
        'object_type' => 'services',
        'args' => array(
            "labels" => array(
                "name" => esc_html__("Services Category", 'drilllcorp-core'),
                "singular_name" => esc_html__("Services Category", 'drilllcorp-core'),
                "menu_name" => esc_html__("Services Category", 'drilllcorp-core'),
                "all_items" => esc_html__("All Services Category", 'drilllcorp-core'),
                "add_new_item" => esc_html__("Add New Services Category", 'drilllcorp-core')
            ),
            "public" => true,
            "hierarchical" => true,
            "show_ui" => true,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "query_var" => true,
            "rewrite" => array('slug' => 'services_cat', 'with_front' => true),
            "show_admin_column" => true,
            "show_in_rest" => true,
            "show_in_quick_edit" => true,
        )
    ),
    // Projects Category Taxonomy
    array(
        'taxonomy' => 'projects_cat',
        'object_type' => 'projects',
        'args' => array(
            "labels" => array(
                "name" => esc_html__("Projects Category", 'drilllcorp-core'),
                "singular_name" => esc_html__("Projects Category", 'drilllcorp-core'),
                "menu_name" => esc_html__("Projects Category", 'drilllcorp-core'),
                "all_items" => esc_html__("All Projects Category", 'drilllcorp-core'),
                "add_new_item" => esc_html__("Add New Projects Category", 'drilllcorp-core')
            ),
            "public" => true,
            "hierarchical" => true,
            "show_ui" => true,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "query_var" => true,
            "rewrite" => array('slug' => 'projects_cat', 'with_front' => true),
            "show_admin_column" => true,
            "show_in_rest" => true,
            "show_in_quick_edit" => true,
        )
    ),
);

