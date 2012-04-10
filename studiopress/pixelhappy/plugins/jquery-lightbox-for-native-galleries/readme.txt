=== jQuery Lightbox For Native Galleries ===
Contributors: Viper007Bond
Tags: lightbox, jquery, gallery
Requires at least: 2.6
Tested up to: 3.0
Stable tag: trunk

Makes the native WordPress galleries use a lightbox script called ColorBox to display the fullsize images.

== Description ==

Makes the native WordPress galleries use a lightbox script called [ColorBox](http://colorpowered.com/colorbox/) to display the fullsize images right there in the page. No modifications required.

**Demo**

A demo is available at [this plugin's homepage](http://www.viper007bond.com/wordpress-plugins/jquery-lightbox-for-native-galleries/).

== Installation ==

Log into the administration area of your blog and click on Plugins -> Add New in the menu. Search for the name of this plugin and then click install on the right side, and then again in the pop-up window.

== ChangeLog ==

= Version 3.1.4 =
* Don't change the attachment link inside the admin area.

= Version 3.1.3 =
* Update ColorBox to v1.3.6. See [it's changelog](http://colorpowered.com/colorbox/core/README).

= Version 3.1.2 =
* Remove IE PNG fixes as they require a full URL and it's not worth the trouble. Works well enough in IE8.
* Change how groups of images are labeled (use a random number rather than the gallery's ID so it works with the Twenty Ten theme).

= Version 3.1.1 =
* Update ColorBox to v1.3.4.

= Version 3.1.0 =
* Update ColorBox to v1.3.3.
* Include all five of the default ColorBox themes and add a settings page to pick between them.
* Change the lightbox maxwidth and maxheight to 95% as I think it looks better.

= Version 3.0.2 =
* Don't do anything inside of feeds (i.e. modify the thumbnail links).

= Version 3.0.1 =
* Fix spelling mistake on the ColorBox style ID.

= Version 3.0.0 =
* Switch the awesome [ColorBox](http://colorpowered.com/colorbox/). It looks pretty and does large image resizing. Yay!

= Version 2.0.1 =
* Remove an extra comma that was breaking stupid Internet Explorer. Props [Troy](http://troycawley.com/).

= Version 2.0.0 =
* Switched lightbox scripts as I was unhappy with the previous one.

= Version 1.1.0 =
* Update jquery_lightbox package. It now supports resizing images that are too large as well as not disabling IE6 support.
* Makes the lightbox gallery-aware, i.e. don't allow next/prev between image sets. Thanks to Benjamin "balupton" Lupton!

= Version 1.0.1 =
* Better WordPress 2.6 support (i.e. when you have a moved plugins directory).

= Version 1.0.0 =
* Initial release.

== Upgrade Notice ==

= 3.1.3 =
Works properly in Internet Explorer now and compatible with more WordPress themes. ColorBox script also updated.

= 3.1.2 =
Works properly in Internet Explorer now and compatible with more WordPress themes.