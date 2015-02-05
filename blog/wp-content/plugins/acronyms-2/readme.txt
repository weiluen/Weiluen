=== Acronyms 2 ===
Contributors: renaissancedesign
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=donations&business=chris%40renaissance-design%2enet
Tags: acronym, abbreviation, post, formatting, HTML5
Requires at least: 2.7
Tested up to: 3.3
Stable tag: 2.0.2

A plugin to automatically mark up known acronyms and abbreviations in posts and comments. Allows users to manage lists of acronyms through the WordPress Dashboard.

== Description ==

This WordPress plugin will allow users to maintain a list of acronyms and abbreviations which can be managed in the WordPress Dashbard. These acronyms will be automatically wrapped in the appropriate HTML markup when found in posts, pages and comments.

The plugin will auto-detect whether the currently active theme uses HTML5, and will output the appropriate HTML acronym or abbreviation element, e.g. `<acronym title="Hypertext Markup Language">HTML</acronym>` (or `<abbr title="Hypertext Markup Language">HTML</abbr>` for HTML5).

Based on Joel Pan's excellent Acronyms, which is no longer being actively maintained. The onset of HTML5 and the deprecation of `<acronym>` in favour of `<abbr>` led me to fork Joel's plugin and create Acronyms 2.

== Installation ==

1. Download the zip file
2. Extract acronyms.php
3. Upload acronyms.php to your wp-content/plugins directory
4. Log in to your WordPress blog
5. Click on "Plugins"
6. Locate the "Acronyms" plugin and click "Activate"
7. Go to "Tools" > "Acronyms" to modify your list of acronyms

== FAQ ==

= Ok, so how does it work?

Just define your acronyms and abbreviations in the WordPress dashboard under Tools > Acronyms. That's all you have to do, the plugin will automatically mark up your posts and comments.

= What's the difference between this plugin and [Acronyms](http://wordpress.org/extend/plugins/acronyms/)?

This plugin is compatible with WordPress 3.0+ and HTML5 themes, and is actively maintained.

= Will you be extending this plugin with extra functionality?

Nope. The vision for this plugin was to do one thing and do it well. 


== Screenshots ==

1. The admin UI
2. Acronyms output in Twenty Eleven

== Changelog ==

* 2.0.2 - 23 Dec 2011
   * Documentation update
* 2.0.1 - 23 Oct 2011
   * [FIX] Fixed edit form bug - replaced "disabled" attribute with "readonly" to ensure value is still passed
* 2.0.0 - 20 Oct 2011
   * Initial fork of Joel Pan (ketsugi)'s Acronyms. Added HTML5 compliant abbr element when a HTML5 theme is detected
* 1.6.1 - 9 Feb 2009
   * [FIX] Fixed the same bug... again...
* 1.6 - 9 Feb 2009
   * [FIX] Fixed a bug that was causing display errors
   * [UPD] Updated the UI to match WordPress 2.7
* 1.5.3 - 2 Feb 2009
   * [FIX] Editing acronyms was broken for WordPress 2.7 users and is now fixed.
* 1.5.2 - 14 Apr 2008
   * [FIX] The acronym list when sorted by acronyms will now properly sort upper and lower cases
   * [FIX] A conflict with WordPress that caused an error when trying to delete a draft has been corrected
   * [FIX] The full text for TIFF in the default list of acronyms has been corrected
   * [UPD] Deprecated action hooks replaced with the current versions
* 1.5.1 - 7 Apr 2008
   * Fixed an unexpected side-effect of WordPress' new plugin auto-update that broke some paths
* 1.5 - 7 Apr 2008
   * Overhaul of the plugin to match the new WordPress 2.5 admin interface look and feel
   * Acronyms after slash characters are now properly replaced
   * The Acronyms management page now feature pagination, ordering by acronym or full text, and constraining the number of acronyms shown per page
* 1.0 - 24 Jul 2006
   * Initial release
