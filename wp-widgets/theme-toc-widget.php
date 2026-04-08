<?php
/**
 * Theme Table Of Content Widget
 * @package Drillcorp
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); //exit if access directly
}

// Create a Table Of Content Widget
CSF::createWidget('drillcorp_toc_widget', array(
    'title' => esc_html__('Drillcorp: Table Of Content', 'drillcorp-core'),
    'classname' => 'drillcorp-toc-widget',
    'description' => esc_html__('Display Table Of Content widget', 'drillcorp-core'),
));

// Front-end display of the widget
if (!function_exists('drillcorp_toc_widget')) {
    function drillcorp_toc_widget($args, $instance)
    {
        // Only display on single posts
        if (!is_single()) {
            return;
        }

        echo $args['before_widget'];
        ?>
        <div class="table-of-content-list-item">
            <div class="title wp-block-search__label">
                <?php esc_html_e('Article Content', 'drillcorp-core'); ?>
            </div>

            <!-- TOC Container -->
            <div class="toc-container">
                <!-- TOC will be dynamically generated here by main.js -->
            </div>
        </div>
        <?php
        echo $args['after_widget'];
    }
}
