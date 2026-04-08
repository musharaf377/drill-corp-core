<?php

/**
 * Elementor Widget
 * @package Drill-corp
 * @since 1.0.0
 */

namespace Elementor;

if (! defined('ABSPATH')) exit;

class Career_List_Tab extends Widget_Base
{

    public function get_name()
    {
        return 'career-list-tab-widget';
    }

    public function get_title()
    {
        return esc_html__('Career List Tab', 'drillcorp-core');
    }

    public function get_keywords()
    {
        return ['career', 'list', 'tab', 'drillcorp'];
    }

    public function get_icon()
    {
        return 'eicon-post-list';
    }

    public function get_categories()
    {
        return ['drillcorp_widgets', 'career_list_tab'];
    }

    private function get_career_categories()
    {
        $terms = get_terms([
            'taxonomy'   => 'career_cat',
            'hide_empty' => true,
        ]);

        $options = ['all' => esc_html__('All Media', 'drillcorp-core')];

        if (! is_wp_error($terms) && ! empty($terms)) {
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

        $this->end_controls_section();

        // -------------------------
        // Style: Tab Menu
        // -------------------------
        $this->start_controls_section('section_style_tab_menu', [
            'label' => esc_html__('Tab Menu Style', 'drillcorp-core'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control('tab_gap', [
            'label' => esc_html__('Tabs Gap', 'drillcorp-core'),
            'type'  => Controls_Manager::SLIDER,
            'range' => ['px' => ['min' => 0, 'max' => 60]],
            'default' => ['size' => 15],
            'selectors' => [
                '{{WRAPPER}} .career-list-tab-nav' => 'gap: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('tab_padding', [
            'label'      => esc_html__('Tab Padding', 'drillcorp-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors'  => [
                '{{WRAPPER}} .career-list-tab-nav-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('tab_margin', [
            'label'      => esc_html__('Tab Margin', 'drillcorp-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors'  => [
                '{{WRAPPER}} .career-list-tab-nav-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('tab_border_radius', [
            'label'      => esc_html__('Tab Border Radius', 'drillcorp-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors'  => [
                '{{WRAPPER}} .career-list-tab-nav-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Border::get_type(), [
            'name'     => 'tab_nav_border',
            'label'    => esc_html__('Nav Border', 'drillcorp-core'),
            'selector' => '{{WRAPPER}} .career-list-tab-nav',
        ]);

        $this->add_responsive_control('tab_nav_border_radius', [
            'label'      => esc_html__('Nav Border Radius', 'drillcorp-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors'  => [
                '{{WRAPPER}} .career-list-tab-nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('tab_nav_padding', [
            'label'      => esc_html__('Nav Padding', 'drillcorp-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors'  => [
                '{{WRAPPER}} .career-list-tab-nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_control('tab_style_heading', [
            'label' => esc_html__('Tab States', 'drillcorp-core'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);

        $this->start_controls_tabs('tab_style_tabs');

        // Normal State Tab
        $this->start_controls_tab('tab_normal', [
            'label' => esc_html__('Normal', 'drillcorp-core'),
        ]);

        $this->add_control('tab_normal_bg', [
            'label' => esc_html__('Background Color', 'drillcorp-core'),
            'type'  => Controls_Manager::COLOR,
            'default' => '#f5f5f5',
            'selectors' => [
                '{{WRAPPER}} .career-list-tab-nav-item' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->add_control('tab_normal_color', [
            'label' => esc_html__('Text Color', 'drillcorp-core'),
            'type'  => Controls_Manager::COLOR,
            'default' => '#333333',
            'selectors' => [
                '{{WRAPPER}} .career-list-tab-nav-item a' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'tab_typography',
            'label'    => esc_html__('Typography', 'drillcorp-core'),
            'selector' => '{{WRAPPER}} .career-list-tab-nav-item a',
        ]);

        $this->add_group_control(Group_Control_Border::get_type(), [
            'name'     => 'tab_border',
            'label'    => esc_html__('Border', 'drillcorp-core'),
            'selector' => '{{WRAPPER}} .career-list-tab-nav-item',
        ]);

        $this->end_controls_tab();

        // Hover State Tab
        $this->start_controls_tab('tab_hover', [
            'label' => esc_html__('Hover', 'drillcorp-core'),
        ]);

        $this->add_control('tab_hover_bg', [
            'label' => esc_html__('Background Color', 'drillcorp-core'),
            'type'  => Controls_Manager::COLOR,
            'default' => '#e0e0e0',
            'selectors' => [
                '{{WRAPPER}} .career-list-tab-nav-item:hover' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->add_control('tab_hover_color', [
            'label' => esc_html__('Text Color', 'drillcorp-core'),
            'type'  => Controls_Manager::COLOR,
            'default' => '#000000',
            'selectors' => [
                '{{WRAPPER}} .career-list-tab-nav-item:hover a' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Border::get_type(), [
            'name'     => 'tab_hover_border',
            'label'    => esc_html__('Border', 'drillcorp-core'),
            'selector' => '{{WRAPPER}} .career-list-tab-nav-item:hover',
        ]);

        $this->end_controls_tab();

        // Active State Tab
        $this->start_controls_tab('tab_active', [
            'label' => esc_html__('Active', 'drillcorp-core'),
        ]);

        $this->add_control('tab_active_bg', [
            'label' => esc_html__('Background Color', 'drillcorp-core'),
            'type'  => Controls_Manager::COLOR,
            'default' => '#0D1A21',
            'selectors' => [
                '{{WRAPPER}} .career-list-tab-nav-item.active' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->add_control('tab_active_color', [
            'label' => esc_html__('Text Color', 'drillcorp-core'),
            'type'  => Controls_Manager::COLOR,
            'default' => '#ffffff',
            'selectors' => [
                '{{WRAPPER}} .career-list-tab-nav-item.active a' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Border::get_type(), [
            'name'     => 'tab_active_border',
            'label'    => esc_html__('Border', 'drillcorp-core'),
            'selector' => '{{WRAPPER}} .career-list-tab-nav-item.active',
        ]);

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // -------------------------
        // Style: Card
        // -------------------------
        $this->start_controls_section('section_style_card', [
            'label' => esc_html__('Card Style', 'drillcorp-core'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control('card_gap', [
            'label' => esc_html__('Items Gap', 'drillcorp-core'),
            'type'  => Controls_Manager::SLIDER,
            'range' => ['px' => ['min' => 0, 'max' => 60]],
            'default' => ['size' => 20],
            'selectors' => [
                '{{WRAPPER}} .career-list' => 'gap: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('container_margin', [
            'label'      => esc_html__('Container Margin', 'drillcorp-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors'  => [
                '{{WRAPPER}} .career-list-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'card_background',
                'label' => esc_html__('Background', 'drillcorp-core'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .career-list-item',
            ]
        );

        $this->add_responsive_control('card_padding', [
            'label'      => esc_html__('Card Padding', 'drillcorp-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'default'    => ['top' => 20, 'right' => 20, 'bottom' => 20, 'left' => 20, 'unit' => 'px'],
            'selectors'  => [
                '{{WRAPPER}} .career-list-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('content_padding', [
            'label'      => esc_html__('Content Padding', 'drillcorp-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'default'    => ['top' => 20, 'right' => 20, 'bottom' => 20, 'left' => 20, 'unit' => 'px'],
            'selectors'  => [
                '{{WRAPPER}} .career-list-item-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('card_border_radius', [
            'label'      => esc_html__('Border Radius', 'drillcorp-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors'  => [
                '{{WRAPPER}} .career-list-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Border::get_type(), [
            'name'     => 'card_border',
            'label'    => esc_html__('Border', 'drillcorp-core'),
            'selector' => '{{WRAPPER}} .career-list-item',
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
                '{{WRAPPER}} .career-list-item-thumb img' => 'width: {{SIZE}}{{UNIT}};',
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
                '{{WRAPPER}} .career-list-item-thumb img' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('image_margin', [
            'label'      => esc_html__('Image Margin', 'drillcorp-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors'  => [
                '{{WRAPPER}} .career-list-item-thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                '{{WRAPPER}} .career-list-item-title a' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control('title_hover_color', [
            'label' => esc_html__('Title Hover Color', 'drillcorp-core'),
            'type'  => Controls_Manager::COLOR,
            'default' => '#0073e6',
            'selectors' => [
                '{{WRAPPER}} .career-list-item-title a:hover' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'title_typography',
            'label'    => esc_html__('Title Typography', 'drillcorp-core'),
            'selector' => '{{WRAPPER}} .career-list-item-title a',
        ]);

        $this->add_responsive_control('title_margin', [
            'label'      => esc_html__('Title Margin', 'drillcorp-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors'  => [
                '{{WRAPPER}} .career-list-item-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                '{{WRAPPER}} .career-list-item-cats a' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control('category_bg_color', [
            'label' => esc_html__('Category Background Color', 'drillcorp-core'),
            'type'  => Controls_Manager::COLOR,
            'default' => '#E2EFF4',
            'selectors' => [
                '{{WRAPPER}} .career-list-item-cats' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->add_control('category_dot_color', [
            'label' => esc_html__('Category Dot Color', 'drillcorp-core'),
            'type'  => Controls_Manager::COLOR,
            'default' => '#4422EA',
            'selectors' => [
                '{{WRAPPER}} .career-list-item-cat-dot' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'category_typography',
            'label'    => esc_html__('Category Typography', 'drillcorp-core'),
            'selector' => '{{WRAPPER}} .career-list-item-cats a',
        ]);

        $this->add_responsive_control('category_padding', [
            'label'      => esc_html__('Category Padding', 'drillcorp-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'default'    => ['top' => 12, 'right' => 12, 'bottom' => 12, 'left' => 12, 'unit' => 'px'],
            'selectors'  => [
                '{{WRAPPER}} .career-list-item-cats' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('category_margin', [
            'label'      => esc_html__('Category Margin', 'drillcorp-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors'  => [
                '{{WRAPPER}} .career-list-item-cats' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();

        // -------------------------
        // Style: Career Meta (Designation & Location)
        // -------------------------
        $this->start_controls_section('section_style_career_meta', [
            'label' => esc_html__('Career Meta Style', 'drillcorp-core'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('meta_label_color', [
            'label' => esc_html__('Label Color', 'drillcorp-core'),
            'type'  => Controls_Manager::COLOR,
            'default' => '#666666',
            'selectors' => [
                '{{WRAPPER}} .career-meta-label' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control('meta_value_color', [
            'label' => esc_html__('Value Color', 'drillcorp-core'),
            'type'  => Controls_Manager::COLOR,
            'default' => '#333333',
            'selectors' => [
                '{{WRAPPER}} .career-meta-value' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'meta_typography',
            'label'    => esc_html__('Typography', 'drillcorp-core'),
            'selector' => '{{WRAPPER}} .career-meta-label, {{WRAPPER}} .career-meta-value',
        ]);

        $this->add_responsive_control('meta_item_margin', [
            'label'      => esc_html__('Meta Item Margin', 'drillcorp-core'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors'  => [
                '{{WRAPPER}} .career-meta-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_control('meta_gap', [
            'label' => esc_html__('Meta Gap', 'drillcorp-core'),
            'type'  => Controls_Manager::SLIDER,
            'range' => ['px' => ['min' => 0, 'max' => 50]],
            'default' => ['size' => 10],
            'selectors' => [
                '{{WRAPPER}} .career-list-item-meta' => 'gap: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $categories = $this->get_career_categories();
        
        // Get all posts to organize by category
        $args = [
            'post_type'           => 'career',
            'posts_per_page'      => -1,
            'orderby'             => $settings['orderby'] ?? 'date',
            'order'               => $settings['order'] ?? 'DESC',
            'post_status'         => 'publish',
        ];

        $all_query = new \WP_Query($args);
        $posts_by_category = [];

        if ($all_query->have_posts()) {
            while ($all_query->have_posts()) {
                $all_query->the_post();
                $post_id = get_the_ID();
                $post_categories = wp_get_post_terms($post_id, 'career_cat', array('fields' => 'ids'));

                foreach ($post_categories as $cat_id) {
                    if (!isset($posts_by_category[$cat_id])) {
                        $posts_by_category[$cat_id] = [];
                    }
                    $posts_by_category[$cat_id][] = $post_id;
                }
            }
            wp_reset_postdata();
        }

        if (empty($categories) || $all_query->post_count === 0) {
            echo '<p>' . esc_html__('No career posts found.', 'drillcorp-core') . '</p>';
            return;
        }
        
        $unique_id = $this->get_id();
        $posts_per_page = (int) ($settings['posts_per_page'] ?? 10);
        $orderby = $settings['orderby'] ?? 'date';
        $order = $settings['order'] ?? 'DESC';
        
        // Count total posts for 'all' category
        $total_posts_all = $all_query->post_count;
        $has_more_all = ($total_posts_all > $posts_per_page);
?>
        <div class="career-list-tab-wrap" 
             data-widget-id="<?php echo esc_attr($unique_id); ?>" 
             data-posts-per-page="<?php echo esc_attr($posts_per_page); ?>"
             data-orderby="<?php echo esc_attr($orderby); ?>"
             data-order="<?php echo esc_attr($order); ?>"
             data-total-posts="<?php echo esc_attr($total_posts_all); ?>"
             data-nonce="<?php echo esc_attr(wp_create_nonce('career_load_more_nonce')); ?>">
            <div class="career-list-tab">
                <ul class="career-list-tab-nav">
                    <?php foreach ($categories as $cat_id => $cat_name) : ?>
                        <li class="career-list-tab-nav-item <?php echo ($cat_id === 'all') ? 'active' : ''; ?>" data-category="<?php echo esc_attr($cat_id); ?>">
                            <a href="#"><?php echo esc_html($cat_name); ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="career-list-container">
                <div class="career-list career-list-content-tab" data-widget-id="<?php echo esc_attr($unique_id); ?>">
                    <?php
                    // Show all posts initially
                    $show_args = [
                        'post_type'           => 'career',
                        'posts_per_page'      => $posts_per_page,
                        'orderby'             => $orderby,
                        'order'               => $order,
                        'post_status'         => 'publish',
                    ];

                    $show_query = new \WP_Query($show_args);

                    if ($show_query->have_posts()) :
                        while ($show_query->have_posts()) : $show_query->the_post();
                        
                        $career_meta = get_post_meta(get_the_ID(), 'drillcorp_career_options', true);
                        $designation = isset($career_meta['career_designation']) ? $career_meta['career_designation'] : '';
                        $location = isset($career_meta['career_location']) ? $career_meta['career_location'] : '';
                    ?>
                        <article class="career-list-item" data-categories="<?php echo esc_attr(implode(',', wp_get_post_terms(get_the_ID(), 'career_cat', ['fields' => 'ids']))); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <a class="career-list-item-thumb" href="<?php echo esc_url(get_permalink()); ?>">
                                    <?php the_post_thumbnail('large'); ?>
                                </a>
                            <?php endif; ?>

                            <div class="career-list-item-content">
                                <div class="career-list-item-cats">
                                    <?php 
                                    $career_cats = wp_get_post_terms(get_the_ID(), 'career_cat', array('fields' => 'all'));
                                    if (!empty($career_cats) && !is_wp_error($career_cats)) : 
                                        echo '<div class="career-list-item-cat-dot"></div>';
                                        foreach ($career_cats as $cat) {
                                            echo '<a href="' . esc_url(get_term_link($cat)) . '">' . esc_html($cat->name) . '</a>';
                                        }
                                    endif;
                                    ?>
                                </div>
                                <h3 class="career-list-item-title">
                                    <a href="<?php echo esc_url(get_permalink()); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>

                                <div class="career-list-item-meta">
                                    <?php if ($designation) : ?>
                                        <div class="career-meta-item">
                                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/designation.svg'); ?>" class="career-meta-icon">
                                            <span class="career-meta-value"><?php echo esc_html($designation); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if ($location) : ?>
                                        <div class="career-meta-item">
                                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/map.svg'); ?>" class="career-meta-icon">
                                            <span class="career-meta-value"><?php echo esc_html($location); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>
                    <?php
                        endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>
                </div>
                
                <?php if ($has_more_all) : ?>
                <div class="career-load-more-container">
                    <button class="career-load-more-btn" 
                            data-widget-id="<?php echo esc_attr($unique_id); ?>"
                            data-page="2"
                            data-category="all">
                        <span class="load-more-text"><?php echo esc_html__('Load More Positions', 'drillcorp-core'); ?></span>
                        <span class="load-more-spinner" style="display: none;">
                            <svg class="spinner" viewBox="0 0 50 50">
                                <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
                            </svg>
                        </span>
                    </button>
                </div>
                <?php endif; ?>
            </div>
        </div>

<?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new Career_List_Tab());
