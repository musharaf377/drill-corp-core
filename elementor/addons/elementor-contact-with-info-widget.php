<?php

/**
 * Elementor Widget
 * @package Drillcorp
 * @since 1.0.0
 */

namespace Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Drillcorp_Contact_With_Info_Widget extends Widget_Base
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
        return 'drillcorp-contact-with-info-widget';
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
        return esc_html__('Contact With Info', 'drillcorp-core');
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
        return 'dashicons-buddicons-pm';
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
        // Content Tab
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'drillcorp-core'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'contact_us_text',
            [
                'label' => esc_html__('Contact Us Text', 'drillcorp-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Contact US', 'drillcorp-core'),
                'placeholder' => esc_html__('Enter contact text', 'drillcorp-core'),
            ]
        );

        $this->add_control(
            'contact_link',
            [
                'label' => esc_html__('Contact Link', 'drillcorp-core'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'drillcorp-core'),
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );

        $this->add_control(
            'person_image',
            [
                'label' => esc_html__('Person Image', 'drillcorp-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => get_template_directory_uri() . '/assets/img/contact-info-thumb.png',
                ],
            ]
        );

        $this->add_control(
            'person_name',
            [
                'label' => esc_html__('Name', 'drillcorp-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Tansu Ozerkan', 'drillcorp-core'),
                'placeholder' => esc_html__('Enter name', 'drillcorp-core'),
            ]
        );

        $this->add_control(
            'person_designation',
            [
                'label' => esc_html__('Designation', 'drillcorp-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Web Developer', 'drillcorp-core'),
                'placeholder' => esc_html__('Enter designation', 'drillcorp-core'),
            ]
        );

        $this->add_control(
            'location_text',
            [
                'label' => esc_html__('Location Text', 'drillcorp-core'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Location', 'drillcorp-core'),
                'placeholder' => esc_html__('Enter location', 'drillcorp-core'),
            ]
        );

        // Social Profiles Repeater
        $this->add_control(
            'social_profiles',
            [
                'label' => esc_html__('Social Profiles', 'drillcorp-core'),
                'type' => Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'social_icon',
                        'label' => esc_html__('Social Icon', 'drillcorp-core'),
                        'type' => Controls_Manager::SELECT,
                        'options' => [
                            'linkedin' => esc_html__('LinkedIn', 'drillcorp-core'),
                            'twitter' => esc_html__('Twitter', 'drillcorp-core'),
                            'facebook' => esc_html__('Facebook', 'drillcorp-core'),
                            'instagram' => esc_html__('Instagram', 'drillcorp-core'),
                        ],
                        'default' => 'linkedin',
                    ],
                    [
                        'name' => 'social_url',
                        'label' => esc_html__('Social URL', 'drillcorp-core'),
                        'type' => Controls_Manager::TEXT,
                        'placeholder' => esc_html__('Enter URL', 'drillcorp-core'),
                    ],
                ],
                'default' => [
                    [
                        'social_icon' => 'linkedin',
                        'social_url' => '',
                    ],
                    [
                        'social_icon' => 'twitter',
                        'social_url' => '',
                    ],
                ],
                'title_field' => '{{{ social_icon }}}',
            ]
        );

        $this->end_controls_section();

        // Style Tab - Contact Link
        $this->start_controls_section(
            'style_contact_link_section',
            [
                'label' => esc_html__('Contact Link', 'drillcorp-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'contact_link_width',
            [
                'label' => esc_html__('Width', 'drillcorp-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .contact-us-link' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'contact_link_color',
            [
                'label' => esc_html__('Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-us-link' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'contact_link_hover_color',
            [
                'label' => esc_html__('Hover Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-us-link:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'contact_link_typography',
                'selector' => '{{WRAPPER}} .contact-us-link',
            ]
        );

        $this->end_controls_section();

        // Style Tab - Contact Info Content
        $this->start_controls_section(
            'style_contact_info_section',
            [
                'label' => esc_html__('Contact Info', 'drillcorp-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'contact_info_bg_color',
            [
                'label' => esc_html__('Background Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-information-wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'contact_info_width',
            [
                'label' => esc_html__('Width', 'drillcorp-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .contact-information-wrapper' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'contact_info_height',
            [
                'label' => esc_html__('Height', 'drillcorp-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .contact-information-wrapper' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'person_name_color',
            [
                'label' => esc_html__('Name Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-info-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'person_name_typography',
                'selector' => '{{WRAPPER}} .contact-info-name',
            ]
        );

        $this->add_control(
            'person_designation_color',
            [
                'label' => esc_html__('Designation Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-info-designation' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'person_designation_typography',
                'selector' => '{{WRAPPER}} .contact-info-designation',
            ]
        );

        $this->add_control(
            'location_color',
            [
                'label' => esc_html__('Location Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-info-location' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'location_typography',
                'selector' => '{{WRAPPER}} .contact-info-location',
            ]
        );

        $this->add_control(
            'heading_image',
            [
                'label' => esc_html__('Person Image', 'drillcorp-core'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'person_image_width',
            [
                'label' => esc_html__('Width', 'drillcorp-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .contact-person-thumb' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'person_image_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'drillcorp-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .contact-person-thumb' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab - Social Icons
        $this->start_controls_section(
            'style_social_icons_section',
            [
                'label' => esc_html__('Social Icons', 'drillcorp-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'social_icon_color',
            [
                'label' => esc_html__('Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-info-social a svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .contact-info-social a img' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'social_icon_hover_color',
            [
                'label' => esc_html__('Hover Color', 'drillcorp-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .contact-info-social a:hover svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .contact-info-social a:hover img' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'social_icon_size',
            [
                'label' => esc_html__('Size', 'drillcorp-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .contact-info-social a svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'social_icons_spacing',
            [
                'label' => esc_html__('Spacing Between Icons', 'drillcorp-core'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .contact-info-social a:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab - Background Image
        $this->start_controls_section(
            'style_background_image_section',
            [
                'label' => esc_html__('Background Image', 'drillcorp-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'background_image',
            [
                'label' => esc_html__('Background Image', 'drillcorp-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => get_template_directory_uri() . '/assets/img/contact-info-bg.png',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render Elementor widget output on the frontend.
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // Get values from controls
        $contact_us_text = $settings['contact_us_text'];
        $contact_link = $settings['contact_link']['url'] ?? '#';
        $person_image_url = $settings['person_image']['url'] ?? get_template_directory_uri() . '/assets/img/contact-info-thumb.png';
        $person_name = $settings['person_name'];
        $person_designation = $settings['person_designation'];
        $location_text = $settings['location_text'];
        $social_profiles = $settings['social_profiles'];
        $background_image_url = $settings['background_image']['url'] ?? get_template_directory_uri() . '/assets/img/contact-info-bg.png';

        // Build link attributes
        $link_attributes = [];
        if (!empty($settings['contact_link']['is_external'])) {
            $link_attributes[] = 'target="_blank"';
        }
        if (!empty($settings['contact_link']['nofollow'])) {
            $link_attributes[] = 'rel="nofollow"';
        }
        $link_attributes_string = implode(' ', $link_attributes);

?>
        <div class="contact-information">
            <a href="<?php echo esc_url($contact_link); ?>" class="contact-us-link" <?php echo $link_attributes_string; ?>><?php echo esc_html($contact_us_text); ?> <?php echo drillcorp_get_svg_icon('down_angle'); ?></a>
            <div class="contact-information-content">
                <div class="contact-information-wrapper">
                    <img class="contact-info-bg" src="<?php echo esc_url($background_image_url); ?>" alt="">
                    <div class="contact-info-content">
                        <img src="<?php echo esc_url($person_image_url); ?>" alt="<?php echo esc_attr($person_name); ?>" class="contact-person-thumb">
                        <h3 class="contact-info-name"><?php echo esc_html($person_name); ?></h3>
                        <p class="contact-info-designation"><?php echo esc_html($person_designation); ?></p>
                        <p class="contact-info-location"><?php echo esc_html($location_text); ?></p>
                        <?php if (!empty($social_profiles)) : ?>
                            <div class="contact-info-social">
                                <?php foreach ($social_profiles as $profile) : ?>
                                    <a href="<?php echo esc_url($profile['social_url']); ?>"><?php echo drillcorp_get_svg_icon($profile['social_icon']); ?></a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new Drillcorp_Contact_With_Info_Widget());
