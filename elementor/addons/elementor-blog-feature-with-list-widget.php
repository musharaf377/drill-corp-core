<?php

/**
 * Elementor Widget
 * @package Musemind
 * @since 1.0.0
 */

namespace Elementor;

if (! defined('ABSPATH')) exit;

class Musemind_Blog_Feature_With_List extends Widget_Base
{

    public function get_name()
    {
        return 'musemind-blog-feature-with-list-widget';
    }

    public function get_title()
    {
        return esc_html__('Blog Feature With List', 'musemind-core');
    }

    public function get_keywords()
    {
        return ['blog', 'feature', 'musemind'];
    }

    public function get_icon()
    {
        return 'eicon-post-list';
    }

    public function get_categories()
    {
        return ['musemind_widgets'];
    }

    private function get_categories_for_control()
    {
        $terms = get_terms([
            'taxonomy'   => 'category',
            'hide_empty' => true,
        ]);

        $options = [];
        if (! is_wp_error($terms)) {
            foreach ($terms as $term) {
                $options[$term->term_id] = $term->name;
            }
        }
        return $options;
    }

    protected function register_controls()
    {

        // -------------------------
        // Content / Query
        // -------------------------
        $this->start_controls_section('section_content', [
            'label' => esc_html__('Content', 'musemind-core'),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('posts_per_page', [
            'label'   => esc_html__('Posts Per Page', 'musemind-core'),
            'type'    => Controls_Manager::NUMBER,
            'min'     => 2,
            'max'     => 20,
            'default' => 6,
        ]);

        $this->add_control('orderby', [
            'label'   => esc_html__('Order By', 'musemind-core'),
            'type'    => Controls_Manager::SELECT,
            'default' => 'date',
            'options' => [
                'date'  => esc_html__('Date', 'musemind-core'),
                'title' => esc_html__('Title', 'musemind-core'),
                'rand'  => esc_html__('Random', 'musemind-core'),
            ],
        ]);

        $this->add_control('order', [
            'label'   => esc_html__('Order', 'musemind-core'),
            'type'    => Controls_Manager::SELECT,
            'default' => 'DESC',
            'options' => [
                'DESC' => esc_html__('Descending', 'musemind-core'),
                'ASC'  => esc_html__('Ascending', 'musemind-core'),
            ],
        ]);

        $this->add_control('show_category', [
            'label'        => esc_html__('Show Category', 'musemind-core'),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => 'yes',
        ]);

        $this->add_control('excerpt_length', [
            'label'     => esc_html__('Excerpt Length', 'musemind-core'),
            'type'      => Controls_Manager::NUMBER,
            'min'       => 5,
            'max'       => 60,
            'default'   => 18,
            'condition' => ['show_excerpt' => 'yes'],
        ]);

        $this->add_control('show_list_thumb', [
            'label'        => esc_html__('Show Thumbnail (list)', 'musemind-core'),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => 'yes',
        ]);

        $this->add_control('show_date', [
            'label'        => esc_html__('Show Date (list)', 'musemind-core'),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => 'no',
        ]);

        $this->end_controls_section();

        // -------------------------
        // Style: Layout
        // -------------------------
        $this->start_controls_section('section_style_layout', [
            'label' => esc_html__('Layout', 'musemind-core'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control('columns_gap', [
            'label' => esc_html__('Columns Gap', 'musemind-core'),
            'type'  => Controls_Manager::SLIDER,
            'range' => ['px' => ['min' => 0, 'max' => 80]],
            'default' => ['size' => 24],
            'selectors' => [
                '{{WRAPPER}} .feature-blog-grid' => 'gap: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('list_gap', [
            'label' => esc_html__('List Items Gap', 'musemind-core'),
            'type'  => Controls_Manager::SLIDER,
            'range' => ['px' => ['min' => 0, 'max' => 60]],
            'default' => ['size' => 16],
            'selectors' => [
                '{{WRAPPER}} .feature-blog-list' => 'gap: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();

        // -------------------------
        // Style: Titles
        // -------------------------
        $this->start_controls_section('section_style_title', [
            'label' => esc_html__('Title', 'musemind-core'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('title_color', [
            'label' => esc_html__('Color', 'musemind-core'),
            'type'  => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .feature-blog-title a, {{WRAPPER}} .feature-blog-item-title a' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control('title_hover_color', [
            'label' => esc_html__('Hover Color', 'musemind-core'),
            'type'  => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .feature-blog-title a:hover, {{WRAPPER}} .feature-blog-item-title a:hover' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'featured_title_typography',
            'label'    => esc_html__('Featured Title Typography', 'musemind-core'),
            'selector' => '{{WRAPPER}} .feature-blog-title a',
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'list_title_typography',
            'label'    => esc_html__('List Title Typography', 'musemind-core'),
            'selector' => '{{WRAPPER}} .feature-blog-item-title a',
        ]);

        $this->add_responsive_control('featured_title_margin', [
            'label'      => esc_html__('Featured Title Margin', 'musemind-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'default'    => ['top' => 0, 'right' => 0, 'bottom' => 15, 'left' => 0, 'unit' => 'px'],
            'selectors'  => [
                '{{WRAPPER}} .feature-blog-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('featured_title_padding', [
            'label'      => esc_html__('Featured Title Padding', 'musemind-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors'  => [
                '{{WRAPPER}} .feature-blog-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('list_title_margin', [
            'label'      => esc_html__('List Title Margin', 'musemind-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'default'    => ['top' => 0, 'right' => 0, 'bottom' => 10, 'left' => 0, 'unit' => 'px'],
            'selectors'  => [
                '{{WRAPPER}} .feature-blog-item-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('list_title_padding', [
            'label'      => esc_html__('List Title Padding', 'musemind-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'selectors'  => [
                '{{WRAPPER}} .feature-blog-item-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();

        // -------------------------
        // Style: Meta + Excerpt
        // -------------------------
        $this->start_controls_section('section_style_meta', [
            'label' => esc_html__('Meta & Excerpt', 'musemind-core'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('meta_color', [
            'label' => esc_html__('Meta Color', 'musemind-core'),
            'type'  => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .feature-blog-cats, {{WRAPPER}} .feature-blog-item-date' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'meta_typography',
            'label'    => esc_html__('Meta Typography', 'musemind-core'),
            'selector' => '{{WRAPPER}} .feature-blog-cats, {{WRAPPER}} .feature-blog-item-date',
        ]);

        $this->add_control('excerpt_color', [
            'label' => esc_html__('Excerpt Color', 'musemind-core'),
            'type'  => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .feature-blog-excerpt' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'excerpt_typography',
            'label'    => esc_html__('Excerpt Typography', 'musemind-core'),
            'selector' => '{{WRAPPER}} .feature-blog-excerpt',
        ]);

        $this->end_controls_section();

        // -------------------------
        // Style: Featured Card
        // -------------------------
        $this->start_controls_section('section_featured_card_style', [
            'label' => esc_html__('Featured Card Style', 'musemind-core'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('featured_card_bg_color', [
            'label' => esc_html__('Background Color', 'musemind-core'),
            'type'  => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .feature-blog-featured' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control('featured_card_padding', [
            'label'      => esc_html__('Content Padding', 'musemind-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'default'    => ['top' => 30, 'right' => 30, 'bottom' => 30, 'left' => 30, 'unit' => 'px'],
            'selectors'  => [
                '{{WRAPPER}} .feature-blog-featured .feature-blog-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('featured_card_radius', [
            'label'      => esc_html__('Border Radius', 'musemind-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors'  => [
                '{{WRAPPER}} .feature-blog-featured' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Border::get_type(), [
            'name'     => 'featured_card_border',
            'label'    => esc_html__('Border', 'musemind-core'),
            'selector' => '{{WRAPPER}} .feature-blog-featured',
        ]);

        $this->end_controls_section();

        // -------------------------
        // Style: List Card
        // -------------------------
        $this->start_controls_section('section_list_card_style', [
            'label' => esc_html__('List Card Style', 'musemind-core'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('list_card_bg_color', [
            'label' => esc_html__('Background Color', 'musemind-core'),
            'type'  => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .feature-blog-item' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control('list_card_padding', [
            'label'      => esc_html__('Card Padding', 'musemind-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em', 'rem'],
            'default'    => ['top' => 20, 'right' => 20, 'bottom' => 20, 'left' => 20, 'unit' => 'px'],
            'selectors'  => [
                '{{WRAPPER}} .feature-blog-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('list_card_radius', [
            'label'      => esc_html__('Border Radius', 'musemind-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors'  => [
                '{{WRAPPER}} .feature-blog-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Border::get_type(), [
            'name'     => 'list_card_border',
            'label'    => esc_html__('Border', 'musemind-core'),
            'selector' => '{{WRAPPER}} .feature-blog-item',
        ]);

        $this->end_controls_section();

        // -------------------------
        // Style: Images
        // -------------------------
        $this->start_controls_section('section_style_images', [
            'label' => esc_html__('Images', 'musemind-core'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control('thumb_radius', [
            'label'      => esc_html__('Border Radius', 'musemind-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors'  => [
                '{{WRAPPER}} .feature-blog-thumb, {{WRAPPER}} .feature-blog-item-thumb img' =>
                'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();
    }



    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // Base query arguments - get ALL posts
        $args = [
            'post_type'           => 'post',
            'posts_per_page'      => (int) ($settings['posts_per_page'] ?? 6),
            'orderby'             => $settings['orderby'] ?? 'date',
            'order'               => $settings['order'] ?? 'DESC',
            'ignore_sticky_posts' => 1,
        ];

        if (! empty($settings['category'])) {
            $args['cat'] = (int) $settings['category'];
        }

        $query = new \WP_Query($args);

        if (! $query->have_posts()) {
            echo '<p>' . esc_html__('No blog posts found.', 'musemind-core') . '</p>';
            return;
        }

        // Separate featured and non-featured posts
        $featured_posts = [];
        $list_posts = [];

        while ($query->have_posts()) {
            $query->the_post();

            // Check if this post has the feature checkbox
            $meta = get_post_meta(get_the_ID(), 'drillcorp_blog_options', true);
            $is_featured = false;

            if (is_array($meta) && isset($meta['blog_feature']) && is_array($meta['blog_feature'])) {
                if (in_array('feature_blog', $meta['blog_feature'])) {
                    $is_featured = true;
                }
            }

            if ($is_featured) {
                $featured_posts[] = get_post();
            } else {
                $list_posts[] = get_post();
            }
        }

        wp_reset_postdata();

        if (empty($featured_posts) && empty($list_posts)) {
            echo '<p>' . esc_html__('No blog posts found.', 'musemind-core') . '</p>';
            return;
        }
?>
        <div class="feature-blog-wrapper">
            <div class="feature-blog-grid">
                <?php
                // Display FIRST featured post in the featured section
                if (! empty($featured_posts)) {
                    $featured_post = $featured_posts[0];
                    setup_postdata($featured_post);
                ?>
                    <article class="feature-blog-featured">
                        <?php if (has_post_thumbnail($featured_post->ID)) : ?>
                            <a class="feature-blog-thumb-link" href="<?php echo esc_url(get_permalink($featured_post->ID)); ?>">
                                <img class="feature-blog-thumb"
                                    src="<?php echo esc_url(get_the_post_thumbnail_url($featured_post->ID, 'large')); ?>"
                                    alt="<?php echo esc_attr(get_the_title($featured_post->ID)); ?>">
                            </a>
                        <?php endif; ?>

                        <div class="feature-blog-content feature-blog-card-content">
                            <?php if (! empty($settings['show_category']) && $settings['show_category'] === 'yes') : ?>
                                <div class="feature-blog-cats">
                                    <div class="feature-blog-cat-dot"></div>
                                    <?php echo wp_kses_post(get_the_category_list(' ', '', $featured_post->ID)); ?>
                                </div>
                            <?php endif; ?>

                            <h2 class="feature-blog-title">
                                <a href="<?php echo esc_url(get_permalink($featured_post->ID)); ?>">
                                    <?php echo esc_html(get_the_title($featured_post->ID)); ?>
                                </a>
                            </h2>

                            <div class="blog-meta">
                                <div class="feature-blog-date">
                                    <?php echo get_the_date('', $featured_post->ID); ?>
                                </div>
                                <div class="blog-read-time"><?php echo drillcorp()->get_reading_time($featured_post->ID); ?></div>
                            </div>
                        </div>
                    </article>
                <?php
                    wp_reset_postdata();
                }
                ?>
            </div>

            <div class="feature-blog-list">
                <?php
                // Display ALL other posts (non-featured + remaining featured posts)
                $display_posts = array_merge($list_posts, array_slice($featured_posts, 1)); // Skip first featured post

                foreach ($display_posts as $post_item) {
                    setup_postdata($post_item);
                ?>
                    <article class="feature-blog-item feature-blog-card">
                        <?php if (! empty($settings['show_list_thumb']) && $settings['show_list_thumb'] === 'yes' && has_post_thumbnail($post_item->ID)) : ?>
                            <a class="feature-blog-item-thumb" href="<?php echo esc_url(get_permalink($post_item->ID)); ?>">
                                <img src="<?php echo esc_url(get_the_post_thumbnail_url($post_item->ID, 'thumbnail')); ?>"
                                    alt="<?php echo esc_attr(get_the_title($post_item->ID)); ?>">
                            </a>
                        <?php endif; ?>

                        <div class="feature-blog-item-content feature-blog-card-content">
                            <?php if (! empty($settings['show_category']) && $settings['show_category'] === 'yes') : ?>
                                <div class="feature-blog-cats">
                                    <div class="feature-blog-cat-dot"></div>
                                    <?php echo wp_kses_post(get_the_category_list(' ', '', $post_item->ID)); ?>
                                </div>
                            <?php endif; ?>



                            <h3 class="feature-blog-item-title">
                                <a href="<?php echo esc_url(get_permalink($post_item->ID)); ?>">
                                    <?php echo esc_html(get_the_title($post_item->ID)); ?>
                                </a>
                            </h3>
                            <div class="blog-meta">
                                <?php if (! empty($settings['show_date']) && $settings['show_date'] === 'yes') : ?>
                                    <div class="feature-blog-item-date">
                                        <?php echo get_the_date('', $post_item->ID); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="blog-read-time"><?php //echo $this->render_read_time( $post_item->ID ); 
                                                            ?></div>
                            </div>
                        </div>
                    </article>
                <?php
                }


                wp_reset_postdata();
                ?>
            </div>
        </div>
<?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new Musemind_Blog_Feature_With_List());
