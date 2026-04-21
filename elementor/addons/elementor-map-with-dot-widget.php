<?php

/**
 * Elementor Map With Dot Widget
 * @package Drillcorp
 * @since 1.0.0
 */

namespace Elementor;

class Map_With_Dot_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'map-with-dot-widget';
    }

    public function get_title()
    {
        return esc_html__('Map With Dot', 'drillcorp-core');
    }

    public function get_icon()
    {
        return 'eicon-map-pin';
    }

    public function get_categories()
    {
        return ['drillcorp_widgets'];
    }

    protected function register_controls()
    {
        // =====================
        // Content Section
        // =====================
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Map Content', 'drillcorp-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'map_image',
            [
                'label'   => esc_html__('Map Image', 'drillcorp-core'),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'map_image',
                'default' => 'full',
            ]
        );

        $this->end_controls_section();

        // =====================
        // Dots Repeater Section
        // =====================
        $this->start_controls_section(
            'dots_section',
            [
                'label' => esc_html__('Map Dots', 'drillcorp-core'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'dot_label',
            [
                'label'       => esc_html__('Label', 'drillcorp-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Location', 'drillcorp-core'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'dot_position_x',
            [
                'label'   => esc_html__('Position X (%)', 'drillcorp-core'),
                'type'    => Controls_Manager::SLIDER,
                'range'   => [
                    '%' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
            ]
        );

        $repeater->add_control(
            'dot_position_y',
            [
                'label'   => esc_html__('Position Y (%)', 'drillcorp-core'),
                'type'    => Controls_Manager::SLIDER,
                'range'   => [
                    '%' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
            ]
        );

        $repeater->add_control(
            'dot_color',
            [
                'label'   => esc_html__('Dot Color', 'drillcorp-core'),
                'type'    => Controls_Manager::COLOR,
                'default' => '#ACFF2F',
            ]
        );

        $this->add_control(
            'map_dots',
            [
                'label'       => esc_html__('Dots', 'drillcorp-core'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'dot_label'      => esc_html__('Location 1', 'drillcorp-core'),
                        'dot_position_x' => [ 'unit' => '%', 'size' => 30 ],
                        'dot_position_y' => [ 'unit' => '%', 'size' => 40 ],
                        'dot_color'      => '#ACFF2F',
                    ],
                ],
                'title_field' => '{{{ dot_label }}}',
            ]
        );

        $this->end_controls_section();

        // =====================
        // Map Image Style
        // =====================
        $this->start_controls_section(
            'map_style_section',
            [
                'label' => esc_html__('Map Image', 'drillcorp-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'map_width',
            [
                'label'      => esc_html__('Width', 'drillcorp-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vw'],
                'range'      => [
                    'px' => [ 'min' => 100, 'max' => 2000 ],
                    '%'  => [ 'min' => 10,  'max' => 100  ],
                    'vw' => [ 'min' => 10,  'max' => 100  ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .map-wrapper' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'map_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'drillcorp-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .map-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'map_box_shadow',
                'selector' => '{{WRAPPER}} .map-img img',
            ]
        );

        $this->end_controls_section();

        // =====================
        // Dot Style Section
        // =====================
        $this->start_controls_section(
            'dot_style_section',
            [
                'label' => esc_html__('Dot Style', 'drillcorp-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'dot_size',
            [
                'label'      => esc_html__('Dot Size', 'drillcorp-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [ 'min' => 4, 'max' => 40, 'step' => 1 ],
                ],
                'default'    => [ 'unit' => 'px', 'size' => 12 ],
                'selectors'  => [
                    '{{WRAPPER}} .map-dot-inner' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dot_pulse_size',
            [
                'label'      => esc_html__('Pulse Max Size', 'drillcorp-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [ 'min' => 10, 'max' => 80, 'step' => 1 ],
                ],
                'default'    => [ 'unit' => 'px', 'size' => 32 ],
                'selectors'  => [
                    '{{WRAPPER}} .map-dot-pulse' => '--dot-pulse-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'dot_animation_speed',
            [
                'label'      => esc_html__('Blink Speed (s)', 'drillcorp-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['s'],
                'range'      => [
                    's' => [ 'min' => 0.5, 'max' => 5, 'step' => 0.1 ],
                ],
                'default'    => [ 'unit' => 's', 'size' => 1.8 ],
                'selectors'  => [
                    '{{WRAPPER}} .map-dot-pulse' => 'animation-duration: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .map-dot-inner' => 'animation-duration: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'dot_label_heading',
            [
                'label'     => esc_html__('Label', 'drillcorp-core'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'dot_label_typography',
                'selector' => '{{WRAPPER}} .map-dot-label',
            ]
        );

        $this->add_control(
            'dot_label_color',
            [
                'label'     => esc_html__('Label Color', 'drillcorp-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .map-dot-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dot_label_bg',
            [
                'label'     => esc_html__('Label Background', 'drillcorp-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#0D1A21',
                'selectors' => [
                    '{{WRAPPER}} .map-dot-label' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dot_label_padding',
            [
                'label'      => esc_html__('Label Padding', 'drillcorp-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'default'    => [
                    'top'    => '4',
                    'right'  => '10',
                    'bottom' => '4',
                    'left'   => '10',
                    'unit'   => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .map-dot-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dot_label_border_radius',
            [
                'label'      => esc_html__('Label Border Radius', 'drillcorp-core'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default'    => [
                    'top'    => '4',
                    'right'  => '4',
                    'bottom' => '4',
                    'left'   => '4',
                    'unit'   => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .map-dot-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $map_image = $settings['map_image'];
        $dots      = $settings['map_dots'];
        $image_url = Group_Control_Image_Size::get_attachment_image_src(
            $map_image['id'],
            'map_image',
            $settings
        );
        if ( ! $image_url ) {
            $image_url = $map_image['url'];
        }
        ?>
        <div class="map-wrapper">
            <div class="map-img">
                <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr__( 'Map', 'drillcorp-core' ); ?>">
            </div>

            <?php if ( ! empty( $dots ) ) : ?>
                <?php foreach ( $dots as $dot ) :
                    $pos_x     = isset( $dot['dot_position_x']['size'] ) ? floatval( $dot['dot_position_x']['size'] ) : 50;
                    $pos_y     = isset( $dot['dot_position_y']['size'] ) ? floatval( $dot['dot_position_y']['size'] ) : 50;
                    $dot_color = ! empty( $dot['dot_color'] ) ? $dot['dot_color'] : '#ACFF2F';
                    $dot_label = ! empty( $dot['dot_label'] ) ? $dot['dot_label'] : '';
                ?>
                <div class="map-single-dot" style="left:<?php echo esc_attr( $pos_x ); ?>%;top:<?php echo esc_attr( $pos_y ); ?>%;">
                    <span class="map-dot-inner" style="background-color:<?php echo esc_attr( $dot_color ); ?>;box-shadow:0 0 0 0 <?php echo esc_attr( $dot_color ); ?>;"></span>
                    <span class="map-dot-pulse" style="background-color:<?php echo esc_attr( $dot_color ); ?>;"></span>
                    <?php if ( $dot_label ) : ?>
                        <span class="map-dot-label"><?php echo esc_html( $dot_label ); ?></span>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Map_With_Dot_Widget() );
