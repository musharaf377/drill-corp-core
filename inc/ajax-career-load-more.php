<?php

/**
 * AJAX Handler for Career Load More
 * @package Drill-corp
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

// AJAX handlers for logged in and non-logged in users
add_action('wp_ajax_load_more_career_posts', 'drillcorp_core_load_more_career_posts');
add_action('wp_ajax_nopriv_load_more_career_posts', 'drillcorp_core_load_more_career_posts');

/**
 * Load more career posts via AJAX
 */
function drillcorp_core_load_more_career_posts() {
    // Verify nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'career_load_more_nonce')) {
        wp_send_json_error(['message' => 'Security check failed']);
    }

    // Sanitize and validate inputs
    $page = isset($_POST['page']) ? absint($_POST['page']) : 1;
    $posts_per_page = isset($_POST['posts_per_page']) ? absint($_POST['posts_per_page']) : 10;
    $orderby = isset($_POST['orderby']) ? sanitize_text_field($_POST['orderby']) : 'date';
    $order = isset($_POST['order']) ? sanitize_text_field($_POST['order']) : 'DESC';
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : 'all';

    // Build query arguments
    $args = [
        'post_type'      => 'career',
        'posts_per_page' => $posts_per_page,
        'paged'          => $page,
        'orderby'        => $orderby,
        'order'          => $order,
        'post_status'    => 'publish',
    ];

    // Add category filter if not 'all'
    if ($category !== 'all' && is_numeric($category)) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'career_cat',
                'field'    => 'term_id',
                'terms'    => absint($category),
            ],
        ];
    }

    $query = new WP_Query($args);
    $html = '';

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();

            // Get career meta
            $career_meta = get_post_meta($post_id, 'drillcorp_career_options', true);
            $designation = isset($career_meta['career_designation']) ? $career_meta['career_designation'] : '';
            $location = isset($career_meta['career_location']) ? $career_meta['career_location'] : '';

            // Get categories
            $career_cats = wp_get_post_terms($post_id, 'career_cat', ['fields' => 'all']);
            $category_html = '';
            if (!empty($career_cats) && !is_wp_error($career_cats)) {
                $category_html = '<div class="career-list-item-cats">';
                $category_html .= '<div class="career-list-item-cat-dot"></div>';
                foreach ($career_cats as $cat) {
                    $category_html .= '<a href="' . esc_url(get_term_link($cat)) . '">' . esc_html($cat->name) . '</a>';
                }
                $category_html .= '</div>';
            }

            // Get post categories IDs for data attribute
            $post_cat_ids = wp_get_post_terms($post_id, 'career_cat', ['fields' => 'ids']);
            $cat_ids_string = implode(',', $post_cat_ids);

            // Build the post HTML
            $html .= '<article class="career-list-item" data-categories="' . esc_attr($cat_ids_string) . '">';

            if (has_post_thumbnail()) {
                $html .= '<a class="career-list-item-thumb" href="' . esc_url(get_permalink()) . '">';
                $html .= get_the_post_thumbnail($post_id, 'large');
                $html .= '</a>';
            }

            $html .= '<div class="career-list-item-content">';
            $html .= $category_html;
            $html .= '<h3 class="career-list-item-title">';
            $html .= '<a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a>';
            $html .= '</h3>';

            $html .= '<div class="career-list-item-meta">';

            if ($designation) {
                $html .= '<div class="career-meta-item">';
                $html .= '<img src="' . esc_url(get_template_directory_uri() . '/assets/img/designation.svg') . '" class="career-meta-icon">';
                $html .= '<span class="career-meta-value">' . esc_html($designation) . '</span>';
                $html .= '</div>';
            }

            if ($location) {
                $html .= '<div class="career-meta-item">';
                $html .= '<img src="' . esc_url(get_template_directory_uri() . '/assets/img/map.svg') . '" class="career-meta-icon">';
                $html .= '<span class="career-meta-value">' . esc_html($location) . '</span>';
                $html .= '</div>';
            }

            $html .= '</div>'; // .career-list-item-meta
            $html .= '</div>'; // .career-list-item-content
            $html .= '</article>';
        }

        wp_reset_postdata();

        // Check if there are more posts
        $has_more = ($page < $query->max_num_pages);

        wp_send_json_success([
            'html'    => $html,
            'hasMore' => $has_more,
            'page'    => $page + 1,
            'total'   => $query->found_posts,
            'maxPages' => $query->max_num_pages
        ]);
    } else {
        wp_send_json_success([
            'html'    => '',
            'hasMore' => false,
            'page'    => $page,
        ]);
    }
}
