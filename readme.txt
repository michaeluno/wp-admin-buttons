=== WP Admin Buttons ===
Contributors:       Michael Uno, miunosoft
Donate link:        http://en.michaeluno.jp/donate
Tags:               button, buttons, widget, shortcode, admin-ui, style, 
Requires at least:  3.3
Tested up to:       4.1.0
Stable tag:         0.0.1
License:            GPLv2 or later
License URI:        http://www.gnu.org/licenses/gpl-2.0.html

Displays buttons with the style used in the WordPress administration area.

== Description ==

<h4>Features</h4>
- **Widget** 
- **Shortcode** 

== Installation ==

= Install = 

1. Upload **`wp-admin-buttons.php`** and other files compressed in the zip folder to the **`/wp-content/plugins/`** directory.,
2. Activate the plugin through the 'Plugins' menu in WordPress.

== Other Notes ==

= Shortcode and Function Parameters =
The following parameters can be used for the shortcode or the PHP function of the plugin, <code>printWPAdminButtons()</code>

- **href** - the link url.

`
[wp_admin_buttons href="http://my-download-url/file.zip"]
`

`
<?php printWPAdminButtons( array( 'href' => 'http://my-download-url/file.zip) ); ?>
`

- **label** - the text label shown in the button.

`
[wp_admin_buttons label="Get" href="http://my-download-url/file.zip" ]
`

`
<?php printWPAdminButtons( array( 'label' => 'Get', 'href' => 'href="http://my-download-url/file.zip' ); ?>
`

- **size** - the button size. This argument accepts either `large`, `medium`, `small`.

`
[wp_admin_buttons size="large" href="http://my-download-url/file.zip" ]
`

`
<?php printWPAdminButtons( array( 'size' => 'large', 'href' => 'href="http://my-download-url/file.zip' ); ?>
`

- **type** - the button type. This argument accepts either `button-primary`, or  `buton-secondary`.

`
[wp_admin_buttons type="button-secondary" href="http://my-download-url/file.zip" ]
`

`
<?php printWPAdminButtons( array( 'type' => 'button-secondary', 'href' => 'href="http://my-download-url/file.zip' ); ?>
`

The follwoing color arguments can override the defult colors.
    - **label_color** - the label text color.
    - **background_color** - the button background color.
    - **border_color** - the button border color.

`
[wp_admin_buttons label_color="#ccc" background_color="transparent" href="http://my-download-url/file.zip" ]
`

`
<?php printWPAdminButtons( 
    array( 
        'label_color' => '#ccc',
        'background_color' => 'transparent',
        'href' => 'href="http://my-download-url/file.zip',
    ); 
?>


The following additional HTML tag attributes can be set.

    - **title** - the `title` attribute.
    - **class** - the `class` attribute.
    - **style** - the `inline` style attribute.
    - **target** - the `target` attribute.
    - **rel** - the `rel` attribute.

`
[wp_admin_buttons title="Get the file now!" class="my-custom-class-selector" "style="text-align:center;" target="_blank" rel="nofollow" href="http://my-download-url/file.zip" ]
`

`
<?php printWPAdminButtons( 
    array( 
        'type' => 'button-secondary', 
        'title' => 'Get the file now!',
        'class' => 'my-custom-class-selector',
        'style' => 'text-align:center',
        'target' => '_blank',
        'href' => 'href="http://my-download-url/file.zip',
    ); 
?>
`



== Frequently Asked Questions ==


== Screenshots ==

1. ***Widget Form***
2. ***Front-end***

== Changelog ==

= 0.0.1 - 2015/01/27 =
* Released as beta .