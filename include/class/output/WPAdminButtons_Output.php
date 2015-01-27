<?php
/**
 * WP Admin Widget
 * 
 * http://en.michaeluno.jp/admin-page-framework/
 * Copyright (c) 2015 Michael Uno; Licensed GPLv2
 * 
 */

/**
 * Handles rendering the HTML output.
 * 
 * @since   0.0.1
 */
class WPAdminButtons_Output {
    
    /**
     * Stores the default arguments. 
     */
    public $aArguments = array(
        'label'     => 'Download',  // the text label
        'title'     => '',          // title attribute
        'size'      => 'medium',          // accepts 'large', 'small', 'medium'
        'type'      => 'button-primary',   // 'button-primary' or 'button-secondary'
        'label_color'     => '',
        'background_color'     => '',
        'border_color'     => '',
        
        // Attributes
        'href'      => '',
        'class'     => '',      // additional class attributes        
        'style'     => '',      // (array|string) inline style
        'target'    => '',      // e.g. '_balank'
        'rel'       => '',      // e.g. 'nofollow'
    );
    
    /**
     * Sets up hooks and properties.
     */
    public function __construct( $asArguments ) {
        
        $this->aArguments = $this->_formatArguments( 
            is_array( $asArguments ) 
                ? $asArguments 
                : array( $asArguments )
        );
        
    }
    
        private function _formatArguments( array $aArguments ) {
            
            $aArguments = $aArguments + $this->aArguments;
            return $aArguments;
            
        }
    
    /**
     * Returns the HTML output.
     */
    public function get() {
        
        // $_oUtil = new WPAdminButtons_AminPageFramework_WPUtility;
        $_sDivTagStyle = isset( $this->aArguments['style']['div'] )
            ? $this->aArguments['style']['div']
            : '';
        $_sATagStyle = isset( $this->aArguments['style']['a'] )
            ? $this->aArguments['style']['a']
            : $this->aArguments['style'];
        $_sType = esc_attr( $this->aArguments['type'] );

        switch( $this->aArguments['size'] ) {
            case 'large':
                $this->aArguments['class'] .= ' button-hero';
            break;
            case 'small':
                $this->aArguments['class'] .= ' button-small';
            break;
            case 'medium':
            default:
            break;
        }
        
        if ( trim( $this->aArguments['label_color'] ) ) {
            $_sATagStyle .= "; color:{$this->aArguments['label_color']}";
        }
        if ( trim( $this->aArguments['background_color'] ) ) {
            $_sATagStyle .= "; background-color:{$this->aArguments['background_color']}";
        }               
        if ( trim( $this->aArguments['border_color'] ) ) {
            $_sATagStyle .= "; border-color:{$this->aArguments['border_color']}";
        }               
        
        return "<div class='wp-core-ui'>"
                . "<div class='welcome-panel'" 
                        . " style='" . esc_attr( $_sDivTagStyle ) . "'"
                    . ">"
                    . "<a" 
                        . " class='button {$_sType}" . esc_attr( $this->aArguments['class'] )  . "'"
                        . " href='" . esc_attr( $this->aArguments['href'] )  . "'"
                        . " title='" . esc_attr( $this->aArguments['title'] )  . "'"
                        . " style='" . esc_attr( $_sATagStyle )  . "'"
                        . " target='" . esc_attr( $this->aArguments['target'] )  . "'"
                        . " rel='" . esc_attr( $this->aArguments['rel'] )  . "'"
                    . ">"
                        . $this->aArguments['label']
                    . "</a>"
                . "</div>"  // button
            . "</div>"  // wp-core-ui
        ;
        
    }
        
}