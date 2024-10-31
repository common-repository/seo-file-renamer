=== SEO File Renamer ===
Contributors: kinskiandbourke
Tags: seo, renamer, google search, sanitization
Requires at least: 5.1.0
Tested up to: 5.8.2
Requires PHP: 5.6.0
Stable tag: 1.0.3
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

A super simple plugin for uploaded file name sanitization.


== Description ==

This is a super simple plugin for uploaded file name sanitization.

Essentially, it’s to make your uploaded filenames easier for search engines to read, hence better for SEO, nicer to look at in the folder (who cares?), and should also help avoid any issues with naming conventions. 
You might be thinking that WordPress does a good enough job at renaming, but it still allows underscores and other symbols and characters that maybe don’t belong in a filename.

e.g.
This: Æ, %20 æ Ï, Ö, Ü, Ÿ-boyz_%20__=++&, ©, §)+Ţ ţ++‰+ath-club-ÆØÅæøå--.pdf
Becomes:	AE-20-ae-I-O-U-Y-boyz-20-T-tath-club-AEOAaeoa.pdf
This:		----___------]- hair space U+200A.jpg
becomes:	hair-space-U200A.jpg


The Original idea for this was done by Vaughn Royko and so we thought we would turn this into a simple plugin with a few options for those who are worried about messing with their functions file, and or can only install plugins and cant edit the Functions file.


== Installation ==

1. Install SEO File Renamer
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Allow filename capitalization by going to the 'Settings > SEO File Renamer' menu.

== Frequently Asked Questions ==

= Does this plugin work with PHP 8? =
Yes.

== Changelog ==

= 1.0.3 =
* Style updates

= 1.0.2 =
* Updated dox

= 1.0.1 =
* Initial version

== Upgrade Notice ==

= 1.0.2 =
* Updated dox