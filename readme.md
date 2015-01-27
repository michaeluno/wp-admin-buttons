# [WP Admin Buttons](http://wordpress.org/plugins/wp-admin-buttons/) #

### Welcome to our GitHub Repository

WP Admin Buttons is an open source WordPress plugin that displays buttons with the style used in the WordPress administration area.

## Screenshots ##
Coming soon..

## Installation ##

- The latest development version can be found [here](https://github.com/michaeluno/wp-admin-buttons/branches). 
- The latest stable version can be downloaded [here](http://downloads.wordpress.org/plugin/wp-admin-buttons.latest-stable.zip).

1. Upload **`wp-admin-buttons.php`** and other files compressed in the zip folder to the **`/wp-content/plugins/`** directory.,
2. Activate the plugin through the `Plugins` menu in WordPress.

## Usage ##

### Widget
1. Go to **Dashboard** -> **Appearance** -> **Widgets** and add the **WP Admin Buttons** widget to your proffered sidebar.

### Shortcode and Function Parameters

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

## Bugs ##
If you find an issue, let us know [here](https://github.com/michaeluno/wp-admin-buttons/issues)!

## Support ##
This is a developer's portal for WP Admin Buttons and should _not_ be used for support. Please visit the [support forums](http://wordpress.org/support/plugin/wp-admin-buttons).

## Contributions ##
Anyone is welcome to contribute to WP Admin Buttons.

There are various ways you can contribute:

1. Raise an [Issue](https://github.com/michaeluno/wp-admin-buttons/issues) on GitHub.
2. Send us a Pull Request with your bug fixes and/or new features.
3. Provide feedback and suggestions on [enhancements](https://github.com/michaeluno/wp-admin-buttons/issues?direction=desc&labels=Enhancement&page=1&sort=created&state=open).

## Supporting Future Development ##

If you like it, please rate and review it in the [WordPress Plugin Directory](http://wordpress.org/support/view/plugin-reviews/wp-admin-buttons?filter=5). Also donation would be greatly appreciated. Thank you!

[![Donate with PayPal](https://www.paypal.com/en_US/i/btn/x-click-but04.gif)](http://en.michaeluno.jp/donate) 

## Copyright and License ##

### WP Admin Buttons ###
Released under the [GPL v2](./LICENSE.txt) or later.
Copyright © 2014 Michael Uno

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License along
with this program; if not, write to the Free Software Foundation, Inc.,
51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.