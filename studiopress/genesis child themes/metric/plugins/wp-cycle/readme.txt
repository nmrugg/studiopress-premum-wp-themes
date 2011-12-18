=== Plugin Name ===
Contributors: nathanrice
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=5553118
Tags: slideshow, images, jquery cycle
Requires at least: 2.9
Tested up to: 2.9.2
Stable tag: 0.1.8

This plugin creates an image slideshow in your theme, using the jQuery Cycle plugin. You can upload/delete images via the administration panel, and display the images in your theme by using the <code>wp_cycle();</code> template tag, which will generate all the necessary HTML for outputting the rotating images.

== Description ==

The WP-Cycle plugin allows you to upload images from your computer, which will then be used to generate a jQuery Cycle Plugin slideshow of the images.

Each image can also be given a URL which, when the image is active in the slideshow, will be used as an anchor wrapper around the image, turning the image into a link to the URL you specified.  The slideshow is set to pause when the user hovers over the slideshow images, giving them ample time to click the link.

Images can also be deleted via the plugins Administration page.

== Installation ==

1. Upload the entire `wp-cycle` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Configure the plugin, and upload/edit/delete images via the WP-Cycle menu within the Plugins tab
1. Place `<?php wp_cycle(); ?>` in your theme where you want the slideshow to appear
1. Alternatively, you can use the shortcode [wp_cycle] in a post or page to display the slideshow.

== Frequently Asked Questions ==

= My images won't upload. What should I do? =

The plugin uses built in WordPress functions to handle image uploading. Therefore, you need to have [correct permissions](http://codex.wordpress.org/Changing_File_Permissions "Changing File Permissions") set for your uploads directory.

Also, a file that is not an image, or an image that does not meet the minimum height/width requirements, will not upload. Images larger than the dimensions set in the Settings of this plugin will be scaled down to fit, but images smaller than the dimensions set in the Settings will NOT be scaled up. The upload will fail and you will be asked to try again with another image.

Finally, you need to verify that your upload directory is properly set. Some hosts screw this up, so you'll need to check. Go to "Settings" -> "Miscellaneous" and find the input box labeled "Store uploads in this folder". Unless you are absolutely sure this needs to be something else, this value should be exactly this (without the quotes) "wp-content/uploads". If it says "/wp-content/uploads" then the plugin will not function correctly. No matter what, the value of this field should never start with a slash "/". It expects a path relative to the root of the WordPress installation.

= I'm getting an error message that I don't understand. What should I do? =

Please [email me](http://www.nathanrice.net/contact/ "email Nathan Rice") or [@nathanrice](http://twitter.com/nathanrice) me on Twitter. This plugin is still in early alpha stages, and I'm looking for good error reporting. I'll try to fix errors as soon as I possibly can.

If you do contact me for help/support, please consider a $10 minimum donation for my time. I love helping people, but I am a busy person too. Please be considerate of that. I've been generous in offering this plugin for free, so please do the same when you request support or help.

= How can I style the slideshow further? =
In the settings of the plugin, you're able to set a custom DIV ID for the slideshow. Use that DIV ID to style the slideshow however you want using CSS.

= In what order are the images shown during the slideshow? =

Chronologically, from the time of upload. For instance, the first image you upload will be the first image in the slideshow. The last image will be the last, etc.

= Can I reorder the images? =

Not at the moment, but this is a feature I do want to include in the plugin soon.

= Can I rotate anything other than images with this plugin? =

No. This is an image slideshow. Enjoy it for what it is.

= Do you have future plans for this plugin? =
Yes. Here are some things that I want to eventually include:

* Add ability to reorder the images
* Add new effects to the slideshow
* Add the ability to override settings by using function arguments: `<?php wp_cycle('rotate=1&effect=fade&img_width=300&img_height=200&div=slideshow'); ?>`
* Possibly add widget support so that you can put a slideshow in a widget area

== Changelog ==

= 0.1 =
* Initial Release

= 0.1.1 =
* Added automatic defaults database insertion
* Added [wp_cycle] shortcode
* Buggy release, ended up reverting to 0.1

= 0.1.2 =
* Unreleased version, used for testing

= 0.1.3 =
* Added stable [wp_cycle] shortcode
* Added transition duration control to settings
* Added transition delay control to settings
* Added new options to the defaults array (for filtering)
* Changed some wording in the settings
* Upgraded jQuery Cycle plugin from 2.63 to 2.65

= 0.1.4 =
* Added empty alt tag to images to pass vaidation

= 0.1.5 =
* Fixed the error that got produced when trying to loop through a non-array variable (duh!)

= 0.1.6 =
* Fixed the shortcode positioning problem

= 0.1.7 =
* Upgraded jQuery Cycle plugin from 2.65 to 2.81

= 0.1.8 =
* Added `position: relative;` to the slideshow div