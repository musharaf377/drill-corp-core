<?php

/**
 * Elementor Widget
 * @package Musemind
 * @since 1.0.0
 */

namespace Elementor;

class Hero_Slider_Item_Widget extends Widget_Base
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
        return 'musemind-hero-single-item-widget';
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
        return esc_html__('Hero Slider', 'drillcorp-core');
    }

    public function get_keywords()
    {
        return ['musemind Hero Slider', 'slider'];
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
        return ['musemind_widgets'];
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

        $repeater = new Repeater();
        $repeater->add_control(
            'background_image',
            [
                'label' => esc_html__('Background Image', 'drillcorp-core'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'video_url',
            [
                'label' => esc_html__('Desktop Video URL', 'drillcorp-core'),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $repeater->add_control(
            'mobile_video_url',
            [
                'label' => esc_html__('Mobile Video URL', 'drillcorp-core'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'drillcorp-core'),
                'type' => Controls_Manager::TEXTAREA,
                'description' => esc_html__('enter Subtitle.', 'drillcorp-core'),
                'default' => esc_html__('Top Packages', 'drillcorp-core'),
            ]
        );

        $repeater->add_control(
            'subtitle_icon',
            [
                'label' => esc_html__('Subtitle Icon', 'drillcorp-core'),
                'type' => Controls_Manager::MEDIA,
                'description' => esc_html__('enter Subtitle Icon.', 'drillcorp-core'),
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'drillcorp-core'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('What We Do', 'drillcorp-core'),
            ]
        );

        $repeater->add_control(
            'hero_description',
            [
                'label' => esc_html__('Hero Description', 'drillcorp-core'),
                'type' => Controls_Manager::TEXTAREA,
                'description' => esc_html__('Enter Hero Description.', 'drillcorp-core'),
                'default' => esc_html__('Hero Description', 'drillcorp-core'),
            ]
        );

        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'drillcorp-core'),
                'type' => Controls_Manager::TEXTAREA,
                'description' => esc_html__('enter  button text.', 'drillcorp-core'),
                'default' => esc_html__('Get Started', 'drillcorp-core'),
            ]
        );

        $repeater->add_control(
            'button_url',
            [
                'label' => esc_html__('Button URL', 'drillcorp-core'),
                'type' => Controls_Manager::TEXTAREA,
                'description' => esc_html__('enter  button url.', 'drillcorp-core'),
                'default' => esc_html__('#', 'drillcorp-core'),
            ]
        );

        $repeater->add_control(
            'progress_icon',
            [
                'label' => esc_html__('Progress Icon', 'drillcorp-core'),
                'type' => Controls_Manager::MEDIA,
                'description' => esc_html__('Select icon for progress content.', 'drillcorp-core'),
            ]
        );

        $repeater->add_control(
            'progress_title',
            [
                'label' => esc_html__('Progress Title', 'drillcorp-core'),
                'type' => Controls_Manager::TEXTAREA,
                'description' => esc_html__('Enter title for progress content.', 'drillcorp-core'),
                'default' => esc_html__('Progress Title', 'drillcorp-core'),
            ]
        );

        $this->add_control('hero_slider_items', [
            'label' => esc_html__('Hero Slider Item', 'drillcorp-core'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),

        ]);
        $this->end_controls_section();



        $this->start_controls_section(
            'slider_settings_section',
            [
                'label' => esc_html__('Slider Settings', 'drillcorp-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
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

        $this->add_control(
            'effect',
            [
                'label' => esc_html__('Effect', 'drillcorp-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'slide' => esc_html__('Slide', 'drillcorp-core'),
                    'fade' => esc_html__('Fade', 'drillcorp-core'),
                ],
                'default' => 'slide',
                'description' => esc_html__('Note: Fade effect works best with 2-3 slides. For more slides, use Slide effect.', 'drillcorp-core'),
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
            'slider_height',
            [
                'label' => esc_html__('Slider Height', 'drillcorp-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh', '%'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1200,
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
                    'unit' => 'vh',
                    'size' => 80,
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-area .swiper-slide' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'overlay_color',
            [
                'label' => esc_html__('Overlay Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0,0,0,0.5)',
                'selectors' => [
                    '{{WRAPPER}} .hero-overlay' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_size',
            [
                'label' => esc_html__('Background Size', 'drillcorp-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'cover',
                'options' => [
                    'cover' => esc_html__('Cover', 'drillcorp-core'),
                    'contain' => esc_html__('Contain', 'drillcorp-core'),
                    'auto' => esc_html__('Auto', 'drillcorp-core'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-area .swiper-slide' => 'background-size: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_position',
            [
                'label' => esc_html__('Background Position', 'drillcorp-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'center center',
                'options' => [
                    'top left' => esc_html__('Top Left', 'drillcorp-core'),
                    'top center' => esc_html__('Top Center', 'drillcorp-core'),
                    'top right' => esc_html__('Top Right', 'drillcorp-core'),
                    'center left' => esc_html__('Center Left', 'drillcorp-core'),
                    'center center' => esc_html__('Center Center', 'drillcorp-core'),
                    'center right' => esc_html__('Center Right', 'drillcorp-core'),
                    'bottom left' => esc_html__('Bottom Left', 'drillcorp-core'),
                    'bottom center' => esc_html__('Bottom Center', 'drillcorp-core'),
                    'bottom right' => esc_html__('Bottom Right', 'drillcorp-core'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-area .swiper-slide' => 'background-position: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'hero_slider_main_padding',
            [
                'label' => esc_html__('Slider Padding', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-area .swiper-slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            'hero_slider_content_padding',
            [
                'label' => esc_html__('Slider Content Padding', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Subtitle Style
        $this->add_control(
            'subtitle_style_heading',
            [
                'label' => esc_html__('Subtitle Style', 'drillcorp-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__('Subtitle Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'label' => esc_html__('Subtitle Typography', 'drillcorp-core'),
                'selector' => '{{WRAPPER}} .hero-slider-subtitle',
            ]
        );

        $this->add_responsive_control(
            'subtitle_padding',
            [
                'label' => esc_html__('Subtitle padding', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'subtitle_icon_size',
            [
                'label' => esc_html__('Subtitle Icon Size', 'drillcorp-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-subtitle img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
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
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .hero-slide-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'drillcorp-core'),
                'selector' => '{{WRAPPER}} .hero-slide-title',
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Title Margin', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .hero-slide-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .hero-slide-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => esc_html__('Description Typography', 'drillcorp-core'),
                'selector' => '{{WRAPPER}} .hero-slide-description',
            ]
        );

        $this->add_responsive_control(
            'description_margin',
            [
                'label' => esc_html__('Description Margin', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .hero-slide-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Button Style
        $this->add_control(
            'button_style_heading',
            [
                'label' => esc_html__('Button Style', 'drillcorp-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
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
                'label' => esc_html__('Button Text Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-content .hero-slider-btn' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_icon_color',
            [
                'label' => esc_html__('Button Icon Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#0d1623',
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-content .hero-slider-btn svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => esc_html__('Button Background Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'default' => 'transparent',
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-content .hero-slider-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_color',
            [
                'label' => esc_html__('Border Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-content .hero-slider-btn' => 'border-image: linear-gradient(135deg, {{VALUE}}, {{VALUE}}) 1 stretch;',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__('Button Padding', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-content .hero-slider-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => esc_html__('Button Typography', 'drillcorp-core'),
                'selector' => '{{WRAPPER}} .hero-slider-content .hero-slider-btn',
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
            'button_text_color_hover',
            [
                'label' => esc_html__('Button Text Color Hover', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-content .hero-slider-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_icon_color_hover',
            [
                'label' => esc_html__('Button Icon Color Hover', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-content .hero-slider-btn:hover svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color_hover',
            [
                'label' => esc_html__('Button Background Color Hover', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ff5252',
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-content .hero-slider-btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-content .hero-slider-btn:hover' => 'border-image: linear-gradient(135deg, {{VALUE}}, {{VALUE}}) 1 stretch;',
                ],
            ]
        );

        $this->add_control(
            'button_transition',
            [
                'label' => esc_html__('Transition Duration', 'drillcorp-core'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-content .hero-slider-btn' => 'transition: all {{SIZE}}s ease-in-out;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'button_margin',
            [
                'label' => esc_html__('Button Margin', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-content .hero-slider-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Progress Style
        $this->start_controls_section(
            'progress_style_section',
            [
                'label' => esc_html__('Progress Bar Style', 'drillcorp-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'progress_bar_heading',
            [
                'label' => esc_html__('Progress Bar', 'drillcorp-core'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'progress_bar_height',
            [
                'label' => esc_html__('Height', 'drillcorp-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 20,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .progress-bar' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'progress_bar_bg_color',
            [
                'label' => esc_html__('Background Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(178, 178, 178, 1)',
                'selectors' => [
                    '{{WRAPPER}} .progress-container' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'progress_bar_active_color',
            [
                'label' => esc_html__('Active Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(255, 255, 255, 1)',
                'selectors' => [
                    '{{WRAPPER}} .progress-bar' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'progress_bar_border_radius',
            [
                'label' => esc_html__('Border Radius', 'drillcorp-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .progress-container, {{WRAPPER}} .progress-bar' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'progress_bar_spacing',
            [
                'label' => esc_html__('Spacing', 'drillcorp-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .progress-bars-container' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Progress Content Style
        $this->add_control(
            'progress_content_heading',
            [
                'label' => esc_html__('Progress Content', 'drillcorp-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'progress_content_padding',
            [
                'label' => esc_html__('Padding', 'drillcorp-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-progress-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Progress Icon Style
        $this->add_control(
            'progress_icon_style_heading',
            [
                'label' => esc_html__('Progress Icon', 'drillcorp-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'progress_icon_size',
            [
                'label' => esc_html__('Icon Size', 'drillcorp-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 24,
                ],
                'selectors' => [
                    '{{WRAPPER}} .slider-progress-content img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Progress Title Style
        $this->add_control(
            'progress_title_style_heading',
            [
                'label' => esc_html__('Progress Title', 'drillcorp-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'progress_title_color',
            [
                'label' => esc_html__('Title Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .slider-progress-content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'progress_title_typography',
                'label' => esc_html__('Title Typography', 'drillcorp-core'),
                'selector' => '{{WRAPPER}} .slider-progress-content p',
            ]
        );

        $this->add_control(
            'progress_container_heading',
            [
                'label' => esc_html__('Progress Container', 'drillcorp-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'progress_container_position_bottom',
            [
                'label' => esc_html__('Bottom Position', 'drillcorp-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vh'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    'vh' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-progress-wrapper' => 'bottom: {{SIZE}}{{UNIT}};',
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
        $all_hero_slider_items = $settings['hero_slider_items'];
        $rand_numb = rand(333, 999999999);
        //slider settings

        $slider_settings = [
            "loop" => esc_attr($settings['loop']),
            "autoplay" => esc_attr($settings['autoplay']),
            "speed" => esc_attr($settings['speed']['size'] ?? 500),
            "effect" => esc_attr($settings['effect'] ?? 'slide'),
        ]
?>
        <div class="hero-slider-area">
            <div class="swiper hero-slider" data-settings='<?php echo json_encode($slider_settings); ?>'>
                <div class="swiper-wrapper">
                    <?php foreach ($all_hero_slider_items as $item): ?>
                        <div class="swiper-slide" style="<?php if ($item['background_image']['url']) { ?>background-image:url(<?php echo $item['background_image']['url'] ?>);
                            <?php } ?>">
                            <?php if ($item['video_url']['url']) { ?>
                                <video autoplay loop muted playsinline class="hero-desktop-video">
                                    <source src="<?php echo $item['video_url']['url'] ?>" type="video/mp4">
                                </video>
                            <?php } ?>
                            <?php if ($item['video_url']['url']) { ?>
                                <video autoplay loop muted playsinline class="hero-mobile-video">
                                    <source src="<?php echo $item['mobile_video_url']['url'] ?>" type="video/mp4">
                                </video>
                            <?php } ?>
                            <div class="hero-overlay"></div>

                            <div class="hero-slider-absoulet-content">
                                <div class="container">
                                    <div class="hero-slider-content">
                                        <div class="slider-left-content">
                                            <p class="hero-slider-subtitle">
                                                <?php
                                                if ($item['subtitle_icon']['url']) { ?>
                                                    <img src="<?php echo $item['subtitle_icon']['url']; ?>" alt="">
                                                <?php }
                                                echo $item['subtitle'];
                                                ?>
                                            </p>
                                            <h1 class="hero-slide-title"><?php echo $item['title'] ?></h1>
                                            <p class="hero-slide-description"><?php echo $item['hero_description'] ?></p>
                                            <a href="<?php echo $item['button_url'] ?>" class="hero-slider-btn"><?php echo $item['button_text'] ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="hero-slider-pagination"></div>
            </div>


            <!-- Multiple Progress Bars - One for each slide -->
            <div class="hero-progress-wrapper">
                <div class="container">
                    <div class="progress-bars-container">
                        <?php foreach ($all_hero_slider_items as $index => $item): ?>
                            <div class="progress-container" role="button" tabindex="0" aria-label="<?php echo esc_attr(sprintf('Go to slide %d', $index + 1)); ?>">
                                <div class="progress-bar" data-slide-index="<?php echo $index; ?>"></div>
                                <div class="slider-progress-conetnt-wrap">
                                    <div class="slider-progress-content">
                                        <img src="<?php echo $item['progress_icon']['url']; ?>" alt="">
                                        <p><?php echo $item['progress_title']; ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>


        </div>
<?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new Hero_Slider_Item_Widget());
