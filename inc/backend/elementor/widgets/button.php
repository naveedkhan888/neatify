<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Widget Name: Button with Icon
 */
class Neatify_Button extends Widget_Base {

    public function get_name() {
        return 'ibutton';
    }

    public function get_title() {
        return __( 'XP Button', 'neatify' );
    }

    public function get_icon() {
        return 'eicon-button';
    }

    public function get_categories() {
        return [ 'category_neatify' ];
    }

    public static function get_button_color() {
        return [
            'main'   => __( 'Main Color', 'neatify' ),
            'dark'   => __( 'Dark Color', 'neatify' ),
            'light'  => __( 'Light Color', 'neatify' ),
            'border' => __( 'Border Color', 'neatify' ),
        ];
    }

    protected function register_controls() {
        // Content Section
        $this->start_controls_section(
            'button_section',
            [
                'label' => __( 'Button', 'neatify' ),
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __( 'Alignment', 'neatify' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left'    => [
                        'title' => __( 'Left', 'neatify' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'neatify' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'neatify' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __( 'Justify', 'neatify' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'prefix_class' => 'elementor%s-align-',
                'default' => '',
            ]
        );

        $this->add_control(
            'btn_style',
            [
                'label' => __( 'Style Color', 'neatify' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'main',
                'options' => self::get_button_color(),
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => __( 'Label', 'neatify' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Click here', 'neatify' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        // Icon Controls
        $this->add_control(
            'selected_icon',
            [
                'label' => __( 'Icon', 'neatify' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'skin' => 'inline',
                'label_block' => false,
            ]
        );

        $this->add_control(
            'icon_position',
            [
                'label' => __( 'Icon Position', 'neatify' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left' => __( 'Before', 'neatify' ),
                    'right' => __( 'After', 'neatify' ),
                ],
                'condition' => [
                    'selected_icon[value]!' => '',
                ],
            ]
        );

        $this->add_control(
            'icon_spacing',
            [
                'label' => __( 'Icon Spacing', 'neatify' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .xptf-btn .btn-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .xptf-btn .btn-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'selected_icon[value]!' => '',
                ],
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __( 'Link', 'neatify' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'neatify' ),
                'default' => [
                    'url' => '#',
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'General', 'neatify' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'btn_padding',
            [
                'label' => 'Padding',
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .xptf-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_radius',
            [
                'label' => __( 'Border Radius', 'neatify' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .xptf-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typography',
                'selector' => '{{WRAPPER}} .xptf-btn',
            ]
        );

        // Icon Style
        $this->add_control(
            'icon_size',
            [
                'label' => __( 'Icon Size', 'neatify' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .xptf-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .xptf-btn svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'selected_icon[value]!' => '',
                ],
            ]
        );

        // Hover tabs
        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => __( 'Normal', 'neatify' ),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => __( 'Text Color', 'neatify' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .xptf-btn' => 'fill: {{VALUE}}; color: {{VALUE}};',
                    '{{WRAPPER}} .xptf-btn svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bg',
            [
                'label' => __( 'Background Color', 'neatify' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xptf-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .xptf-btn',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => __( 'Hover', 'neatify' ),
            ]
        );

        $this->add_control(
            'hover_color',
            [
                'label' => __( 'Text Color', 'neatify' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xptf-btn:hover, {{WRAPPER}} .xptf-btn:focus' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .xptf-btn:hover svg, {{WRAPPER}} .xptf-btn:focus svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_hover_color',
            [
                'label' => __( 'Background Color', 'neatify' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xptf-btn:hover, {{WRAPPER}} .xptf-btn:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_hover_color',
            [
                'label' => __( 'Border Color', 'neatify' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xptf-btn:hover, {{WRAPPER}} .xptf-btn:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_animation',
            [
                'label' => __( 'Hover Animation', 'neatify' ),
                'type' => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( ! empty( $settings['link']['url'] ) ) {
            $this->add_render_attribute( 'button', 'href', $settings['link']['url'] );

            if ( $settings['link']['is_external'] ) {
                $this->add_render_attribute( 'button', 'target', '_blank' );
            }

            if ( $settings['link']['nofollow'] ) {
                $this->add_render_attribute( 'button', 'rel', 'nofollow' );
            }
        }

        $this->add_render_attribute( 'button', 'class', 'xptf-btn' );
        $this->add_render_attribute( 'button', 'class', 'xptf-btn-' . $settings['btn_style'] );

        if ( $settings['hover_animation'] ) {
            $this->add_render_attribute( 'button', 'class', 'elementor-animation-' . $settings['hover_animation'] );
        }

        ?>
        <div class="xp-button">
            <a <?php echo wp_kses_post($this->get_render_attribute_string( 'button' )); ?>>
                <?php if ( ! empty( $settings['selected_icon']['value'] ) && $settings['icon_position'] === 'left' ) : ?>
                    <span class="btn-icon-left">
                        <?php Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </span>
                <?php endif; ?>
                
                <span class="btn-text"><?php echo esc_html( $settings['text'] ); ?></span>
                
                <?php if ( ! empty( $settings['selected_icon']['value'] ) && $settings['icon_position'] === 'right' ) : ?>
                    <span class="btn-icon-right">
                        <?php Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </span>
                <?php endif; ?>
            </a>
        </div>
        <?php
    }
}

Plugin::instance()->widgets_manager->register( new Neatify_Button() );