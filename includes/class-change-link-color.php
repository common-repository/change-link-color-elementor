<?php
/**
 * Main Class
 * 
 * @author  Mostafijur Rahman
 * @since   1.0.0
 * @package change-link-color-elementor
 */ 

/**
 * Exit if directly accessing 
 * 
 */  
if( ! defined( 'ABSPATH' ) ){
    exit;
}


if( ! class_exists( 'Change_Link_Color_Setup' )){
    /**
     * Change link color setup class
     * 
     *  */ 
    class Change_Link_Color_Setup{
        
        public function __construct(){
            add_action( 'wp_enqueue_scripts', array( $this, 'frontend_scripts' ) );
            add_action( 'elementor/element/text-editor/section_editor/before_section_end', array( $this, 'widget_extensions' ), 10, 2 );
            add_action( 'elementor/widget/before_render_content', array( $this, 'before_render_options' ), 10, 1 );
        }

        /**
         * After layout callback elementor
         * 
         * @return void
         */
        public function widget_extensions( $element, $args ){
            $element->add_control(
                'change_link_color',
                [
                    'label'       => __( 'Change Link Color', 'change-link-color-elementor' ),
                    'type'        => Elementor\Controls_Manager::COLOR,
                    'dynamic'     => [
                      'active' => true,
                    ],
                    'selectors'   => [
                        '{{WRAPPER}} a' => 'color: {{VALUE}};',
                  ],
                ]
            );
			$element->add_control(
                'change_link_color_hover',
                [
                    'label'       => __( 'Hover color', 'change-link-color-elementor' ),
                    'type'        => Elementor\Controls_Manager::COLOR,
                    'dynamic'     => [
                      'active' => true,
                    ],
                    'selectors'   => [
                        '{{WRAPPER}} a:hover' => 'color: {{VALUE}};',
                  ],
                ]
            );
        }

        /**
         * Elementor widget render function
         * 
         */
        public function before_render_options( $widget ) {
            $settings = $widget->get_settings();
            if ( isset( $settings['change_link_color'] ) && ! empty($settings['change_link_color']) ) {
                wp_enqueue_script( 'change-link-color-elementor' );
                $widget->add_render_attribute( '_wrapper', array(
					'class' => 'change-links-color',
				) );
            }
        }

        /**
         * Elementor widget frontend scripts
         * 
         */
        public function frontend_scripts() {
            wp_register_script( 'change-link-color-elementor', plugins_url( 'assets/js/change-link-color.js', plugin_dir_path( __FILE__ ) ), array( 'jquery' ), Change_Link_Color_Elementor::VERSION, true );
        }
    }
}

new Change_Link_Color_Setup();


