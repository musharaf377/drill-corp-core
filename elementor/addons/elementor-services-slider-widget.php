<?php

/**
 * Elementor Widget
 * @package Drillcorp
 * @since 1.0.0
 */

namespace Elementor;

class Services_Slider_Item_Widget extends Widget_Base
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
        return 'drillcorp-services-slider-widget';
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
        return esc_html__('Services Slider', 'drillcorp-core');
    }

    public function get_keywords()
    {
        return ['Services Slider', 'slider'];
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

        $this->start_controls_section(
            'slider_settings_section',
            [
                'label' => esc_html__('Slider Settings', 'drillcorp-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'items',
            [
                'label' => esc_html__('slidesToShow', 'drillcorp-core'),
                'type' => Controls_Manager::NUMBER,
                'description' => esc_html__('you can set how many item show in slider', 'drillcorp-core'),
                'default' => '3',
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => esc_html__('Loop', 'drillcorp-core'),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__('you can set yes/no to enable/disable', 'drillcorp-core'),
            ]
        );
        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__('Autoplay', 'drillcorp-core'),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__('you can set yes/no to enable/disable', 'drillcorp-core'),
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => esc_html__('Speed', 'drillcorp-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10000,
                        'step' => 500,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 3000,
                ],
            ]
        );

        $this->end_controls_section();

        // Style Controls
        $this->start_controls_section(
            'slider_style_section',
            [
                'label' => esc_html__('Slider Style', 'drillcorp-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'slider_gap',
            [
                'label' => esc_html__('Gap Between Slides', 'drillcorp-core'),
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
            ]
        );

        $this->add_responsive_control(
            'slider_padding',
            [
                'label' => esc_html__('Slider Padding', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .services-slider-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            'card_height',
            [
                'label' => esc_html__('Card Height', 'drillcorp-core'),
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
                    'size' => 300,
                ],
                'selectors' => [
                    '{{WRAPPER}} .services-slider .swiper-slide' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_content_space',
            [
                'label' => esc_html__('Content Space', 'drillcorp-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 150,
                ],
                'selectors' => [
                    '{{WRAPPER}} .services-slider-content' => 'gap: {{SIZE}}{{UNIT}}  ;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'card_background_color_element',
                'label' => esc_html__('Background', 'drillcorp-core'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .services-slider .swiper-slide',
            ]
        );
       

        $this->add_responsive_control(
            'card_padding',
            [
                'label' => esc_html__('Card Padding', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .services-slider .swiper-slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .services-slider .swiper-slide' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'card_border',
                'label' => esc_html__('Card Border', 'drillcorp-core'),
                'selector' => '{{WRAPPER}} .services-slider .swiper-slide',
            ]
        );

        $this->end_controls_section();

        // Image Style
        $this->start_controls_section(
            'logo_style_section',
            [
                'label' => esc_html__('Image Style', 'drillcorp-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'logo_width',
            [
                'label' => esc_html__('Image Width', 'drillcorp-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 400,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => '100',
                ],
                'selectors' => [
                    '{{WRAPPER}} .services-slider-content img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'logo_height',
            [
                'label' => esc_html__('Image Height', 'drillcorp-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range' => [
                    'px' => [
                        'min' => 30,
                        'max' => 500,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .services-slider-content img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'logo_margin',
            [
                'label' => esc_html__('Image Margin', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .services-slider-content img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .services-slider-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .services-slider-content-wrap' => 'text-align: {{VALUE}}  ;',
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
                    '{{WRAPPER}} .services-slider-content-wrap h3' => 'color: {{VALUE}}  ;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'drillcorp-core'),
                'selector' => '{{WRAPPER}} .services-slider-content-wrap h3',
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Title Margin', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .services-slider-content-wrap h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .services-slider-content-wrap p' => 'color: {{VALUE}}  ;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => esc_html__('Description Typography', 'drillcorp-core'),
                'selector' => '{{WRAPPER}} .services-slider-content-wrap p',
            ]
        );

        $this->add_responsive_control(
            'description_margin',
            [
                'label' => esc_html__('Description Margin', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .services-slider-content-wrap p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .services-slider-content-wrap .primary-btn' => 'color: {{VALUE}}  ;',
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
                    '{{WRAPPER}} .services-slider-content-wrap .primary-btn' => 'background-color: {{VALUE}}  ;',
                ],
            ]
        );
        
        $this->add_control(
            'button_border_color',
            [
                'label' => esc_html__('Border Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .services-slider-content-wrap .primary-btn' => 'border-image: linear-gradient(135deg, {{VALUE}}, {{VALUE}}) 1 stretch;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => esc_html__('Typography', 'drillcorp-core'),
                'selector' => '{{WRAPPER}} .services-slider-content-wrap .primary-btn',
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__('Padding', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .services-slider-content-wrap .primary-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
                    '{{WRAPPER}} .services-slider-content-wrap .primary-btn:hover' => 'color: {{VALUE}}  ;',
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
                    '{{WRAPPER}} .services-slider-content-wrap .primary-btn:hover' => 'background-color: {{VALUE}}  ;',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .services-slider-content-wrap .primary-btn:hover' => 'border-image: linear-gradient(135deg, {{VALUE}}, {{VALUE}}) 1 stretch;',
                ],
            ]
        );
        

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // Navigation Style
        $this->start_controls_section(
            'navigation_style_section',
            [
                'label' => esc_html__('Navigation Style', 'drillcorp-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'nav_size',
            [
                'label' => esc_html__('Navigation Size', 'drillcorp-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 100,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-nav-arrow' => 'width: {{SIZE}}{{UNIT}}  ; height: {{SIZE}}{{UNIT}}  ;',
                    '{{WRAPPER}} .slider-nav-arrow svg' => 'width: {{SIZE}}{{UNIT}}  ; height: {{SIZE}}{{UNIT}}  ;',
                ],
            ]
        );

        $this->add_responsive_control(
            'nav_padding',
            [
                'label' => esc_html__('Navigation Padding', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-nav-arrow' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'nav_border_radius',
            [
                'label' => esc_html__('Border Radius', 'drillcorp-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-nav-arrow' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('nav_style_tabs');

        // Normal Tab
        $this->start_controls_tab(
            'nav_normal',
            [
                'label' => esc_html__('Normal', 'drillcorp-core'),
            ]
        );

        $this->add_control(
            'nav_icon_color',
            [
                'label' => esc_html__('Icon Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .slider-nav-arrow svg path' => 'stroke: {{VALUE}}  ;',
                ],
            ]
        );

        $this->add_control(
            'nav_bg_color',
            [
                'label' => esc_html__('Background Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f5f5f5',
                'selectors' => [
                    '{{WRAPPER}} .slider-nav-arrow' => 'background-color: {{VALUE}}  ;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nav_border',
                'label' => esc_html__('Border', 'drillcorp-core'),
                'selector' => '{{WRAPPER}} .slider-nav-arrow',
            ]
        );

        $this->end_controls_tab();

        // Hover Tab
        $this->start_controls_tab(
            'nav_hover',
            [
                'label' => esc_html__('Hover', 'drillcorp-core'),
            ]
        );

        $this->add_control(
            'nav_icon_hover_color',
            [
                'label' => esc_html__('Icon Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .slider-nav-arrow:hover svg path' => 'stroke: {{VALUE}}  ;',
                ],
            ]
        );

        $this->add_control(
            'nav_bg_hover_color',
            [
                'label' => esc_html__('Background Hover Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .slider-nav-arrow:hover' => 'background-color: {{VALUE}}  ;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'nav_border_hover',
                'label' => esc_html__('Border', 'drillcorp-core'),
                'selector' => '{{WRAPPER}} .slider-nav-arrow:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'nav_margin',
            [
                'label' => esc_html__('Navigation Margin', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-nav-arrow' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

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
        $rand_numb = rand(333, 999999999);
        //slider settings

        $slider_settings = [
            "loop" => esc_attr($settings['loop']),
            "items" => esc_attr($settings['items'] ?? 1),
            "autoplay" => esc_attr($settings['autoplay']),
            "speed" => esc_attr($settings['speed']['size'] ?? 500),
            "spaceBetween" => esc_attr($settings['slider_gap']['size'] ?? 20)
        ];

        // Query services from CPT
        $query_args = [
            'post_type' => 'services',
            'posts_per_page' => $settings['posts_per_page'] ?? 10,
            'order' => $settings['order'] ?? 'DESC',
            'orderby' => $settings['orderby'] ?? 'date',
            'post_status' => 'publish',
        ];

        $query = new \WP_Query($query_args);
        $services_data = [];

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $services_data[] = [
                    'ID' => get_the_ID(),
                    'title' => get_the_title(),
                    'content' => get_the_content(),
                    'excerpt' => get_the_excerpt(),
                    'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'full'),
                    'link' => get_permalink(),
                ];
            }
            wp_reset_postdata();
        }

        if (empty($services_data)) {
            return;
        }
      ?>
        <div class="services-slider-area" id="services-slider-<?php echo esc_attr($rand_numb); ?>">
            <div class="swiper services-slider" data-settings='<?php echo json_encode($slider_settings); ?>'>
                <div class="swiper-wrapper">
                    <?php foreach ($services_data as $service): ?>
                        <div class="swiper-slide">
                            <div class="services-slider-content">
                                <?php if (!empty($service['thumbnail'])): ?>
                                    <img class="service-card-thumb" src="<?php echo esc_url($service['thumbnail']); ?>" alt="<?php echo esc_attr($service['title']); ?>">
                                <?php endif; ?>
                                <div class="services-slider-content-wrap">
                                    <h3><?php echo esc_html($service['title']); ?></h3>
                                    <p><?php echo esc_html($service['excerpt'] ? $service['excerpt'] : wp_trim_words($service['content'], 30)); ?></p>
                                    <a class="primary-btn" href="<?php echo esc_url($service['link']); ?>">Explore This Service</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="slider-nav-wrapper">
                    <div class="swiper-button-prev slider-nav-arrow services-nav-prev">
                        <?php echo drillcorp_get_svg_icon('left_arrow'); ?>
                    </div>
                    <div class="swiper-button-next slider-nav-arrow services-nav-next">
                        <?php echo drillcorp_get_svg_icon('right_arrow'); ?>
                    </div>
                </div>
            </div>
        </div>

<?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new Services_Slider_Item_Widget());
