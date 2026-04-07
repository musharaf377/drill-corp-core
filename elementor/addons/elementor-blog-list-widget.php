<?php

/**
 * Elementor Widget
 * @package Drill-corp
 * @since 1.0.0
 */

namespace Elementor;

if (! defined('ABSPATH')) exit;

class Blog_List extends Widget_Base
{

    public function get_name()
    {
        return 'blog-list-widget';
    }

    public function get_title()
    {
        return esc_html__('Blog List', 'drillcorp-core');
    }

    public function get_keywords()
    {
        return ['blog', 'list', 'drillcorp'];
    }

    public function get_icon()
    {
        return 'eicon-post-list';
    }

    public function get_categories()
    {
        return ['drillcorp_widgets'];
    }

    protected function register_controls()
    {

        // -------------------------
        // Content / Query
        // -------------------------
        $this->start_controls_section('section_content', [
            'label' => esc_html__('Content', 'drillcorp-core'),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('posts_per_page', [
            'label'   => esc_html__('Posts Per Page', 'drillcorp-core'),
            'type'    => Controls_Manager::NUMBER,
            'min'     => 1,
            'max'     => 50,
            'default' => 10,
        ]);

        $this->add_control('orderby', [
            'label'   => esc_html__('Order By', 'drillcorp-core'),
            'type'    => Controls_Manager::SELECT,
            'default' => 'date',
            'options' => [
                'date'  => esc_html__('Date', 'drillcorp-core'),
                'title' => esc_html__('Title', 'drillcorp-core'),
                'rand'  => esc_html__('Random', 'drillcorp-core'),
            ],
        ]);

        $this->add_control('order', [
            'label'   => esc_html__('Order', 'drillcorp-core'),
            'type'    => Controls_Manager::SELECT,
            'default' => 'DESC',
            'options' => [
                'DESC' => esc_html__('Descending', 'drillcorp-core'),
                'ASC'  => esc_html__('Ascending', 'drillcorp-core'),
            ],
        ]);

        $this->add_control('show_category', [
            'label'        => esc_html__('Show Category', 'drillcorp-core'),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => 'yes',
        ]);

        $this->add_control('show_date', [
            'label'        => esc_html__('Show Date', 'drillcorp-core'),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => 'yes',
        ]);

        $this->add_control('show_excerpt', [
            'label'        => esc_html__('Show Excerpt', 'drillcorp-core'),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => 'yes',
        ]);

        $this->add_control('excerpt_length', [
            'label'     => esc_html__('Excerpt Length', 'drillcorp-core'),
            'type'      => Controls_Manager::NUMBER,
            'min'       => 5,
            'max'       => 60,
            'default'   => 25,
            'condition' => ['show_excerpt' => 'yes'],
        ]);

        $this->end_controls_section();

        // -------------------------
        // Style: Layout
        // -------------------------
        $this->start_controls_section('section_style_layout', [
            'label' => esc_html__('Layout', 'drillcorp-core'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control('list_gap', [
            'label' => esc_html__('Items Gap', 'drillcorp-core'),
            'type'  => Controls_Manager::SLIDER,
            'range' => ['px' => ['min' => 0, 'max' => 60]],
            'default' => ['size' => 20],
            'selectors' => [
                '{{WRAPPER}} .blog-list' => 'gap: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('list_padding', [
            'label'      => esc_html__('Padding', 'drillcorp-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors'  => [
                '{{WRAPPER}} .blog-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();

        // -------------------------
        // Style: Content Padding
        // -------------------------
        $this->start_controls_section('section_style_content_padding', [
            'label' => esc_html__('Content Padding', 'drillcorp-core'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control('content_padding', [
            'label'      => esc_html__('Content Padding', 'drillcorp-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'default'    => ['top' => 20, 'right' => 20, 'bottom' => 20, 'left' => 20, 'unit' => 'px'],
            'selectors'  => [
                '{{WRAPPER}} .blog-list-item-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();

        // -------------------------
        // Style: Card
        // -------------------------
        $this->start_controls_section('section_style_card', [
            'label' => esc_html__('Card Style', 'drillcorp-core'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'card_background',
                'label' => esc_html__('Background', 'drillcorp-core'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .blog-list-item',
            ]
        );

        $this->add_responsive_control('card_padding', [
            'label'      => esc_html__('Card Padding', 'drillcorp-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'default'    => ['top' => 20, 'right' => 20, 'bottom' => 20, 'left' => 20, 'unit' => 'px'],
            'selectors'  => [
                '{{WRAPPER}} .blog-list-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('card_border_radius', [
            'label'      => esc_html__('Border Radius', 'drillcorp-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors'  => [
                '{{WRAPPER}} .blog-list-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Border::get_type(), [
            'name'     => 'card_border',
            'label'    => esc_html__('Border', 'drillcorp-core'),
            'selector' => '{{WRAPPER}} .blog-list-item',
        ]);

        $this->end_controls_section();

        // -------------------------
        // Style: Image
        // -------------------------
        $this->start_controls_section('section_style_image', [
            'label' => esc_html__('Image Style', 'drillcorp-core'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control('image_width', [
            'label'      => esc_html__('Image Width', 'drillcorp-core'),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range'      => [
                'px' => ['min' => 50, 'max' => 600],
                '%'  => ['min' => 10, 'max' => 100],
            ],
            'selectors'  => [
                '{{WRAPPER}} .blog-list-item-thumb img' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('image_height', [
            'label'      => esc_html__('Image Height', 'drillcorp-core'),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range'      => [
                'px' => ['min' => 50, 'max' => 600],
                '%'  => ['min' => 10, 'max' => 100],
            ],
            'selectors'  => [
                '{{WRAPPER}} .blog-list-item-thumb img' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('image_margin', [
            'label'      => esc_html__('Image Margin', 'drillcorp-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors'  => [
                '{{WRAPPER}} .blog-list-item-thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();

        // -------------------------
        // Style: Title
        // -------------------------
        $this->start_controls_section('section_style_title', [
            'label' => esc_html__('Title Style', 'drillcorp-core'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('title_color', [
            'label' => esc_html__('Title Color', 'drillcorp-core'),
            'type'  => Controls_Manager::COLOR,
            'default' => '#333333',
            'selectors' => [
                '{{WRAPPER}} .blog-list-item-title a' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control('title_hover_color', [
            'label' => esc_html__('Title Hover Color', 'drillcorp-core'),
            'type'  => Controls_Manager::COLOR,
            'default' => '#0073e6',
            'selectors' => [
                '{{WRAPPER}} .blog-list-item-title a:hover' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'title_typography',
            'label'    => esc_html__('Title Typography', 'drillcorp-core'),
            'selector' => '{{WRAPPER}} .blog-list-item-title a',
        ]);

        $this->add_responsive_control('title_margin', [
            'label'      => esc_html__('Title Margin', 'drillcorp-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors'  => [
                '{{WRAPPER}} .blog-list-item-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();

        // -------------------------
        // Style: Category
        // -------------------------
        $this->start_controls_section('section_style_category', [
            'label' => esc_html__('Category Style', 'drillcorp-core'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('category_color', [
            'label' => esc_html__('Category Color', 'drillcorp-core'),
            'type'  => Controls_Manager::COLOR,
            'default' => '#4422EA',
            'selectors' => [
                '{{WRAPPER}} .blog-list-item-cats a' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control('category_bg_color', [
            'label' => esc_html__('Category Background Color', 'drillcorp-core'),
            'type'  => Controls_Manager::COLOR,
            'default' => '#E2EFF4',
            'selectors' => [
                '{{WRAPPER}} .blog-list-item-cats' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->add_control('category_dot_color', [
            'label' => esc_html__('Category Dot Color', 'drillcorp-core'),
            'type'  => Controls_Manager::COLOR,
            'default' => '#4422EA',
            'selectors' => [
                '{{WRAPPER}} .blog-list-item-cat-dot' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'category_typography',
            'label'    => esc_html__('Category Typography', 'drillcorp-core'),
            'selector' => '{{WRAPPER}} .blog-list-item-cats a',
        ]);

        $this->add_responsive_control('category_padding', [
            'label'      => esc_html__('Category Padding', 'drillcorp-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'default'    => ['top' => 12, 'right' => 12, 'bottom' => 12, 'left' => 12, 'unit' => 'px'],
            'selectors'  => [
                '{{WRAPPER}} .blog-list-item-cats' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('category_margin', [
            'label'      => esc_html__('Category Margin', 'drillcorp-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors'  => [
                '{{WRAPPER}} .blog-list-item-cats' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();

        // -------------------------
        // Style: Date & Read Time
        // -------------------------
        $this->start_controls_section('section_style_date', [
            'label' => esc_html__('Date & Read Time Style', 'drillcorp-core'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('date_color', [
            'label' => esc_html__('Date & Read Time Color', 'drillcorp-core'),
            'type'  => Controls_Manager::COLOR,
            'default' => '#666666',
            'selectors' => [
                '{{WRAPPER}} .blog-list-item-date' => 'color: {{VALUE}};',
                '{{WRAPPER}} .blog-read-time' => 'color: {{VALUE}};',
                '{{WRAPPER}} .blog-list-meta-dot' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'date_typography',
            'label'    => esc_html__('Date & Read Time Typography', 'drillcorp-core'),
            'selector' => '{{WRAPPER}} .blog-list-item-date, {{WRAPPER}} .blog-read-time',
        ]);

        $this->add_responsive_control('date_margin', [
            'label'      => esc_html__('Date & Read Time Margin', 'drillcorp-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors'  => [
                '{{WRAPPER}} .blog-list-item-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();

        // -------------------------
        // Style: Excerpt
        // -------------------------
        $this->start_controls_section('section_style_excerpt', [
            'label' => esc_html__('Excerpt Style', 'drillcorp-core'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('excerpt_color', [
            'label' => esc_html__('Excerpt Color', 'drillcorp-core'),
            'type'  => Controls_Manager::COLOR,
            'default' => '#666666',
            'selectors' => [
                '{{WRAPPER}} .blog-list-item-excerpt' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'excerpt_typography',
            'label'    => esc_html__('Excerpt Typography', 'drillcorp-core'),
            'selector' => '{{WRAPPER}} .blog-list-item-excerpt',
        ]);

        $this->add_responsive_control('excerpt_margin', [
            'label'      => esc_html__('Excerpt Margin', 'drillcorp-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors'  => [
                '{{WRAPPER}} .blog-list-item-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $args = [
            'post_type'           => 'post',
            'posts_per_page'      => (int) ($settings['posts_per_page'] ?? 10),
            'orderby'             => $settings['orderby'] ?? 'date',
            'order'               => $settings['order'] ?? 'DESC',
            'post_status'         => 'publish',
        ];

        $query = new \WP_Query($args);

        if (! $query->have_posts()) {
            echo '<p>' . esc_html__('No blog posts found.', 'drillcorp-core') . '</p>';
            return;
        }
?>
        <div class="blog-list">
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <article class="blog-list-item">
                    <?php if (has_post_thumbnail()) : ?>
                        <a class="blog-list-item-thumb" href="<?php echo esc_url(get_permalink()); ?>">
                            <?php the_post_thumbnail('large'); ?>
                        </a>
                    <?php endif; ?>

                    <div class="blog-list-item-content">
                        <?php if ($settings['show_category'] === 'yes') : ?>
                            <div class="blog-list-item-cats">
                                <div class="blog-list-item-cat-dot"></div>
                                <?php echo wp_kses_post(get_the_category_list(', ')); ?>
                            </div>
                        <?php endif; ?>

                        <h3 class="blog-list-item-title">
                            <a href="<?php echo esc_url(get_permalink()); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h3>

                        <?php if ($settings['show_date'] === 'yes' || $settings['show_excerpt'] === 'yes') : ?>
                            <div class="blog-list-item-meta">
                                <?php if ($settings['show_date'] === 'yes') : ?>
                                    <div class="blog-list-item-date">
                                        <?php echo get_the_date(); ?>
                                    </div>
                                    <div class="blog-list-meta-dot"></div>
                                    <div class="blog-read-time"><?php echo drillcorp()->get_reading_time(get_the_ID()); ?> Min Read</div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($settings['show_excerpt'] === 'yes') : ?>
                            <div class="blog-list-item-excerpt">
                                <?php echo wp_kses_post(wp_trim_words(get_the_excerpt(), $settings['excerpt_length'] ?? 25)); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
<?php
        wp_reset_postdata();
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new Blog_List());
