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
            'dot_sub_label',
            [
                'label'       => esc_html__('Sub Label', 'drillcorp-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Drilled', 'drillcorp-core'),
                'label_block' => true,
                'description' => esc_html__('Secondary text below the main label (e.g. "Drilled").', 'drillcorp-core'),
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

        // ── Label Offset ─────────────────────────────────────────
        $repeater->add_control(
            'label_position_heading',
            [
                'label'     => esc_html__('Label Position', 'drillcorp-core'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'label_offset_x',
            [
                'label'       => esc_html__('Label Offset X (px)', 'drillcorp-core'),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => ['px'],
                'range'       => [
                    'px' => [
                        'min'  => -400,
                        'max'  => 400,
                        'step' => 1,
                    ],
                ],
                'default'     => [ 'unit' => 'px', 'size' => -120 ],
                'description' => esc_html__('Horizontal offset of the label from the dot centre. Negative = left.', 'drillcorp-core'),
            ]
        );

        $repeater->add_control(
            'label_offset_y',
            [
                'label'       => esc_html__('Label Offset Y (px)', 'drillcorp-core'),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => ['px'],
                'range'       => [
                    'px' => [
                        'min'  => -400,
                        'max'  => 400,
                        'step' => 1,
                    ],
                ],
                'default'     => [ 'unit' => 'px', 'size' => -80 ],
                'description' => esc_html__('Vertical offset of the label from the dot centre. Negative = up.', 'drillcorp-core'),
            ]
        );

        // ── Arrow / Line Image ────────────────────────────────────
        $repeater->add_control(
            'arrow_image_heading',
            [
                'label'     => esc_html__('Arrow / Indicator Image', 'drillcorp-core'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $repeater->add_control(
            'arrow_image',
            [
                'label'       => esc_html__('Arrow Image', 'drillcorp-core'),
                'type'        => Controls_Manager::MEDIA,
                'description' => esc_html__('Upload a custom arrow/line image. Leave empty to use an auto-drawn SVG line.', 'drillcorp-core'),
            ]
        );

        $repeater->add_control(
            'arrow_image_width',
            [
                'label'      => esc_html__('Arrow Image Width (px)', 'drillcorp-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 20,
                        'max'  => 300,
                        'step' => 1,
                    ],
                ],
                'default'    => [ 'unit' => 'px', 'size' => 80 ],
            ]
        );

        $repeater->add_control(
            'arrow_pos_x',
            [
                'label'       => esc_html__('Arrow Offset X (px)', 'drillcorp-core'),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => ['px'],
                'range'       => [
                    'px' => [
                        'min'  => -200,
                        'max'  => 200,
                        'step' => 1,
                    ],
                ],
                'default'     => [ 'unit' => 'px', 'size' => 0 ],
                'description' => esc_html__('Shift the arrow start point horizontally from the dot centre.', 'drillcorp-core'),
            ]
        );

        $repeater->add_control(
            'arrow_pos_y',
            [
                'label'       => esc_html__('Arrow Offset Y (px)', 'drillcorp-core'),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => ['px'],
                'range'       => [
                    'px' => [
                        'min'  => -200,
                        'max'  => 200,
                        'step' => 1,
                    ],
                ],
                'default'     => [ 'unit' => 'px', 'size' => 0 ],
                'description' => esc_html__('Shift the arrow start point vertically from the dot centre.', 'drillcorp-core'),
            ]
        );

        $repeater->add_control(
            'arrow_rotation',
            [
                'label'       => esc_html__('Arrow Rotation (deg)', 'drillcorp-core'),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => ['deg'],
                'range'       => [
                    'deg' => [
                        'min'  => -180,
                        'max'  => 180,
                        'step' => 1,
                    ],
                ],
                'default'     => [ 'unit' => 'deg', 'size' => 0 ],
                'description' => esc_html__('Extra rotation added on top of the auto-calculated angle toward the label.', 'drillcorp-core'),
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
                        'dot_sub_label'  => esc_html__('Drilled', 'drillcorp-core'),
                        'dot_position_x' => [ 'unit' => '%', 'size' => 30 ],
                        'dot_position_y' => [ 'unit' => '%', 'size' => 40 ],
                        'dot_color'      => '#ACFF2F',
                        'label_offset_x' => [ 'unit' => 'px', 'size' => -120 ],
                        'label_offset_y' => [ 'unit' => 'px', 'size' => -80 ],
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

        $this->end_controls_section();

        // =====================
        // Label Style Section
        // =====================
        $this->start_controls_section(
            'label_style_section',
            [
                'label' => esc_html__('Label Style', 'drillcorp-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'dot_label_typography',
                'label'    => esc_html__('Main Label Typography', 'drillcorp-core'),
                'selector' => '{{WRAPPER}} .map-dot-label-title',
            ]
        );

        $this->add_control(
            'dot_label_color',
            [
                'label'     => esc_html__('Main Label Color', 'drillcorp-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .map-dot-label-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'dot_sub_label_typography',
                'label'    => esc_html__('Sub Label Typography', 'drillcorp-core'),
                'selector' => '{{WRAPPER}} .map-dot-label-sub',
            ]
        );

        $this->add_control(
            'dot_sub_label_color',
            [
                'label'     => esc_html__('Sub Label Color', 'drillcorp-core'),
                'type'      => Controls_Manager::COLOR,
                'default'   => 'rgba(255,255,255,0.75)',
                'selectors' => [
                    '{{WRAPPER}} .map-dot-label-sub' => 'color: {{VALUE}};',
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
                    'top'    => '6',
                    'right'  => '12',
                    'bottom' => '6',
                    'left'   => '12',
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
                    'top'    => '6',
                    'right'  => '6',
                    'bottom' => '6',
                    'left'   => '6',
                    'unit'   => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .map-dot-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'dot_label_blur',
            [
                'label'      => esc_html__('Background Blur', 'drillcorp-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 40,
                        'step' => 1,
                    ],
                ],
                'default'    => [ 'unit' => 'px', 'size' => 0 ],
                'separator'  => 'before',
                'selectors'  => [
                    '{{WRAPPER}} .map-dot-label' => 'backdrop-filter: blur({{SIZE}}{{UNIT}}); -webkit-backdrop-filter: blur({{SIZE}}{{UNIT}});',
                ],
            ]
        );

       $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'dot_label_border',
                'label'     => esc_html__('Label Border', 'drillcorp-core'),
                'selector'  => '{{WRAPPER}} .map-dot-label',
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        // =====================
        // Arrow / Line Style
        // =====================
        $this->start_controls_section(
            'arrow_style_section',
            [
                'label' => esc_html__('Arrow / Line Style', 'drillcorp-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'arrow_line_color',
            [
                'label'   => esc_html__('Line Color', 'drillcorp-core'),
                'type'    => Controls_Manager::COLOR,
                'default' => '#ffffff',
            ]
        );

        $this->add_control(
            'arrow_line_width',
            [
                'label'      => esc_html__('Line Width (px)', 'drillcorp-core'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [ 'min' => 0.5, 'max' => 5, 'step' => 0.5 ],
                ],
                'default'    => [ 'unit' => 'px', 'size' => 1.5 ],
            ]
        );

        $this->add_control(
            'arrow_show_head',
            [
                'label'        => esc_html__('Show Arrowhead', 'drillcorp-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__('Yes', 'drillcorp-core'),
                'label_off'    => esc_html__('No', 'drillcorp-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings   = $this->get_settings_for_display();
        $map_image  = $settings['map_image'];
        $dots       = $settings['map_dots'];
        $widget_id  = $this->get_id();

        $line_color = ! empty( $settings['arrow_line_color'] ) ? $settings['arrow_line_color'] : '#ffffff';
        $line_width = ! empty( $settings['arrow_line_width']['size'] ) ? floatval( $settings['arrow_line_width']['size'] ) : 1.5;
        $show_head  = isset( $settings['arrow_show_head'] ) && $settings['arrow_show_head'] === 'yes';
        $marker_id  = 'mwd-arrow-' . esc_attr( $widget_id );

        $image_url = Group_Control_Image_Size::get_attachment_image_src(
            $map_image['id'],
            'map_image',
            $settings
        );
        if ( ! $image_url ) {
            $image_url = $map_image['url'];
        }
        ?>
        <div class="map-wrapper" id="map-wrapper-<?php echo esc_attr( $widget_id ); ?>">

            <div class="map-img">
                <img src="<?php echo esc_url( $image_url ); ?>"
                     alt="<?php echo esc_attr__( 'Map', 'drillcorp-core' ); ?>">
            </div>

            <?php /* SVG overlay – lines are injected here by JS */ ?>
            <svg class="map-lines-svg"
                 xmlns="http://www.w3.org/2000/svg"
                 aria-hidden="true"
                 focusable="false">
                <defs>
                    <marker id="<?php echo esc_attr( $marker_id ); ?>"
                            markerWidth="8"
                            markerHeight="5"
                            refX="8"
                            refY="2.5"
                            orient="auto"
                            markerUnits="userSpaceOnUse">
                        <polygon points="0 0, 8 2.5, 0 5"
                                 fill="<?php echo esc_attr( $line_color ); ?>"/>
                    </marker>
                </defs>
            </svg>

            <?php if ( ! empty( $dots ) ) : ?>
                <?php foreach ( $dots as $idx => $dot ) :
                    $pos_x          = isset( $dot['dot_position_x']['size'] ) ? floatval( $dot['dot_position_x']['size'] ) : 50;
                    $pos_y          = isset( $dot['dot_position_y']['size'] ) ? floatval( $dot['dot_position_y']['size'] ) : 50;
                    $dot_color      = ! empty( $dot['dot_color'] ) ? $dot['dot_color'] : '#ACFF2F';
                    $dot_label      = ! empty( $dot['dot_label'] ) ? $dot['dot_label'] : '';
                    $dot_sub_label  = ! empty( $dot['dot_sub_label'] ) ? $dot['dot_sub_label'] : '';
                    $label_offset_x = isset( $dot['label_offset_x']['size'] ) ? intval( $dot['label_offset_x']['size'] ) : -120;
                    $label_offset_y = isset( $dot['label_offset_y']['size'] ) ? intval( $dot['label_offset_y']['size'] ) : -80;
                    $arrow_img      = ! empty( $dot['arrow_image']['url'] ) ? $dot['arrow_image']['url'] : '';
                    $arrow_width    = isset( $dot['arrow_image_width']['size'] ) ? intval( $dot['arrow_image_width']['size'] ) : 80;
                    $arrow_pos_x    = isset( $dot['arrow_pos_x']['size'] ) ? intval( $dot['arrow_pos_x']['size'] ) : 0;
                    $arrow_pos_y    = isset( $dot['arrow_pos_y']['size'] ) ? intval( $dot['arrow_pos_y']['size'] ) : 0;
                    $arrow_rotation = isset( $dot['arrow_rotation']['size'] ) ? floatval( $dot['arrow_rotation']['size'] ) : 0;
                    $has_arrow_img  = ! empty( $arrow_img );
                ?>

                <?php /* ── Dot ── */ ?>
                <div class="map-single-dot"
                     data-index="<?php echo esc_attr( $idx ); ?>"
                     data-has-arrow-img="<?php echo $has_arrow_img ? '1' : '0'; ?>"
                     style="left:<?php echo esc_attr( $pos_x ); ?>%;top:<?php echo esc_attr( $pos_y ); ?>%;">
                    <span class="map-dot-inner"
                          style="background-color:<?php echo esc_attr( $dot_color ); ?>;
                                 box-shadow:0 0 0 0 <?php echo esc_attr( $dot_color ); ?>;"></span>
                    <span class="map-dot-pulse"
                          style="background-color:<?php echo esc_attr( $dot_color ); ?>;"></span>
                </div>

                <?php /* ── Label (separate element, positioned by offset) ── */ ?>
                <?php if ( $dot_label ) : ?>
                <div class="map-dot-label-wrap"
                     data-index="<?php echo esc_attr( $idx ); ?>"
                     style="left:calc(<?php echo esc_attr( $pos_x ); ?>% + <?php echo esc_attr( $label_offset_x ); ?>px);
                            top:calc(<?php echo esc_attr( $pos_y ); ?>% + <?php echo esc_attr( $label_offset_y ); ?>px);">
                    <span class="map-dot-label">
                        <span class="map-dot-label-title"><?php echo esc_html( $dot_label ); ?></span>
                        <?php if ( $dot_sub_label ) : ?>
                        <span class="map-dot-label-sub"><?php echo esc_html( $dot_sub_label ); ?></span>
                        <?php endif; ?>
                    </span>
                </div>
                <?php endif; ?>

                <?php /* ── Custom arrow image (JS will position & rotate it) ── */ ?>
                <?php if ( $has_arrow_img ) : ?>
                <img class="map-dot-arrow-img"
                     data-dot-index="<?php echo esc_attr( $idx ); ?>"
                     data-pos-x="<?php echo esc_attr( $arrow_pos_x ); ?>"
                     data-pos-y="<?php echo esc_attr( $arrow_pos_y ); ?>"
                     data-rotation="<?php echo esc_attr( $arrow_rotation ); ?>"
                     src="<?php echo esc_url( $arrow_img ); ?>"
                     alt=""
                     aria-hidden="true"
                     style="width:<?php echo esc_attr( $arrow_width ); ?>px; display:none;">
                <?php endif; ?>

                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <script>
        /* jshint ignore:start */
        (function () {
            var WRAPPER_ID = 'map-wrapper-<?php echo esc_js( $widget_id ); ?>';
            var MARKER_ID  = '<?php echo esc_js( $marker_id ); ?>';
            var LINE_COLOR = '<?php echo esc_js( $line_color ); ?>';
            var LINE_W     = <?php echo (float) $line_width; ?>;
            var SHOW_HEAD  = <?php echo $show_head ? 'true' : 'false'; ?>;

            function getWrapper() {
                return document.getElementById( WRAPPER_ID );
            }

            /* Draw SVG line from label centre → dot centre for dots without a custom arrow image */
            function drawLines( wrapper ) {
                var svg = wrapper.querySelector( '.map-lines-svg' );
                if ( ! svg ) return;

                svg.querySelectorAll( 'line' ).forEach( function ( el ) { el.remove(); } );

                var wRect = wrapper.getBoundingClientRect();

                wrapper.querySelectorAll( '.map-single-dot' ).forEach( function ( dot ) {
                    if ( dot.dataset.hasArrowImg === '1' ) return;

                    var idx   = dot.dataset.index;
                    var label = wrapper.querySelector( '.map-dot-label-wrap[data-index="' + idx + '"]' );
                    if ( ! label ) return;

                    var dRect = dot.getBoundingClientRect();
                    var lRect = label.getBoundingClientRect();

                    var dx = dRect.left + dRect.width  / 2 - wRect.left;
                    var dy = dRect.top  + dRect.height / 2 - wRect.top;
                    var lx = lRect.left + lRect.width  / 2 - wRect.left;
                    var ly = lRect.top  + lRect.height / 2 - wRect.top;

                    var ddx  = dx - lx, ddy = dy - ly;
                    var dist = Math.sqrt( ddx * ddx + ddy * ddy );
                    if ( dist < 2 ) return;
                    var nx = ddx / dist, ny = ddy / dist;

                    /* Pull start point back from label edge */
                    var lblPad = Math.min( lRect.width, lRect.height ) / 2 + 6;
                    var x1 = lx + nx * lblPad;
                    var y1 = ly + ny * lblPad;

                    /* Line end: dot centre (dot visually overlaps the arrowhead tip) */
                    var x2 = dx;
                    var y2 = dy;

                    var line = document.createElementNS( 'http://www.w3.org/2000/svg', 'line' );
                    line.setAttribute( 'x1', x1 ); line.setAttribute( 'y1', y1 );
                    line.setAttribute( 'x2', x2 ); line.setAttribute( 'y2', y2 );
                    line.setAttribute( 'stroke', LINE_COLOR );
                    line.setAttribute( 'stroke-width', LINE_W );
                    if ( SHOW_HEAD ) {
                        line.setAttribute( 'marker-end', 'url(#' + MARKER_ID + ')' );
                    }
                    svg.appendChild( line );
                } );
            }

            /*
             * Position each custom arrow image so its LEFT edge starts at the dot centre
             * (+ optional X/Y offset), then rotate it to point toward the label.
             * transform-origin: 0% 50%  →  pivot = left-centre of the image = dot centre.
             */
            function positionArrows( wrapper ) {
                var wRect = wrapper.getBoundingClientRect();

                wrapper.querySelectorAll( '.map-dot-arrow-img' ).forEach( function ( img ) {
                    var idx   = img.dataset.dotIndex;
                    var dot   = wrapper.querySelector( '.map-single-dot[data-index="' + idx + '"]' );
                    var label = wrapper.querySelector( '.map-dot-label-wrap[data-index="' + idx + '"]' );
                    if ( ! dot || ! label ) return;

                    var dRect = dot.getBoundingClientRect();
                    var lRect = label.getBoundingClientRect();

                    /* Dot centre in wrapper coordinates */
                    var dx = dRect.left + dRect.width  / 2 - wRect.left;
                    var dy = dRect.top  + dRect.height / 2 - wRect.top;

                    /* Label centre in wrapper coordinates */
                    var lx = lRect.left + lRect.width  / 2 - wRect.left;
                    var ly = lRect.top  + lRect.height / 2 - wRect.top;

                    /* User-defined offset from dot centre */
                    var posX = parseFloat( img.dataset.posX ) || 0;
                    var posY = parseFloat( img.dataset.posY ) || 0;

                    /* Arrow start point = dot centre + user offset */
                    var startX = dx + posX;
                    var startY = dy + posY;

                    /* Auto-angle from start point toward label + optional manual offset */
                    var autoAngle   = Math.atan2( ly - startY, lx - startX ) * ( 180 / Math.PI );
                    var manualAngle = parseFloat( img.dataset.rotation ) || 0;
                    var angle       = autoAngle + manualAngle;

                    img.style.position        = 'absolute';
                    img.style.left            = startX + 'px';
                    img.style.top             = startY + 'px';
                    /* translateY(-50%) centres the image height on startY; rotate pivots from left edge */
                    img.style.transformOrigin = '0% 50%';
                    img.style.transform       = 'translateY(-50%) rotate(' + angle + 'deg)';
                    img.style.display        = 'block';
                } );
            }

            function init() {
                var wrapper = getWrapper();
                if ( ! wrapper ) return;
                drawLines( wrapper );
                positionArrows( wrapper );
            }

            /* Initial run */
            if ( document.readyState === 'loading' ) {
                document.addEventListener( 'DOMContentLoaded', function () {
                    requestAnimationFrame( init );
                } );
            } else {
                requestAnimationFrame( init );
            }

            /* Re-draw on resize */
            window.addEventListener( 'resize', function () {
                requestAnimationFrame( init );
            } );

            /* Elementor editor live refresh */
            if ( window.elementorFrontend ) {
                elementorFrontend.hooks.addAction(
                    'frontend/element_ready/map-with-dot-widget.default',
                    function () { requestAnimationFrame( init ); }
                );
            }
        } )();
        /* jshint ignore:end */
        </script>
        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Map_With_Dot_Widget() );
