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
        'size'      => 'medium',    // accepts 'large', 'small', 'medium'
        'type'      => 'button-primary',   // 'button-primary' or 'button-secondary'
        'label_color'       => '',
        'background_color'  => '',
        'border_color'      => '',
        
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
        
        $this->aArguments = $this->_getFormattedArguments( 
            is_array( $asArguments ) 
                ? $asArguments 
                : array( $asArguments )
        );
        
    }
        /**
         * Formats an argument array.
         * @return      array       The formatted argument array.
         */
        private function _getFormattedArguments( array $aArguments ) {
            
            $aArguments = $aArguments + $this->aArguments;
            return $aArguments;
            
        }
    
    /**
     * Returns the HTML output.
     */
    public function get() {
        
        $_sDivTagStyle = isset( $this->aArguments['style']['div'] )
            ? $this->aArguments['style']['div']
            : '';
        
        return "<div class='wp-core-ui'>"
                . "<div class='welcome-panel'" 
                        . " style='" . esc_attr( $_sDivTagStyle ) . "'"
                    . ">"
                    . "<a" 
                        . " class='" . $this->_getClassAttribute( $this->aArguments )  . "'"
                        . " href='" . esc_attr( $this->aArguments['href'] )  . "'"
                        . " title='" . esc_attr( $this->aArguments['title'] )  . "'"
                        . " style='" . esc_attr( $this->_getATagStyle( $this->aArguments ) )  . "'"
                        . " target='" . esc_attr( $this->aArguments['target'] )  . "'"
                        . " rel='" . esc_attr( $this->aArguments['rel'] )  . "'"
                    . ">"
                        . $this->aArguments['label']
                    . "</a>"
                . "</div>"  // button
            . "</div>"  // wp-core-ui
        ;
        
    }
 
        /**
         * Returns the inline CSS rules applied to the 'a' tag of the button.
         * 
         * @return      string      Inline CSS rules.
         */
        private function _getATagStyle( array $aArguments ) {

            $_sATagStyle = isset( $aArguments['style']['a'] )
                ? $aArguments['style']['a']
                : $aArguments['style'];    

            if ( trim( $aArguments['label_color'] ) ) {
                $_sATagStyle .= "; color:{$aArguments['label_color']}";
            }
            if ( trim( $aArguments['background_color'] ) ) {
                $_sATagStyle .= "; background-color:{$aArguments['background_color']}";
            }               
            if ( trim( $aArguments['border_color'] ) ) {
                $_sATagStyle .= "; border-color:{$aArguments['border_color']}";
            }               
            return $_sATagStyle;
            
        }        
        
        /**
         * 
         * @return      The calculated class attributes for the 'a' tab of the button.
         */
        private function _getClassAttribute( array $aArguments ) {

            $_sClassAttribute   = 'button'
                . ' ' . $aArguments['type'] 
                . ' ' . $this->_getSizeClassSelector( $aArguments['size'] )
                . ' ' . $aArguments['class'];
                
            return esc_attr( $_sClassAttribute );
            
        }        
            /**
             * Returns the class selector for the size.
             * @return      string      The size specific class selector.
             */
            private function _getSizeClassSelector( $sSizeSlug ) {
                
                switch( $sSizeSlug ) {
                    case 'large':
                        $_sClass = 'button-hero';
                        break;
                    case 'small':
                        $_sClass = 'button-small';
                        break;
                    case 'medium':
                    default:
                        $_sClass = '';
                        break;
                }
                return $_sClass;
                
            }               
        
}