<?php
/**
 * WP Admin Buttons
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
     * Stores an object provides utility methods.
     */
    public $oUtil; 
    
    /**
     * Stores the default arguments. 
     */
    public $aArguments = array(
    
        'label'                 => 'Download',  // the text label
        'title'                 => '',          // title attribute
        'size'                  => 'medium',    // accepts 'large', 'small', 'medium'
        'type'                  => 'button-primary',   // 'button-primary' or 'button-secondary'
        'description'           => '',      // text description
        'description_position'  => '',      // 'above' or 'below'
        
        //// A tag attributes
            
            // shortcode
            'href'      => null,
            'class'     => null,      // additional class attributes        
            'style'     => null,      // (array|string) inline style
            'target'    => null,      // e.g. '_balank'
            'rel'       => null,      // e.g. 'nofollow'                
            
            // widget
            // The 'attributes' array wil ltake precedence over these first level attribute values.
            'attributes'    => array(
                array(
                    'attribute' => null,
                    'value'     => null,
                )   
            ),

        //// Custom Colors
        
            // shortcode 
            'background_color'                  => null,
            'border_color'                      => null,
            'label_color'                       => null,
            'background_color_on_mouse_hover'   => null,
            'border_color_on_mouse_hover'       => null,
            'label_color_on_mouse_hover'        => null,
            
            // widget
            'custom_colors'                     => array(
                // underscores will be converted to hyphens 
                'background_color'  => null,
                'border_color'      => null,
                'color'             => null,
            ),
            'custom_colors_on_mouse_hover'      => array(
                // underscores will be converted to hyphens 
                'background_color'  => null,
                'border_color'      => null,
                'color'             => null,        
            ),
            
    );
    
    /**
     * Sets up properties.
     */
    public function __construct( $asArguments ) {
        
        $this->oUtil        = new WPAdminButtons_AdminPageFramework_WPUtility;
        $this->aArguments   = $this->_getFormattedArguments( 
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
            
            // Merge the 1st depth.
            $aArguments = $aArguments + $this->aArguments;
            
            // The second depth.
            $aArguments['attributes'] = $this->_getFormattedAttribtues( 
                $aArguments, 
                ( array ) $aArguments['attributes'] + ( array ) $this->aArguments['attributes']
            );
            
            // the ''class attribute
            $aArguments['attributes']['class'] = $this->_getClassAttribute( $aArguments );
            
            // The 'style' attribute
            $aArguments['attributes'] = $this->_getStyleAttribute( $aArguments ) + $aArguments['attributes'];
            
            return $aArguments;
            
        }
            /**
             * Formats the 'attribtue' argument.
             * 
             * @return      The formatted attribute argument array.
             */
            private function _getFormattedAttribtues( array $aArguments, array $aAttributes ) {
                
                // Shortcode attributes are not nested.
                $_aShortcodeAttributes = array(
                    'href'      => $aArguments['href'],
                    'class'     => $aArguments['class'],
                    'style'     => $aArguments['style'],    
                    'target'    => $aArguments['target'],   
                    'rel'       => $aArguments['rel'],      
                );
                
                // Widget arguments have a nested structure.
                $_aFormattedAttributes = array();
                foreach( $aAttributes as $_aAttribute ) {
                    if ( empty( $_aAttribute['attribute'] ) ) {
                        continue;
                    }
                   $_aFormattedAttributes[ $_aAttribute['attribute'] ] = $_aAttribute['value'];
                }               
                
                // Merge and return
                return $_aFormattedAttributes + $_aShortcodeAttributes;
                
            }
            
    /**
     * Returns the HTML output of the button based on the set arguments.
     * @return      string      The button HTML output string.
     */
    public function get() {
        
        $_sDivTagStyle = isset( $this->aArguments['style']['div'] )
            ? $this->aArguments['style']['div']
            : '';
            
        $_sDescriptionAbove = 'above' === $this->aArguments['description_position']
            ? $this->aArguments['description']
            : '';
        $_sDescriptionBelow = 'below' === $this->aArguments['description_position']
            ? $this->aArguments['description']
            : '';
     
        return $_sDescriptionAbove
            . "<div class='wp-core-ui' style='margin:1em 0;'>"
                . "<div class='welcome-panel'" 
                        . " style='" . esc_attr( $_sDivTagStyle ) . "'"
                    . ">"
                    . $this->_getATag( $this->aArguments )
                . "</div>"  // button
            . "</div>"  // wp-core-ui
            . $_sDescriptionBelow
            ;
        
    }
        /**
         * Returns the 'a' tag output.
         * 
         * @return      string      The output of the 'a' tag of the button.
         */
        private function _getATag( array $aArguments ) {

            return "<a " . $this->oUtil->generateAttributes( $aArguments['attributes'] ) . " >"
                . $aArguments['label']
            . "</a>";            
 
        }
        /**
         * Returns the inline CSS rules applied to the 'a' tag of the button.
         * 
         * @return      array      Attribute array only holding the elements relating to the buton style.
         */
        private function _getStyleAttribute( array $aArguments ) {
            
            $_aCustomStyle = array(
                isset( $aArguments['style']['a'] )
                    ? rtrim( $aArguments['style']['a'], ';' )
                    : rtrim( $aArguments['style'], ';' ),
            );
            $_aCustomStyle = array_filter( $_aCustomStyle );

            $_aInlineStyle = $this->oUtil->uniteArrays(
                $this->_getFormattedKeysForInlineCSS( $aArguments['custom_colors'] ),
                array(
                    'color'             => $aArguments['label_color'] ? $aArguments['label_color'] : null,
                    'background-color'  => $aArguments['background_color'] ? $aArguments['background_color'] : null,
                    'border-color'      => $aArguments['border_color'] ? $aArguments['border_color'] : null,
                )
            );

            $_aInlineStyle = array_filter( $_aInlineStyle );    // drop non-true elements.
            foreach( $_aInlineStyle as $_sProperty => $_sValue ) {
                if ( empty( $_sProperty ) ) {
                    continue;
                }
                $_aCustomStyle[] = "{$_sProperty}: {$_sValue}";
            }

            return array(
                'style'         => esc_attr( implode( ';', $_aCustomStyle ) ),
            ) + $this->_getMouseHoverAttributes( $aArguments, $_aInlineStyle );
            
        }        
            /**
             * Returns an attribute array holding only the mouse hover JavaScript attributes.
             * 
             * @return      array       
             * @param       array       $aArguments     The argument arrays.
             * @param       array       $aNormalColors  Inline style attribute array for non-mouse-hover.
             */
            private function _getMouseHoverAttributes( array $aArguments, array $aNormalColors ) {
                             
                $_aOnMouseHoverColors = $this->oUtil->uniteArrays(
                    $this->_getFormattedKeysForInlineCSS( $aArguments['custom_colors_on_mouse_hover'] ),
                    array(
                        'color'             => $aArguments['label_color_on_mouse_hover'] ? $aArguments['label_color_on_mouse_hover'] : null,
                        'background-color'  => $aArguments['background_color_on_mouse_hover'] ? $aArguments['background_color_on_mouse_hover'] : null,
                        'border-color'      => $aArguments['border_color_on_mouse_hover'] ? $aArguments['border_color_on_mouse_hover'] : null,
                    )
                );
                $_aOnMouseHoverColors = array_filter( $_aOnMouseHoverColors );
                
                $_aMouseHoverScript = array(
                    "this.__style = 'undefined' === typeof this.__style ? {} : this.__style",
                );
                foreach( $_aOnMouseHoverColors as $_sAttribute => $_sValue ) {
                    
                    $_aMouseHoverScript[] = "this.__style[\"{$_sAttribute}\"]=this.style[\"{$_sAttribute}\"]";
                    $_aMouseHoverScript[] = "this.style[\"{$_sAttribute}\"]='{$_sValue}'";
                    
                    // Make sure to have an element to be paserd in order to restore the color.
                    $aNormalColors[ $_sAttribute ] = isset( $aNormalColors[ $_sAttribute ] )
                        ? $aNormalColors[ $_sAttribute ]
                        : '';
                        
                }
                
                $_aMouseOutScript = array();   
                foreach( $aNormalColors as $_sAttribute => $_sValue ) {
                    $_aMouseOutScript[] = "this.style[\"{$_sAttribute}\"]=this.__style[\"{$_sAttribute}\"]";
                    $_aMouseOutScript[] = "this.__style={}";
                }
                return  array(                    
                    'onMouseOver'   => implode( '; ', $_aMouseHoverScript ),
                    'onMouseOut'    => implode( '; ', $_aMouseOutScript ),
                );
                
            }
       
        /**
         * Sanitizes array keys.
         * 
         * Changes 
         * array(
         *   'background_color' => '#fff',
         * )
         * to
         * array(
         *   'background-color' => '#fff',
         * )
         */
        private function _getFormattedKeysForInlineCSS( array $aArray ) {
            
            $_aNew = array();
            foreach( $aArray as $_sKey => $_mValue ) {
                $_aNew[ str_replace( '_', '-', $_sKey ) ] = $_mValue;
            }
            return $_aNew;
            
            
        }
        
        /**
         * 
         * @return      The calculated class attributes for the 'a' tab of the button.
         */
        private function _getClassAttribute( array $aArguments ) {
            
            $_sClassAttribute = $this->oUtil->generateClassAttribute(  
                'button',
                $aArguments['type'],
                $this->_getSizeClassSelector( $aArguments['size'] ),
                $aArguments['attributes']['class']
            );                
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