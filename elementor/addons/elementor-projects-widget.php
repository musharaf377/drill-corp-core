<?php

/**
 * Elementor Widget
 * @package Drillcorp
 * @since 1.0.0
 */

namespace Elementor;

class Projects_Widget extends Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve Elementor widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'drillcorp-projects-widget';
    }

    /**
     * Get widget title.
     *
     * Retrieve Elementor widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title()
    {
        return esc_html__('Projects List', 'drillcorp-core');
    }

    public function get_keywords()
    {
        return ['Projects List', 'projects'];
    }

    /**
     * Get widget icon.
     *
     * Retrieve Elementor widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon()
    {
        return 'eicon-image';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the Elementor widget belongs to.
     *
     * @return array Widget categories.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_categories()
    {
        return ['drillcorp_widgets'];
    }

    /**
     * Register Elementor widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {
        $this->start_controls_section(
            'settings_section',
            [
                'label' => esc_html__('General Settings', 'drillcorp-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Posts Per Page', 'drillcorp-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 10,
                'min' => 1,
                'max' => 50,
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'drillcorp-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => 'Ascending',
                    'DESC' => 'Descending',
                ],
                'default' => 'DESC',
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order By', 'drillcorp-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'date' => 'Date',
                    'title' => 'Title',
                    'menu_order' => 'Menu Order',
                    'rand' => 'Random',
                ],
                'default' => 'date',
            ]
        );

        $this->end_controls_section();

        // Style Controls
        $this->start_controls_section(
            'list_style_section',
            [
                'label' => esc_html__('List Style', 'drillcorp-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'list_gap',
            [
                'label' => esc_html__('Gap Between Items', 'drillcorp-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .projects-list' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'list_padding',
            [
                'label' => esc_html__('List Padding', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .projects-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Card Style
        $this->start_controls_section(
            'card_style_section',
            [
                'label' => esc_html__('Card Style', 'drillcorp-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'card_min_height',
            [
                'label' => esc_html__('Min Height', 'drillcorp-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh', '%'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 800,
                        'step' => 10,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 400,
                ],
                'selectors' => [
                    '{{WRAPPER}} .project-item' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_content_gap',
            [
                'label' => esc_html__('Content Gap', 'drillcorp-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .project-content-wrap' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'card_background_color_element',
                'label' => esc_html__('Background', 'drillcorp-core'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .project-item',
            ]
        );


        $this->add_responsive_control(
            'card_padding',
            [
                'label' => esc_html__('Card Padding', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .project-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_border_radius',
            [
                'label' => esc_html__('Card Border Radius', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .project-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'card_border',
                'label' => esc_html__('Card Border', 'drillcorp-core'),
                'selector' => '{{WRAPPER}} .project-item',
            ]
        );

        $this->end_controls_section();

        // Image Style
        $this->start_controls_section(
            'image_style_section',
            [
                'label' => esc_html__('Image Style', 'drillcorp-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label' => esc_html__('Image Width', 'drillcorp-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .project-thumbnail img' => 'width: {{SIZE}}{{UNIT}}; object-fit: cover;',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'image_height',
            [
                'label' => esc_html__('Image Height', 'drillcorp-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 250,
                ],
                'selectors' => [
                    '{{WRAPPER}} .project-thumbnail img' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover;',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label' => esc_html__('Image Border Radius', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .project-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_margin',
            [
                'label' => esc_html__('Image Margin', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .project-thumbnail' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Content Style
        $this->start_controls_section(
            'content_style_section',
            [
                'label' => esc_html__('Content Style', 'drillcorp-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__('Content Padding', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .project-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'content_alignment',
            [
                'label' => esc_html__('Alignment', 'drillcorp-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'drillcorp-core'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'drillcorp-core'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'drillcorp-core'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .project-content-wrap a' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        // Title Style
        $this->add_control(
            'title_style_heading',
            [
                'label' => esc_html__('Title Style', 'drillcorp-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .project-content-wrap h3 a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'drillcorp-core'),
                'selector' => '{{WRAPPER}} .project-content-wrap h3 a',
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Title Margin', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .project-content-wrap h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Description Style
        $this->add_control(
            'description_style_heading',
            [
                'label' => esc_html__('Description Style', 'drillcorp-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Description Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#666666',
                'selectors' => [
                    '{{WRAPPER}} .project-content-wrap p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => esc_html__('Description Typography', 'drillcorp-core'),
                'selector' => '{{WRAPPER}} .project-content-wrap p',
            ]
        );

        $this->add_responsive_control(
            'description_margin',
            [
                'label' => esc_html__('Description Margin', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .project-content-wrap p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Button Style
        $this->start_controls_section(
            'button_style_section',
            [
                'label' => esc_html__('Button Style', 'drillcorp-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('button_style_tabs');

        $this->start_controls_tab(
            'button_normal',
            [
                'label' => esc_html__('Normal', 'drillcorp-core'),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => esc_html__('Text Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .project-item .primary-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => esc_html__('Background Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#0073e6',
                'selectors' => [
                    '{{WRAPPER}} .project-item .primary-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'button_border_color',
            [
                'label' => esc_html__('Border Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project-item .primary-btn' => 'border-image: linear-gradient(135deg, {{VALUE}}, {{VALUE}}) 1 stretch;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => esc_html__('Typography', 'drillcorp-core'),
                'selector' => '{{WRAPPER}} .project-item .primary-btn',
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__('Padding', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .project-item .primary-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'button_hover',
            [
                'label' => esc_html__('Hover', 'drillcorp-core'),
            ]
        );

        $this->add_control(
            'button_hover_text_color',
            [
                'label' => esc_html__('Text Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .project-item .primary-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => esc_html__('Background Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#005bb5',
                'selectors' => [
                    '{{WRAPPER}} .project-item .primary-btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'button_border_hover_color',
            [
                'label' => esc_html__('Border Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project-item .primary-btn:hover' => 'border-image: linear-gradient(135deg, {{VALUE}}, {{VALUE}}) 1 stretch;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /**
     * Render Elementor widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // Query projects from CPT
        $query_args = [
            'post_type' => 'projects',
            'posts_per_page' => $settings['posts_per_page'] ?? 10,
            'order' => $settings['order'] ?? 'DESC',
            'orderby' => $settings['orderby'] ?? 'date',
            'post_status' => 'publish',
        ];

        $query = new \WP_Query($query_args);

        if (!$query->have_posts()) {
            return;
        }
?>
        <div class="projects-area">
            <div class="projects-list">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="project-item">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php echo esc_url(get_permalink()); ?>" class="project-thumbnail">
                                <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                            </a>
                        <?php endif; ?>
                        <div class="project-content-wrap">
                            <h3><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a></h3>
                            
                            <?php if (has_excerpt()) : ?>
                                <p><?php echo esc_html(wp_trim_words( get_the_excerpt(), 12, '...' )); ?></p>
                            <?php else : ?>
                                <p><?php echo esc_html(wp_trim_words(get_the_content(), 12, '...' )); ?></p>
                            <?php endif; ?>
                            
                            <a class="primary-btn" href="<?php echo esc_url(get_permalink()); ?>">
                                <?php echo esc_html__('View The Project', 'drillcorp-core'); ?>
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
<?php
        wp_reset_postdata();
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new Projects_Widget());
