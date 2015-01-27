<?php
/**
 * WP Admin Widget
 * 
 * http://en.michaeluno.jp/admin-page-framework/
 * Copyright (c) 2015 Michael Uno; Licensed GPLv2
 * 
 */

/**
 * Creates a widget.
 * 
 * @since   0.0.1
 */
class WPAdminButtons_Widget extends WPAdminButtons_AdminPageFramework_Widget {
    
    /**
     * The user constructor.
     * 
     * Alternatively you may use start_{instantiated class name} method.
     */
    public function start() {}
    
    /**
     * Sets up arguments.
     * 
     * Alternatively you may use set_up_{instantiated class name} method.
     */
    public function setUp() {

        $this->setArguments( 
            array(
                'description'   => __( 'Displays buttons with the style used in the WordPress administration area.', 'wp-admin-buttons' ),
            ) 
        );
    
    }    

    /**
     * Sets up the form.
     * 
     * Alternatively you may use load_{instantiated class name} method.
     */
    public function load( $oAdminWidget ) {
        
        $this->addSettingFields(
            array(
                'field_id'      => 'title',
                'type'          => 'text',
                'title'         => __( 'Widget Title', 'wp-admin-buttons' ),
            ),        
            array(
                'field_id'      => 'label',
                'type'          => 'text',
                'title'         => __( 'Button Label', 'wp-admin-buttons' ),
                'default'       => __( 'Download', 'wp-admin-buttons' )
            ),
            array(
                'field_id'      => 'href',
                'type'          => 'text',
                'title'         => __( 'Link URL', 'wp-admin-buttons' ),
            ),
            array(
                'field_id'      => 'title_attribute',
                'type'          => 'text',
                'title'         => __( 'Title Attribute', 'wp-admin-buttons' )
                    . ' (' . __( 'optional', 'wp-admin-buttons' ) . ')',
                'description'   => __( 'The text that appeaser on mouse hover.', 'wp-admin-buttons' ),
            ),
            array(
                'field_id'      => 'rel',
                'type'          => 'text',
                'title'         => __( 'Rel Attribute', 'wp-admin-buttons' )
                    . ' (' . __( 'optional', 'wp-admin-buttons' ) . ')',
                'description'   => 'e.g. <code>nofollow</code>',
            ),            
            array(
                'field_id'      => 'target',
                'type'          => 'text',
                'title'         => __( 'Target Attribute', 'wp-admin-buttons' )
                    . ' (' . __( 'optional', 'wp-admin-buttons' ) . ')',
                'description'   => 'e.g. <code>_blank</code>',
            ),                        
            array(
                'field_id'      => 'size',
                'type'          => 'select',
                'title'         => __( 'Size', 'wp-admin-buttons' ),
                'label'         => array(
                    'large'        => __( 'Large', 'wp-admin-buttons' ),
                    'medium'       => __( 'Medium', 'wp-admin-buttons' ),
                    'small'        => __( 'Small', 'wp-admin-buttons' ),
                ),
                'default'       => 'medium',
            ),     
            array(
                'field_id'      => 'type',
                'type'          => 'radio',
                'title'         => __( 'Type', 'wp-admin-buttons' ),
                'label'         => array(
                    'button-primary'   => __( 'Primary', 'wp-admin-buttons' ),
                    'button-secondary' => __( 'Secondary', 'wp-admin-buttons' ),
                ),
                'default'       => 'button-primary',
            ),  
            array(
                'field_id'      => 'background_color',
                'type'          => 'color',
                'title'         => __( 'Background Color', 'wp-admin-buttons' )
                    . ' (' . __( 'optional', 'wp-admin-buttons' ) . ')',
                'default'       => '', // prevent the value 'transparent' to be set
                'description'   => 'e.g. <code>transparent</code>', 
            ),
            array(
                'field_id'      => 'border_color',
                'type'          => 'color',
                'title'         => __( 'Border Color', 'wp-admin-buttons' )
                    . ' (' . __( 'optional', 'wp-admin-buttons' ) . ')',                
               'default'   => '', // prevent the value 'transparent' to be set
            ),                         
            array(
                'field_id'      => 'label_color',
                'type'          => 'color',
                'title'         => __( 'Label Color', 'wp-admin-buttons' )
                    . ' (' . __( 'optional', 'wp-admin-buttons' ) . ')',
                'default'   => '', // prevent the value 'transparent' to be set                    
            ), 
            array()
        );        

        
    }
    
    /**
     * Validates the submitted form data.
     * 
     * Alternatively you may use validation_{instantiated class name} method.
     * @return      array       The filtered submitted user input array.
     */
    public function validate( $aSubmit, $aStored, $oAdminWidget ) {
        
        // Uncomment the following line to check the submitted value.
        // AdminPageFramework_Debug::log( $aSubmit );
        
        return $aSubmit;
        
    }    
    
    /**
     * Print out the contents in the front-end.
     * 
     * Alternatively you may use the content_{instantiated class name} method.
     * @return      string      The content output.
     */
    public function content( $sContent, $aArguments, $aFormData ) {
        
        return $sContent
            . getWPAdminButton( 
                array( 
                    // the plugin output function needs the 'title' key, not title_attribute
                    'title' => isset( $aFormData['title_attribute'] ) ? $aFormData['title_attribute'] : '',
                )
                + $aFormData 
                + $aArguments 
            )
            ;

    }
        
}