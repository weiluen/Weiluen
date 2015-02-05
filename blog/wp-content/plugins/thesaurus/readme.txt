=== Thesaurus ===
Contributors: benmerrill
Tags: thesaurus, reference, lookup, ajax
Requires at least: 2.1
Tested up to: 2.5.1
Stable tag: 1.0

This plugin allows you to add a thesaurus lookup to your sidebar, or anywhere else. Thesaurus service provided by words.bighugelabs.com.

== Description ==

I was shocked that in a world full of writers, there wasn't a simple thesaurus lookup tool.  With the help of an API written by words.bighugelabs.com, this is that tool.  

Very simple AJAX based interface, which allows for thesaurus lookups without leaving the page, so you can lookup a word before you lose the thought. 

Designed for use in the sidebar, but could probably work anywhere.  

Basic result limiting functionality is included, so you can return a maximum of N results.

== Screenshots ==

1. Results are shown directly underneath the box, or in any `<div>` element you specify.

== Installation ==

Installing should be a piece of cake and take fewer than five minutes.

1. Upload the`thesaurus` directory to your `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Add the `<?php thesaurus_print_lookupform(); ?>` tag into your sidebar template file.
1. Try a lookup, and be pleasantly surprised with the results.

== Frequently Asked Questions ==

= How do I limit the results? =

Add the limit option to your function call in this manner:

`<?php thesaurus_print_lookupform('limit=10'); ?>`

= Is there a maximum number of requests limit? =

Yes, thanks for asking. There is a limit of 10,000 requests per day, per IP address.  If you need more, take a look at this page: 

http://words.bighugelabs.com/getkey.php

= Are there any special software considerations I need to know about before use? =

Yes, just one.  Thesaurus lookup requires the PHP CURL library, which should be installed by default on your server.  If not, talk to your web host about getting it implemented.

= Can I see it in action first? =

Absolutely.  This plugin is in use at this website:

http://www.whatsitlike.net/submit-your-story/

