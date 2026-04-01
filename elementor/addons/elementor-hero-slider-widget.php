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
        return esc_html__('Hero Slider', 'musemind-core');
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
                'label' => esc_html__('General Settings', 'musemind-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();
        $repeater->add_control(
            'background_image',
            [
                'label' => esc_html__('Background Image', 'musemind-core'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'video_url',
            [
                'label' => esc_html__('Desktop Video URL', 'musemind-core'),
                'type' => Controls_Manager::MEDIA,
            ]
        );
        $repeater->add_control(
            'mobile_video_url',
            [
                'label' => esc_html__('Mobile Video URL', 'musemind-core'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'subtitle',
            [
                'label' => esc_html__('Subtitle', 'musemind-core'),
                'type' => Controls_Manager::TEXTAREA,
                'description' => esc_html__('enter Subtitle.', 'musemind-core'),
                'default' => esc_html__('Top Packages', 'musemind-core'),
            ]
        );

        $repeater->add_control(
            'subtitle_icon',
            [
                'label' => esc_html__('Subtitle Icon', 'musemind-core'),
                'type' => Controls_Manager::MEDIA,
                'description' => esc_html__('enter Subtitle Icon.', 'musemind-core'),
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'musemind-core'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('What We Do', 'musemind-core'),
            ]
        );

        $repeater->add_control(
            'hero_description',
            [
                'label' => esc_html__('Hero Description', 'musemind-core'),
                'type' => Controls_Manager::TEXTAREA,
                'description' => esc_html__('Enter Hero Description.', 'musemind-core'),
                'default' => esc_html__('Hero Description', 'musemind-core'),
            ]
        );

        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'musemind-core'),
                'type' => Controls_Manager::TEXTAREA,
                'description' => esc_html__('enter  button text.', 'musemind-core'),
                'default' => esc_html__('Get Started', 'musemind-core'),
            ]
        );

        $repeater->add_control(
            'button_url',
            [
                'label' => esc_html__('Button URL', 'musemind-core'),
                'type' => Controls_Manager::TEXTAREA,
                'description' => esc_html__('enter  button url.', 'musemind-core'),
                'default' => esc_html__('#', 'musemind-core'),
            ]
        );

        $repeater->add_control(
            'progress_icon',
            [
                'label' => esc_html__('Progress Icon', 'musemind-core'),
                'type' => Controls_Manager::MEDIA,
                'description' => esc_html__('Select icon for progress content.', 'musemind-core'),
            ]
        );

        $repeater->add_control(
            'progress_title',
            [
                'label' => esc_html__('Progress Title', 'musemind-core'),
                'type' => Controls_Manager::TEXTAREA,
                'description' => esc_html__('Enter title for progress content.', 'musemind-core'),
                'default' => esc_html__('Progress Title', 'musemind-core'),
            ]
        );

        $this->add_control('hero_slider_items', [
            'label' => esc_html__('Hero Slider Item', 'musemind-core'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),

        ]);
        $this->end_controls_section();



        $this->start_controls_section(
            'slider_settings_section',
            [
                'label' => esc_html__('Slider Settings', 'musemind-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => esc_html__('Loop', 'musemind-core'),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__('you can set yes/no to enable/disable', 'musemind-core'),
            ]
        );
        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__('Autoplay', 'musemind-core'),
                'type' => Controls_Manager::SWITCHER,
                'description' => esc_html__('you can set yes/no to enable/disable', 'musemind-core'),
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => esc_html__('Speed', 'musemind-core'),
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
                'label' => esc_html__('Effect', 'musemind-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'slide' => esc_html__('Slide', 'musemind-core'),
                    'fade' => esc_html__('Fade', 'musemind-core'),
                ],
                'default' => 'slide',
                'description' => esc_html__('Note: Fade effect works best with 2-3 slides. For more slides, use Slide effect.', 'musemind-core'),
            ]
        );


        $this->end_controls_section();

        // Style Controls
        $this->start_controls_section(
            'slider_style_section',
            [
                'label' => esc_html__('Slider Style', 'musemind-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'slider_height',
            [
                'label' => esc_html__('Slider Height', 'musemind-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1200,
                        'step' => 10,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
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
                'label' => esc_html__('Overlay Color', 'musemind-core'),
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
                'label' => esc_html__('Background Size', 'musemind-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'cover',
                'options' => [
                    'cover' => esc_html__('Cover', 'musemind-core'),
                    'contain' => esc_html__('Contain', 'musemind-core'),
                    'auto' => esc_html__('Auto', 'musemind-core'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-area .swiper-slide' => 'background-size: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_position',
            [
                'label' => esc_html__('Background Position', 'musemind-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'center center',
                'options' => [
                    'top left' => esc_html__('Top Left', 'musemind-core'),
                    'top center' => esc_html__('Top Center', 'musemind-core'),
                    'top right' => esc_html__('Top Right', 'musemind-core'),
                    'center left' => esc_html__('Center Left', 'musemind-core'),
                    'center center' => esc_html__('Center Center', 'musemind-core'),
                    'center right' => esc_html__('Center Right', 'musemind-core'),
                    'bottom left' => esc_html__('Bottom Left', 'musemind-core'),
                    'bottom center' => esc_html__('Bottom Center', 'musemind-core'),
                    'bottom right' => esc_html__('Bottom Right', 'musemind-core'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-area .swiper-slide' => 'background-position: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Content Style
        $this->start_controls_section(
            'content_style_section',
            [
                'label' => esc_html__('Content Style', 'musemind-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'hero_slider_content_padding',
            [
                'label' => esc_html__('Slider Content Padding', 'musemind-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        // Title Style
        $this->add_control(
            'title_style_heading',
            [
                'label' => esc_html__('Title Style', 'musemind-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'musemind-core'),
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
                'label' => esc_html__('Title Typography', 'musemind-core'),
                'selector' => '{{WRAPPER}} .hero-slide-title',
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Title Margin', 'musemind-core'),
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
                'label' => esc_html__('Description Style', 'musemind-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Description Color', 'musemind-core'),
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
                'label' => esc_html__('Description Typography', 'musemind-core'),
                'selector' => '{{WRAPPER}} .hero-slide-description',
            ]
        );

        $this->add_responsive_control(
            'description_margin',
            [
                'label' => esc_html__('Description Margin', 'musemind-core'),
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
                'label' => esc_html__('Button Style', 'musemind-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('button_style_tabs');

        $this->start_controls_tab(
            'button_normal',
            [
                'label' => esc_html__('Normal', 'musemind-core'),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => esc_html__('Button Text Color', 'musemind-core'),
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
                'label' => esc_html__('Button Icon Color', 'musemind-core'),
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
                'label' => esc_html__('Button Background Color', 'musemind-core'),
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
                'label' => esc_html__('Border Color', 'drilllcorp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-content .hero-slider-btn' => 'border-image: linear-gradient(135deg, {{VALUE}}, {{VALUE}}) 1 stretch;',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__('Button Padding', 'musemind-core'),
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
                'label' => esc_html__('Button Typography', 'musemind-core'),
                'selector' => '{{WRAPPER}} .hero-slider-content .hero-slider-btn',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'button_hover',
            [
                'label' => esc_html__('Hover', 'musemind-core'),
            ]
        );

        $this->add_control(
            'button_text_color_hover',
            [
                'label' => esc_html__('Button Text Color Hover', 'musemind-core'),
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
                'label' => esc_html__('Button Icon Color Hover', 'musemind-core'),
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
                'label' => esc_html__('Button Background Color Hover', 'musemind-core'),
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
                'label' => esc_html__('Border Color', 'drilllcorp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-content .hero-slider-btn:hover' => 'border-image: linear-gradient(135deg, {{VALUE}}, {{VALUE}}) 1 stretch;',
                ],
            ]
        );

        $this->add_control(
            'button_transition',
            [
                'label' => esc_html__('Transition Duration', 'musemind-core'),
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
                'label' => esc_html__('Button Margin', 'musemind-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-content .hero-slider-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Thumbnail Slider Style
        $this->start_controls_section(
            'thumbnail_style_section',
            [
                'label' => esc_html__('Thumbnail Slider Style', 'musemind-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'thumbnail_width',
            [
                'label' => esc_html__('Thumbnail Width', 'musemind-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 300,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 5,
                        'max' => 30,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 150,
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-thumb .swiper-slide' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thumbnail_height',
            [
                'label' => esc_html__('Thumbnail Height', 'musemind-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 300,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 5,
                        'max' => 30,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-thumb .swiper-slide' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'thumbnail_border_radius',
            [
                'label' => esc_html__('Thumbnail Border Radius', 'musemind-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-thumb .swiper-slide' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'thumbnail_border',
                'label' => esc_html__('Thumbnail Border', 'musemind-core'),
                'selector' => '{{WRAPPER}} .hero-slider-thumb .swiper-slide',
            ]
        );

        $this->add_responsive_control(
            'thumbnail_margin',
            [
                'label' => esc_html__('Thumbnail Margin', 'musemind-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-thumb .swiper-slide' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'active_thumbnail_border_color',
            [
                'label' => esc_html__('Active Thumbnail Border Color', 'musemind-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ff6b6b',
                'selectors' => [
                    '{{WRAPPER}} .hero-slider-thumb .swiper-slide-thumb-active' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Video Button Style
        $this->start_controls_section(
            'video_button_style_section',
            [
                'label' => esc_html__('Video Button Style', 'musemind-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );



        $this->add_responsive_control(
            'video_button_size',
            [
                'label' => esc_html__('Video Button Size', 'musemind-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 200,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-video-button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_icon_size',
            [
                'label' => esc_html__('Video Icon Size', 'musemind-core'),
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
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .video-play-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_button_margin',
            [
                'label' => esc_html__('Video Button Margin', 'musemind-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .hero-video-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Video Popup Style
        $this->start_controls_section(
            'video_popup_style_section',
            [
                'label' => esc_html__('Video Popup Style', 'musemind-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'popup_overlay_color',
            [
                'label' => esc_html__('Popup Overlay Color', 'musemind-core'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0,0,0,0.8)',
                'selectors' => [
                    '{{WRAPPER}} .show-reels-video' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'popup_video_width',
            [
                'label' => esc_html__('Popup Video Width', 'musemind-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 300,
                        'max' => 1400,
                        'step' => 10,
                    ],
                    '%' => [
                        'min' => 30,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 80,
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-video-wrapper' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'popup_video_height',
            [
                'label' => esc_html__('Popup Video Height', 'musemind-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'vh'],
                'range' => [
                    'px' => [
                        'min' => 200,
                        'max' => 900,
                        'step' => 10,
                    ],
                    'vh' => [
                        'min' => 20,
                        'max' => 80,
                    ],
                ],
                'default' => [
                    'unit' => 'vh',
                    'size' => 60,
                ],
                'selectors' => [
                    '{{WRAPPER}} .hero-video-wrapper iframe' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'popup_close_button_color',
            [
                'label' => esc_html__('Close Button Color', 'musemind-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .video-close-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'popup_close_button_bg_color',
            [
                'label' => esc_html__('Close Button Background Color', 'musemind-core'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ff6b6b',
                'selectors' => [
                    '{{WRAPPER}} .video-close-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'popup_close_button_size',
            [
                'label' => esc_html__('Close Button Size', 'musemind-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 80,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .video-close-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'popup_close_button_border_radius',
            [
                'label' => esc_html__('Close Button Border Radius', 'musemind-core'),
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
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .video-close-icon' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'popup_close_button_position',
            [
                'label' => esc_html__('Close Button Position', 'musemind-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .video-close-icon' => 'top: {{TOP}}{{UNIT}}; right: {{RIGHT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}}; left: {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Progress Style
        $this->start_controls_section(
            'progress_style_section',
            [
                'label' => esc_html__('Progress Bar Style', 'musemind-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'progress_bar_heading',
            [
                'label' => esc_html__('Progress Bar', 'musemind-core'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'progress_bar_height',
            [
                'label' => esc_html__('Height', 'musemind-core'),
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
                'label' => esc_html__('Background Color', 'musemind-core'),
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
                'label' => esc_html__('Active Color', 'musemind-core'),
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
                'label' => esc_html__('Border Radius', 'musemind-core'),
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
                'label' => esc_html__('Spacing', 'musemind-core'),
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
                'label' => esc_html__('Progress Content', 'musemind-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'progress_content_padding',
            [
                'label' => esc_html__('Padding', 'musemind-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-progress-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'progress_content_margin',
            [
                'label' => esc_html__('Margin', 'musemind-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-progress-conetnt-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Progress Icon Style
        $this->add_control(
            'progress_icon_style_heading',
            [
                'label' => esc_html__('Progress Icon', 'musemind-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'progress_icon_size',
            [
                'label' => esc_html__('Icon Size', 'musemind-core'),
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

        $this->add_responsive_control(
            'progress_icon_margin',
            [
                'label' => esc_html__('Icon Margin', 'musemind-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-progress-content img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Progress Title Style
        $this->add_control(
            'progress_title_style_heading',
            [
                'label' => esc_html__('Progress Title', 'musemind-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'progress_title_color',
            [
                'label' => esc_html__('Title Color', 'musemind-core'),
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
                'label' => esc_html__('Title Typography', 'musemind-core'),
                'selector' => '{{WRAPPER}} .slider-progress-content p',
            ]
        );

        $this->add_responsive_control(
            'progress_title_margin',
            [
                'label' => esc_html__('Title Margin', 'musemind-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .slider-progress-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'progress_container_heading',
            [
                'label' => esc_html__('Progress Container', 'musemind-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'progress_container_position_bottom',
            [
                'label' => esc_html__('Bottom Position', 'musemind-core'),
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
                            <div class="progress-container">
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
