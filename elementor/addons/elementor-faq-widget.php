<?php
/**
 * Elementor Widget
 * @package Appside
 * @since 1.0.0
 */

namespace Elementor;
class Cubeslimited_Accordion_One extends Widget_Base {

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
    public function get_name() {
        return 'cubeslimited-faq-one-widget';
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the widget keywords.
     *
     * @since 1.0.10
     * @access public
     *
     * @return array Widget keywords.
     */

    public function get_keywords()
    {
        return ['ir-tech','cubeslimited','accordion'];
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
    public function get_title() {
        return esc_html__( 'FAQ', 'cubeslimited-core' );
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
    public function get_icon() {
        return 'eicon-editor-list-ul';
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
    public function get_categories() {
        return [ 'cubeslimited_widgets' ];
    }

    /**
     * Register Elementor widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

        $this->start_controls_section(
            'settings_section',
            [
                'label' => esc_html__( 'General Settingsdddd', 'cubeslimited-core' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new Repeater();

        $repeater->add_control('title',[
            'label'       => esc_html__( 'Title', 'cubeslimited-core' ),
            'type'        => Controls_Manager::TEXT,
            'description' => esc_html__( 'Enter title', 'cubeslimited-core' )
        ]);
        $repeater->add_control('description',[
            'label'       => esc_html__( 'Description', 'cubeslimited-core' ),
            'type'        => Controls_Manager::TEXTAREA,
            'description' => esc_html__( 'Enter description', 'cubeslimited-core' )
        ]);

        $this->add_control( 'accordion_items', [
            'label'       => esc_html__( 'Accordion Item', 'cubeslimited-core' ),
            'type'        => Controls_Manager::REPEATER,
            'default'     => [
                [
                    'title'        => esc_html__( 'How can I get started with Cubeslimited Advisors? How do I know if I qualify for your services?', 'cubeslimited-core' ),
                    'description' => esc_html__("All investment decisions at Cubeslimited Advisors are made in-house. As an independent investment advisor, we have the flexibility to select the opportunities from the broader investment universe across public equities, private shares, real estate, and mutual funds. Our investment philosophy emphasizes ethical investing, and that our clients' investments align with their values. We carefully screen for and seek to avoid industries such as alcohol, gambling, pornography, tobacco, and war-making.",'cubeslimited-core'),
                ]
            ],
            'fields'      => $repeater->get_controls()
        ] );

        $this->add_control(
            'initial_active_item',
            [
                'label' => esc_html__('Initial Active Item', 'cubeslimited-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => count($repeater->get_controls()) > 0 ? 10 : 10,
                'step' => 1,
                'default' => 1,
                'description' => esc_html__('Set which FAQ item should be open by default (1 = first item)', 'cubeslimited-core'),
            ]
        );

        $this->end_controls_section();

        // Style controls for FAQ widget
        
        // FAQ Card Style
        $this->start_controls_section(
            'faq_card_style_section',
            [
                'label' => esc_html__('FAQ Card Style', 'cubeslimited-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // Card background / border
        $this->add_control('faq_card_bg', [
            'label' => esc_html__('Background Color', 'cubeslimited-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .faq-card' => 'background-color: {{VALUE}};',
            ],
        ]);
        
        $this->add_control('faq_card_border_color', [
            'label' => esc_html__('Border Color', 'cubeslimited-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .faq-card' => 'border-color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'faq_card_border',
                'label' => esc_html__('Border', 'cubeslimited-core'),
                'selector' => '{{WRAPPER}} .faq-card',
            ]
        );

        $this->add_responsive_control(
            'faq_card_border_radius',
            [
                'label' => esc_html__('Border Radius', 'cubeslimited-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .faq-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Spacing controls
        $this->add_responsive_control(
            'faq_card_padding',
            [
                'label' => esc_html__('Card Padding', 'cubeslimited-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .faq-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'faq_card_margin_bottom',
            [
                'label' => esc_html__('Card Spacing (Bottom)', 'cubeslimited-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'rem', 'em'],
                'range' => [
                    'px' => ['min' => 0, 'max' => 200],
                ],
                'selectors' => [
                    '{{WRAPPER}} .faq-card' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Title Style
        $this->start_controls_section(
            'faq_title_style_section',
            [
                'label' => esc_html__('Title Style', 'cubeslimited-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // Title Typography and Color
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'faq_title_typography',
                'selector' => '{{WRAPPER}} .faq-card-header .faq-question',
            ]
        );

        $this->start_controls_tabs('faq_title_style_tabs');

        $this->start_controls_tab(
            'faq_title_normal',
            [
                'label' => esc_html__('Normal', 'cubeslimited-core'),
            ]
        );

        $this->add_control('faq_title_color', [
            'label' => esc_html__('Text Color', 'cubeslimited-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .faq-card-header .faq-question' => 'color: {{VALUE}};',
            ],
        ]);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'faq_title_hover',
            [
                'label' => esc_html__('Hover', 'cubeslimited-core'),
            ]
        );

        $this->add_control('faq_title_hover_color', [
            'label' => esc_html__('Text Color', 'cubeslimited-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .faq-card-header .faq-question:hover' => 'color: {{VALUE}};',
            ],
        ]);

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'faq_title_margin',
            [
                'label' => esc_html__('Title Margin', 'cubeslimited-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .faq-card-header h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'faq_title_padding',
            [
                'label' => esc_html__('Title Padding', 'cubeslimited-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .faq-card-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Description Style
        $this->start_controls_section(
            'faq_description_style_section',
            [
                'label' => esc_html__('Description Style', 'cubeslimited-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // Description Typography and Color
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'faq_desc_typography',
                'selector' => '{{WRAPPER}} .faq-card-body',
            ]
        );

        $this->add_control('faq_desc_color', [
            'label' => esc_html__('Text Color', 'cubeslimited-core'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .faq-card-body' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control(
            'faq_desc_padding',
            [
                'label' => esc_html__('Description Padding', 'cubeslimited-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .faq-card-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'faq_desc_margin',
            [
                'label' => esc_html__('Description Margin', 'cubeslimited-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .faq-card-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'faq_desc_padding',
            [
                'label' => esc_html__('Description Padding', 'cubeslimited-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .faq-card-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Icon Style
        $this->start_controls_section(
            'faq_icon_style_section',
            [
                'label' => esc_html__('Icon Style', 'cubeslimited-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'faq_icon_size',
            [
                'label' => esc_html__('Icon Size', 'cubeslimited-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => ['min' => 10, 'max' => 100],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 24,
                ],
                'selectors' => [
                    '{{WRAPPER}} .faq-arrow-wrap svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'faq_icon_color',
            [
                'label' => esc_html__('Icon Color', 'cubeslimited-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-arrow-wrap svg path' => 'stroke: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'faq_icon_spacing',
            [
                'label' => esc_html__('Icon Spacing', 'cubeslimited-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => ['min' => 0, 'max' => 100],
                ],
                'selectors' => [
                    '{{WRAPPER}} .faq-card-header a' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Active Card Style
        $this->start_controls_section(
            'faq_active_card_style_section',
            [
                'label' => esc_html__('Active Card Style', 'cubeslimited-core'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'faq_active_card_bg',
            [
                'label' => esc_html__('Active Card Background', 'cubeslimited-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-card.active' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'faq_active_card_border_color',
            [
                'label' => esc_html__('Active Card Border Color', 'cubeslimited-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-card.active' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'faq_active_title_color',
            [
                'label' => esc_html__('Active Title Color', 'cubeslimited-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-card.active .faq-card-header .faq-question' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'faq_active_icon_color',
            [
                'label' => esc_html__('Active Icon Color', 'cubeslimited-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .faq-card.active .faq-arrow-wrap' => 'background-color: {{VALUE}};',
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
    protected function render() {
        $settings = $this->get_settings_for_display();
        $accordion_items = $settings['accordion_items'];
        $initial_active = isset($settings['initial_active_item']) ? intval($settings['initial_active_item']) : 1;
        $random_number = mt_rand(999,999999);
        ?>
<div class="faq-accordion-wrapper" id="faq-wrapper-<?php echo esc_attr($random_number); ?>">
    <?php
            $a = 0;
            foreach ( $accordion_items as $item ):
                $item_index = $a + 1;
                $is_active = ($item_index === $initial_active);
                $active_class = $is_active ? ' active' : '';
                $display_style = $is_active ? ' style="display: block;"' : ' style="display: none;"';
                $aria_expanded = $is_active ? 'true' : 'false';
                $a++;
                ?>
    <div class="faq-card<?php echo esc_attr($active_class); ?>">
        <div class="faq-card-header" role="button" aria-expanded="<?php echo esc_attr($aria_expanded); ?>">
            <h5 class="mb-0">
                <a class="faq-question" tabindex="0">
                    <?php echo esc_html($item['title']); ?>
                    <span class="faq-arrow-wrap"><?php echo drilllcorp_get_svg_icon('down_angle'); ?></span>
                </a>
            </h5>
        </div>
        <div class="faq-card-body"<?php echo $display_style; ?>>
            <?php echo esc_html($item['description']); ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Cubeslimited_Accordion_One() );