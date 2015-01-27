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
            
            return $aArguments + $this->aArguments;
            
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
                    . $this->_getATag( $this->aArguments )
                . "</div>"  // button
            . "</div>"  // wp-core-ui
        ;
        
    }
        /**
         * Returns the 'a' tag output.
         * 
         * @return      string      The output of the 'a' tag of the button.
         */
        private function _getATag( array $aArguments ) {
            
            return "<a" 
                . " class='" . $this->_getClassAttribute( $aArguments )  . "'"
                . " href='" . esc_attr( $aArguments['href'] )  . "'"
                . " title='" . esc_attr( $aArguments['title'] )  . "'"
                . " style='" . esc_attr( $this->_getATagStyle( $aArguments ) )  . "'"
                . " target='" . esc_attr( $aArguments['target'] )  . "'"
                . " rel='" . esc_attr( $aArguments['rel'] )  . "'"
            . ">"
                . $aArguments['label']
            . "</a>";            
 
        }
        /**
         * Returns the inline CSS rules applied to the 'a' tag of the button.
         * 
         * @return      string      Inline CSS rules.
         */
        private function _getATagStyle( array $aArguments ) {
            
            $_aCustomStyle = array(
                isset( $aArguments['style']['a'] )
                    ? rtrim( $aArguments['style']['a'], ';' )
                    : rtrim( $aArguments['style'], ';' ),
            );
            $_aInlineStyle = array(
                'color'             => trim( $aArguments['label_color'] ),
                'background-color'  => trim( $aArguments['background_color'] ),
                'border-color'      => trim( $aArguments['border_color'] ),
            );
            $_aInlineStyle = array_filter( $_aInlineStyle );    // drop non-true elements.
            foreach( $_aInlineStyle as $_sProperty => $_sValue ) {
                $_aCustomStyle[ ] = "{$_sProperty}: {$_sValue}";
            }
            return implode( ';', $_aCustomStyle );
            
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