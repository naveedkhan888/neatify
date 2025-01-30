<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Neatify_Dynamic_Title extends Widget_Base {

    public function get_name() {
        return 'neatify_dynamic_title';
    }

    public function get_title() {
        return __( 'Dynamic Title', 'neatify' );
    }

    public function get_icon() {
        return 'eicon-post-title';
    }

    public function get_categories() {
        return [ 'category_neatify' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_title',
            [
                'label' => __( 'Title', 'neatify' ),
            ]
        );

        $this->add_control(
            'html_tag',
            [
                'label' => __( 'HTML Tag', 'neatify' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'p' => 'p',
                    'span' => 'span',
                ],
                'default' => 'h1',
            ]
        );

        $this->add_control(
            'alignment',
            [
                'label' => __( 'Alignment', 'neatify' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
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
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .neatify-dynamic-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'color',
            [
                'label' => __( 'Text Color', 'neatify' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .neatify-dynamic-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'label' => __( 'Typography', 'neatify' ),
                'selector' => '{{WRAPPER}} .neatify-dynamic-title',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $tag = $settings['html_tag'];
        $title = get_the_title();
        
        echo "<{$tag} class='neatify-dynamic-title'>{$title}</{$tag}>";
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Neatify_Dynamic_Title() );
