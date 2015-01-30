<?php
/**
 * Custom Text Area Field Type
 * 
 * A custom textarea field type compatible with the SiteOrigin Page Builder plugin.
 * 
 * @version     0.0.2
 */
if ( class_exists( 'WPAdminButtons_AdminPageFramework_FieldType_textarea' ) && ! class_exists( 'WPAdminButtons_CustomTextAreaFieldType' ) ) :
class WPAdminButtons_CustomTextAreaFieldType extends WPAdminButtons_AdminPageFramework_FieldType_textarea {
        
    /**
     * Defines the field type slugs used for this field type.
     */
    public $aFieldTypeSlugs = array( 'custom_textarea', );
    
    /**
     * A user constructor.
     */
    protected function construct() {        
        add_action( 'admin_print_styles-post-new.php', array( $this, 'replyToEnqueueStyles' ) );
        add_action( 'admin_print_styles-post.php', array( $this, 'replyToEnqueueStyles' ) );
        add_action( 'admin_print_styles-appearance_page_so_panels_home_page', array( $this, 'replyToEnqueueStyles' ) );
        add_action( 'admin_print_styles-widgets.php', array( $this, 'replyToEnqueueStyles' ) );
    }
        public function replyToEnqueueStyles() {
            wp_enqueue_style( 'wp-jquery-ui-dialog' );
            wp_enqueue_style( 'editor-buttons' );
        }

    /**
     * Returns the field type specific JavaScript script.
     */ 
    public function getScripts() { 

        return parent::getScripts()
            . <<<JAVASCRIPTS
jQuery( document).on( 'panelsopen', function( e ) {
    
    /**
     * Removes the editor by the given textarea ID.
     */
    var removeEditor = function( sTextAreaID ) {

        if ( 'object' !== typeof tinyMCEPreInit ){
            return;
        }
     
        // Store the previous texatrea value. jQuery has a bug that val() for <textarea> does not work for cloned element. @see: http://bugs.jquery.com/ticket/3016
        var oTextArea       = jQuery( '#' + sTextAreaID );
        var sTextAreaValue  = oTextArea.val();
        
        // Delete the rich editor. Somehow this deletes the value of the textarea tag in some occasions.
        tinyMCE.execCommand( 'mceRemoveEditor', false, sTextAreaID );
        delete tinyMCEPreInit[ 'mceInit' ][ sTextAreaID ];
        delete tinyMCEPreInit[ 'qtInit' ][ sTextAreaID ];
        
        // Restore the previous textarea value
        oTextArea.val( sTextAreaValue );
    
    };
    
    /**
     * Updates the editor
     * 
     * @param   string  sTextAreaID     The textarea element ID without the sharp mark(#).
     */
    var updateEditor = function( sTextAreaID, oTinyMCESettings, oQickTagSettings ) {
        
        removeEditor( sTextAreaID );
        var aTMCSettings    = jQuery.extend( 
            {}, 
            oTinyMCESettings, 
            { 
                selector:       '#' + sTextAreaID,
                body_class:     sTextAreaID,
                height:         '100px',  
                menubar : false,
                setup :         function( ed ) {    // see: http://www.tinymce.com/wiki.php/API3:event.tinymce.Editor.onChange
                    // It seems for tinyMCE 4 or above the on() method must be used.
                    if ( tinymce.majorVersion >= 4 ) {
                        ed.on( 'change', function(){                                           
                            jQuery( '#' + this.id ).val( this.getContent() );
                            jQuery( '#' + this.id ).html( this.getContent() );
                        });
                    } else {
                        // For tinyMCE 3.x or below the onChange.add() method needs to be used.
                        ed.onChange.add( function( ed, l ) {
                            // console.debug( ed.id + ' : Editor contents was modified. Contents: ' + l.content);
                            jQuery( '#' + ed.id ).val( ed.getContent() );
                            jQuery( '#' + ed.id ).html( ed.getContent() );
                        });
                    }
                },      
            }
        );   
        var aQTSettings     = jQuery.extend( {}, oQickTagSettings, { id : sTextAreaID } );    
        
        // Store the settings.
        tinyMCEPreInit.mceInit[ sTextAreaID ]   = aTMCSettings;
        tinyMCEPreInit.qtInit[ sTextAreaID ]    = aQTSettings;
        QTags.instances[ aQTSettings.id ]       = aQTSettings;
        
         // Enable quick tags
        quicktags( aQTSettings );   // does not work... See https://core.trac.wordpress.org/ticket/26183
        QTags._buttonsInit();                     
        
        window.tinymce.dom.Event.domLoaded = true;   
        tinyMCE.init( aTMCSettings );
        jQuery( this ).find( '.wp-editor-wrap' ).first().on( 'click.wp-editor', function() {
            if ( this.id ) {
                window.wpActiveEditor = this.id.slice( 3, -5 );
            }
        }); 

    };
    
    /**
     * Decides whether the textarea element should be empty.
     */
    var shouldEmpty = function( iCallType, iIndex, iCountNextAll, iSectionIndex ) {

        // For repeatable fields,
        if ( 0 === iCallType ) {
           return ( 0 === iCountNextAll || 0 === iIndex )
        }

        // At this point, this is for repeatable sections. In this case, only the first iterated section should empty the fields.
        return ( 0 === iSectionIndex );
        
    };    
    
    var _oDialog = jQuery( e.target );
    
    // Check that this is for our widget class
    if( ! _oDialog.has( '.some-unique-widget-form-class' ) ) { return; }

    // Update the TinyMCE editor and Quick Tags bar and increment the ids of the next all (including this copied element) sub-fields.
    var iSectionIndex       = 0;
    var iCallType           = 1;    // @todo examine the proper value
    var iOccurrence         = 1;                        
    var oFieldsNextAll = _oDialog.find( '.admin-page-framework-field' ).nextAll();
    oFieldsNextAll.andSelf().each( function( iIndex ) {

        var _oWrap               = jQuery( this ).find( '.wp-editor-wrap' );
        if ( _oWrap.length <= 0 ) {
            return true;
        }        
        // Retrieve the TinyMCE and Quick Tags settings
        var _oSettings = jQuery().getAPFInputOptions( _oWrap.attr( 'data-id' ) );   // the enabler script stores the original element id.
        
     
        // Cloning is needed here as repeatable sections does not work with the original element for unknown reasons.
        var _oTextArea           = jQuery( this ).find( 'textarea.wp-editor-area' ).first().clone().show().removeAttr( 'aria-hidden' );
        
        // if ( shouldEmpty( iCallType, iIndex, oFieldsNextAll.length, iSectionIndex ) ) {
            // _oTextArea.val( '' );    // only delete the value of the directly copied one
            // _oTextArea.empty();      // the above use of val( '' ) does not erase the value completely.
        // } 
        var oEditorContainer    = jQuery( this ).find( '.wp-editor-container' ).first().clone().empty();
        var oToolBar            = jQuery( this ).find( '.wp-editor-tools' ).first().clone();
               
        // Replace the tinyMCE wrapper with the plain textarea tag element.
        _oWrap.empty()
            .prepend( oEditorContainer.prepend( _oTextArea.show() ) )
            .prepend( oToolBar );   
            
        // Update the editor. For repeatable sections, remove the previously assigned editor.                        
        updateEditor( _oTextArea.attr( 'id' ), _oSettings['TinyMCE'], _oSettings['QuickTags'] );

    });   
     
});
JAVASCRIPTS;

    }
    
}
endif;