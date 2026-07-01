<?php
/**
 * Theme Table Of Content Widget
 * @package Drillcorp
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit(); //exit if access directly
}


add_action('widgets_init', function () {
    if (!class_exists('CSF_Widget')) {
        return;
    }

    register_widget(CSF_Widget::instance('drillcorp_toc_widget', array(
        'title' => esc_html__('Drillcorp: Table Of Content', 'drillcorp-core'),
        'classname' => 'drillcorp-toc-widget',
        'description' => esc_html__('Display Table Of Content widget', 'drillcorp-core'),
        'fields' => array(
            array(
                'id'      => 'title',
                'type'    => 'text',
                'title'   => esc_html__('Widget Title', 'drillcorp-core'),
                'default' => esc_html__('Article Content', 'drillcorp-core'),
            ),
        ),
    )));
});


if (!function_exists('drillcorp_toc_process_content')) {
    function drillcorp_toc_process_content($content, $post_id)
    {
        static $cache = array();

        if (isset($cache[$post_id])) {
            return $cache[$post_id];
        }

        $headings = array();
        $used_ids = array();

        $new_content = preg_replace_callback(
            '/<h2(\s[^>]*)?>(.*?)<\/h2>/is',
            function ($matches) use (&$headings, &$used_ids) {
                $attrs = isset($matches[1]) ? $matches[1] : '';
                $inner = $matches[2];
                $text = trim(wp_strip_all_tags($inner));

                if ($text === '') {
                    return $matches[0];
                }

                $existing_id = '';
                if (preg_match('/\sid\s*=\s*["\']([^"\']+)["\']/i', $attrs, $idMatch)) {
                    $existing_id = $idMatch[1];
                }

                if ($existing_id !== '') {
                    $id = $existing_id;
                    $new_attrs = $attrs;
                } else {
                    $base = sanitize_title($text);
                    if ($base === '') {
                        $base = 'toc-heading';
                    }
                    $id = $base;
                    $i = 1;
                    while (isset($used_ids[$id])) {
                        $i++;
                        $id = $base . '-' . $i;
                    }
                    $new_attrs = ' id="' . esc_attr($id) . '"' . $attrs;
                }

                $used_ids[$id] = true;
                $headings[] = array('id' => $id, 'text' => $text);

                return '<h2' . $new_attrs . '>' . $inner . '</h2>';
            },
            $content
        );

        $cache[$post_id] = array(
            'content'  => $new_content,
            'headings' => $headings,
        );

        return $cache[$post_id];
    }
}

/**
 * Inject ids into h2 tags inside the_content so anchor links resolve.
 */
if (!function_exists('drillcorp_toc_filter_the_content')) {
    function drillcorp_toc_filter_the_content($content)
    {
        if (is_admin() || !is_singular()) {
            return $content;
        }

        // Only inject ids for the singular post being viewed, not for arbitrary
        // bits of content (e.g. other widgets) that may also pass through this filter.
        $current_id = get_the_ID();
        $queried_id = get_queried_object_id();
        if (!$current_id || !$queried_id || $current_id !== $queried_id) {
            return $content;
        }

        $processed = drillcorp_toc_process_content($content, $current_id);
        return $processed['content'];
    }
    add_filter('the_content', 'drillcorp_toc_filter_the_content', 20);
}

// Front-end display of the widget
if (!function_exists('drillcorp_toc_widget')) {
    function drillcorp_toc_widget($args, $instance)
    {
        if (!is_singular()) {
            return;
        }

        $post_id = get_the_ID();
        if (!$post_id) {
            return;
        }

        $post = get_post($post_id);
        if (!$post) {
            return;
        }

        // Run the post content through the same filter chain so any blocks/shortcodes are expanded.
        $rendered = apply_filters('the_content', $post->post_content);
        $processed = drillcorp_toc_process_content($rendered, $post_id);
        $headings = $processed['headings'];

        $widget_title = !empty($instance['title']) ? $instance['title'] : esc_html__('Article Content', 'drillcorp-core');
        $widget_title = apply_filters('widget_title', $widget_title, $instance, 'drillcorp_toc_widget');

        echo $args['before_widget'];
        ?>
        <div class="table-of-content-list-item">
            <div class="title wp-block-search__label">
                <?php echo esc_html($widget_title); ?>
            </div>

            <div class="toc-container">
                <?php if (!empty($headings)) : ?>
                    <ul class="toc-widget">
                        <?php foreach ($headings as $heading) : ?>
                            <li>
                                <a href="#<?php echo esc_attr($heading['id']); ?>" class="arrow-link">
                                    <?php echo esc_html($heading['text']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
        <?php
        echo $args['after_widget'];
    }
}
