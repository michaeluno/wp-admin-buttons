=== WP Admin Buttons ===
Contributors:       Michael Uno, miunosoft
Donate link:        http://en.michaeluno.jp/donate
Tags:               button, buttons, widget, shortcode, admin-ui, style, link button
Requires at least:  3.3
Tested up to:       4.1.0
Stable tag:         1.0.1
License:            GPLv2 or later
License URI:        http://www.gnu.org/licenses/gpl-2.0.html

Displays WordPress admin style buttons in the front end.

== Description ==

<h4>Features</h4>
- **Widget** 
- **Shortcode** - for the parameters see the Other Notes section.
- **Custom Colors** - set your favorite colors.

== Installation ==

= Install = 

1. Upload **`wp-admin-buttons.php`** and other files compressed in the zip folder to the **`/wp-content/plugins/`** directory.,
2. Activate the plugin through the 'Plugins' menu in WordPress.

== Other Notes ==

= Shortcode and Function Parameters =
The following parameters can be used for the shortcode or the PHP function of the plugin, <code>printWPAdminButton()</code>

- **href** - the link url.

`
[wp_admin_button href="http://my-download-url/file.zip"]
`

`
<?php printWPAdminButton( array( 'href' => 'http://my-download-url/file.zip') ); ?>
`

- **label** - the text label shown in the button.

`
[wp_admin_button label="Get" href="http://my-download-url/file.zip"]
`

`
<?php printWPAdminButton( array( 'label' => 'Get', 'href' => 'http://my-download-url/file.zip' ) ); ?>
`

- **size** - the button size. This argument accepts either `large`, `medium`, `small`.

`
[wp_admin_button size="large" href="http://my-download-url/file.zip"]
`

`
<?php printWPAdminButton( array( 'size' => 'large', 'href' => 'http://my-download-url/file.zip' ) ); ?>
`

- **type** - the button type. This argument accepts either `button-primary`, or  `buton-secondary`.

`
[wp_admin_button type="button-secondary" href="http://my-download-url/file.zip"]
`

`
<?php printWPAdminButton( array( 'type' => 'button-secondary', 'href' => 'http://my-download-url/file.zip' ) ); ?>
`

The follwoing color arguments can override the defult colors.

- **label_color** - the label text color.
- **background_color** - the button background color.
- **border_color** - the button border color.

`
[wp_admin_button label_color="#ccc" background_color="transparent" href="http://my-download-url/file.zip"]
`

`
<?php 
printWPAdminButton(
    array( 
        'label_color'       => '#ccc',
        'background_color'  => 'transparent',
        'href'              => 'http://my-download-url/file.zip',
    )
); 
?>
`

The following additional HTML tag attributes can be set.

- **title** - the `title` attribute.
- **class** - the `class` attribute.
- **style** - the `inline` style attribute.
- **target** - the `target` attribute.
- **rel** - the `rel` attribute.

`
[wp_admin_button title="Get the file now!" class="my-custom-class-selector" "style="text-align:center;" target="_blank" rel="nofollow" href="http://my-download-url/file.zip"]
`

`
<?php
echo getWPAdminButtons( 
    array( 
        'type'      => 'button-secondary', 
        'title'     => 'Get the file now!',
        'class'     => 'my-custom-class-selector',
        'style'     => 'text-align:center',
        'target'    => '_blank',
        'href'      => 'http://my-download-url/file.zip',
    )
); 
?>
`


== Frequently Asked Questions ==


== Screenshots ==

1. ***Widget Form***
2. ***Front-end***

== Changelog ==

= 1.0.2 - 2015/02/01 =
- Fixed field title labels of the widget form.

= 1.0.1 - 2015/01/31 =
- Fixed a misspelled function name.

= 1.0.0 - 2015/01/31 =
- Chagned the version for release.

= 0.0.6 =
- Fixed a compatibility issue with third-party plugins.

= 0.0.5 =
- Added the ability to restore the previous color when the mouse cursor goes out the button.

= 0.0.4 =
- Added custom mouse hover color fields.

= 0.0.3 = 
- Added a description field in the widget form.

= 0.0.2 =
- Fixed some small bugs.

= 0.0.1 - 2015/01/27 =
- Released beta.