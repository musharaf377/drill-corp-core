<?php

/**
 * Elementor Widget
 * @package Drillcorp
 * @since 1.0.0
 */

namespace Elementor;

class Services_List_Item_Widget extends Widget_Base
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
        return 'drillcorp-services-list-widget';
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
        return esc_html__('Services List', 'drillcorp-core');
    }

    public function get_keywords()
    {
        return ['Services List', 'list'];
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
            'title_trim_length',
            [
                'label' => esc_html__('Title Trim Length', 'drillcorp-core'),
                'type' => Controls_Manager::NUMBER,
                'description' => esc_html__('Enter the number of words to display. Leave empty or 0 to show full title.', 'drillcorp-core'),
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 0,
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

        $this->add_control(
            'layout_type',
            [
                'label' => esc_html__('Layout Type', 'drillcorp-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'list' => 'List',
                    'grid' => 'Grid',
                ],
                'default' => 'list',
            ]
        );

        $this->add_control(
            'grid_columns',
            [
                'label' => esc_html__('Grid Columns', 'drillcorp-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => '1 Columns',
                    '2' => '2 Columns',
                    '3' => '3 Columns',
                    '4' => '4 Columns',
                ],
                'default' => '2',
                'condition' => [
                    'layout_type' => 'grid',
                ],
            ]
        );

        $this->add_control(
            'grid_columns_tablet',
            [
                'label' => esc_html__('Grid Columns (Tablet)', 'drillcorp-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => '1 Column',
                    '2' => '2 Columns',
                    '3' => '3 Columns',
                ],
                'default' => '2',
                'condition' => [
                    'layout_type' => 'grid',
                ],
            ]
        );

        $this->add_control(
            'grid_columns_mobile',
            [
                'label' => esc_html__('Grid Columns (Mobile)', 'drillcorp-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => '1 Column',
                ],
                'default' => '1',
                'condition' => [
                    'layout_type' => 'grid',
                ],
            ]
        );

        $this->end_controls_section();

        // Animation Control
        $this->start_controls_section(
            'animation_section',
            [
                'label' => esc_html__('Animation', 'drillcorp-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'enable_animation',
            [
                'label' => esc_html__('Enable Sticky Animation', 'drillcorp-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'drillcorp-core'),
                'label_off' => esc_html__('No', 'drillcorp-core'),
                'return_value' => 'yes',
                'default' => 'yes',
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
                'selectors' => [
                    '{{WRAPPER}} .services-list' => 'gap: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .services-list-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .services-list-content' => 'height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .services-list-content' => 'gap: {{SIZE}}{{UNIT}}  ;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'card_background_color_element',
                'label' => esc_html__('Background', 'drillcorp-core'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .services-list-content',
            ]
        );


        $this->add_responsive_control(
            'card_padding',
            [
                'label' => esc_html__('Card Padding', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .services-list-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .services-list-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'card_border',
                'label' => esc_html__('Card Border', 'drillcorp-core'),
                'selector' => '{{WRAPPER}} .services-list-content',
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
                    '{{WRAPPER}} .services-list-content img' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .services-list-content img' => 'height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .services-list-content img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .services-list-content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .services-list-content-wrap' => 'text-align: {{VALUE}}  ;',
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
                    '{{WRAPPER}} .services-list-content-wrap a' => 'color: {{VALUE}}  ;',
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label' => esc_html__('Title Hover Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .services-list-content-wrap a:hover' => 'color: {{VALUE}}  ;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'drillcorp-core'),
                'selector' => '{{WRAPPER}} .services-list-content-wrap a',
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Title Margin', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .services-list-content-wrap a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__('Title Padding', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .services-list-content-wrap a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .services-list-content-wrap p' => 'color: {{VALUE}}  ;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => esc_html__('Description Typography', 'drillcorp-core'),
                'selector' => '{{WRAPPER}} .services-list-content-wrap p',
            ]
        );

        $this->add_responsive_control(
            'description_margin',
            [
                'label' => esc_html__('Description Margin', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .services-list-content-wrap p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .services-list-content-wrap .primary-btn' => 'color: {{VALUE}}  ;',
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
                    '{{WRAPPER}} .services-list-content-wrap .primary-btn' => 'background-color: {{VALUE}}  ;',
                ],
            ]
        );

        $this->add_control(
            'button_border_color',
            [
                'label' => esc_html__('Border Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .services-list-content-wrap .primary-btn' => 'border-image: linear-gradient(135deg, {{VALUE}}, {{VALUE}}) 1 stretch;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => esc_html__('Typography', 'drillcorp-core'),
                'selector' => '{{WRAPPER}} .services-list-content-wrap .primary-btn',
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__('Padding', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .services-list-content-wrap .primary-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
                    '{{WRAPPER}} .services-list-content-wrap .primary-btn:hover' => 'color: {{VALUE}}  ;',
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
                    '{{WRAPPER}} .services-list-content-wrap .primary-btn:hover' => 'background-color: {{VALUE}}  ;',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .services-list-content-wrap .primary-btn:hover' => 'border-image: linear-gradient(135deg, {{VALUE}}, {{VALUE}}) 1 stretch;',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();

        // Button Margin
        $this->add_responsive_control(
            'button_margin',
            [
                'label' => esc_html__('Margin', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .services-list-content-wrap .primary-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Service Feature List Controls
        $this->start_controls_section(
            'feature_list_section',
            [
                'label' => esc_html__('Service Feature List', 'drillcorp-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_title',
            [
                'label' => esc_html__('Show Title', 'drillcorp-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'drillcorp-core'),
                'label_off' => esc_html__('No', 'drillcorp-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_excerpt',
            [
                'label' => esc_html__('Show Excerpt', 'drillcorp-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'drillcorp-core'),
                'label_off' => esc_html__('No', 'drillcorp-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_thumbnail',
            [
                'label' => esc_html__('Show Thumbnail', 'drillcorp-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'drillcorp-core'),
                'label_off' => esc_html__('No', 'drillcorp-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_feature_list',
            [
                'label' => esc_html__('Show Feature List', 'drillcorp-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'drillcorp-core'),
                'label_off' => esc_html__('No', 'drillcorp-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_button',
            [
                'label' => esc_html__('Show Button', 'drillcorp-core'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'drillcorp-core'),
                'label_off' => esc_html__('No', 'drillcorp-core'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'drillcorp-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Explore This Service', 'drillcorp-core'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'feature_icon',
            [
                'label' => esc_html__('Feature Icon', 'drillcorp-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => get_template_directory_uri() . '/assets/img/service-check.png',
                ],
                'media_type' => 'image',
            ]
        );

        $this->end_controls_section();

        // Feature List Style
        $this->start_controls_section(
            'feature_list_style_section',
            [
                'label' => esc_html__('Feature List Style', 'drillcorp-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'feature_list_gap',
            [
                'label' => esc_html__('Feature Gap', 'drillcorp-core'),
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
                    'size' => 8,
                ],
                'selectors' => [
                    '{{WRAPPER}} .service-feature-list' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'feature_icon_width',
            [
                'label' => esc_html__('Icon Width', 'drillcorp-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'selectors' => [
                    '{{WRAPPER}} .service-feature-single .service-feature-icon' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'feature_gap_spacing',
            [
                'label' => esc_html__('Icon to Title Gap', 'drillcorp-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 30,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 8,
                ],
                'selectors' => [
                    '{{WRAPPER}} .service-feature-single' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'feature_title_color',
            [
                'label' => esc_html__('Title Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(13, 26, 33, 1)',
                'selectors' => [
                    '{{WRAPPER}} .service-feature-single .service-feature-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'feature_title_typography',
                'label' => esc_html__('Title Typography', 'drillcorp-core'),
                'selector' => '{{WRAPPER}} .service-feature-single .service-feature-title',
            ]
        );

        // Feature List Area Style
        $this->add_control(
            'feature_list_area_style_heading',
            [
                'label' => esc_html__('Feature List Area Style', 'drillcorp-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'feature_list_area_padding',
            [
                'label' => esc_html__('Padding', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .service-feature-list-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'feature_list_area_border',
                'label' => esc_html__('Border', 'drillcorp-core'),
                'selector' => '{{WRAPPER}} .service-feature-list-area',
            ]
        );

        $this->add_responsive_control(
            'feature_list_area_border_radius',
            [
                'label' => esc_html__('Border Radius', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .service-feature-list-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Feature Heading Style
        $this->add_control(
            'feature_heading_style_heading',
            [
                'label' => esc_html__('Feature Heading Style', 'drillcorp-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'feature_heading_color',
            [
                'label' => esc_html__('Heading Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .service-feature-heading' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'feature_heading_typography',
                'label' => esc_html__('Heading Typography', 'drillcorp-core'),
                'selector' => '{{WRAPPER}} .service-feature-heading',
            ]
        );

        $this->add_responsive_control(
            'feature_heading_margin',
            [
                'label' => esc_html__('Heading Margin', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .service-feature-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                $service_id = get_the_ID();

                // Get feature list from post meta
                $feature_list_meta = get_post_meta($service_id, 'drillcorp_services_options', true);

                $feature_list = [];

                // The meta is nested: ['services_feature'] contains the repeater array
                if (!empty($feature_list_meta) && isset($feature_list_meta['services_feature']) && is_array($feature_list_meta['services_feature'])) {
                    foreach ($feature_list_meta['services_feature'] as $feature) {
                        if (isset($feature['services_feature_title']) && !empty($feature['services_feature_title'])) {
                            $feature_list[] = [
                                'title' => $feature['services_feature_title'],
                            ];
                        }
                    }
                }

                $services_data[] = [
                    'ID' => get_the_ID(),
                    'title' => get_the_title(),
                    'content' => get_the_content(),
                    'excerpt' => get_the_excerpt(),
                    'thumbnail' => get_the_post_thumbnail_url(get_the_ID(), 'full'),
                    'link' => get_permalink(),
                    'feature_list' => $feature_list,
                ];
            }
            wp_reset_postdata();
        }

        if (empty($services_data)) {
            return;
        }

        $animation_class = ('yes' === $settings['enable_animation']) ? '' : ' no-animation';
        $layout_class = ('grid' === $settings['layout_type']) ? ' services-grid' : '';

        // Grid columns
        $grid_columns = isset($settings['grid_columns']) ? $settings['grid_columns'] : '3';
        $grid_columns_class = '';
        if ('grid' === $settings['layout_type']) {
            $grid_columns_class = ' grid-columns-' . esc_attr($grid_columns);
        }

        // Title trim length
        $title_trim_length = isset($settings['title_trim_length']) ? absint($settings['title_trim_length']) : 0;
?>
        <div class="services-list-area<?php echo esc_attr($animation_class . $layout_class . $grid_columns_class); ?>">
            <div class="services-list">
                <?php foreach ($services_data as $service): 
                    // Trim title if needed
                    $display_title = $service['title'];
                    if ($title_trim_length > 0) {
                        $words = explode(' ', $service['title']);
                        if (count($words) > $title_trim_length) {
                            $display_title = implode(' ', array_slice($words, 0, $title_trim_length)) . '...';
                        }
                    }
                ?>
                    <div class="services-list-content">
                        <?php if ('yes' === $settings['show_thumbnail'] && !empty($service['thumbnail'])): ?>
                            <a href="<?php echo esc_url($service['link']); ?>">
                                <img class="service-card-thumb" src="<?php echo esc_url($service['thumbnail']); ?>" alt="<?php echo esc_attr($service['title']); ?>">
                            </a>
                        <?php endif; ?>
                        <div class="services-list-content-wrap">
                            <?php if ('yes' === $settings['show_title']): ?>
                                <a href="<?php echo esc_url($service['link']); ?>"><?php echo esc_html($display_title); ?></a>
                            <?php endif; ?>
                            
                            <?php if ('yes' === $settings['show_excerpt']): ?>
                                <p><?php echo esc_html($service['excerpt'] ? $service['excerpt'] : wp_trim_words($service['content'], 30)); ?></p>
                            <?php endif; ?>

                            <?php
                            $icon_url = isset($settings['feature_icon']['url']) ? $settings['feature_icon']['url'] : get_template_directory_uri() . '/assets/img/service-check.png';

                            if ('yes' === $settings['show_feature_list'] && !empty($service['feature_list'])) :
                            ?> <div class="service-feature-list-area">
                                    <h4 class="service-feature-heading">Key Capabilities:</h4>
                                    <div class="service-feature-list">
                                        <?php foreach ($service['feature_list'] as $feature) : ?>
                                            <div class="service-feature-single">
                                                <img class="service-feature-icon" src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($feature['title']); ?>">
                                                <p class="service-feature-title"><?php echo esc_html($feature['title']); ?></p>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ('yes' === $settings['show_button']): ?>
                                <a class="primary-btn" href="<?php echo esc_url($service['link']); ?>"><?php echo esc_html($settings['button_text']); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

<?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new Services_List_Item_Widget());
