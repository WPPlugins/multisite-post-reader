=== Multisite Post Reader ===

Contributors: Rick Hellewell
Donate link: http://cellarweb.com/wordpress-plugins/
Tags: Multisite Post Reader
Requires at least: 4.0.1
Tested up to: 4.8
Stable tag: 1.11
Version: 1.11
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Use shortcodes on a page/post to display/edit all posts from all multisite subsites. 

== Description ==

Multisite Post Reader allows you to use a shortcode on a page/post to display all posts from all sites in a multisite system. This allows you (as the SuperAdmin on network sites, or Admin on non-network sites) to monitor all posts on your multi-site system. Although meant for multisite systems by creating a page/post on the 'master' site, it will also work on standalone sites. You could use it to display all posts for visitors. It will even work in a widget (although you would want to use some of the optional parameters to limit the post count and post length).

If you are the SuperAdmin of the multisite, an 'edit' link will be shown on each post; shift-click to open in a new window/tab.

A "Read more" link is provided for all posts.

Each post has a clickable title, and also shows the date of the post.

== Installation ==

1. Install via the Add Plugin page. (On multisites, use the Network Admin Plugin page.) Or download the zip file, uncompress, then upload to `/wp-content/plugins/` directory. Or download, then upload/install via the Add Plugin page.

1. Activate the plugin through the 'Plugins' menu in WordPress.

1. Usage information in Settings, 'Multisite Post Reader Info/Usage'.

== Frequently Asked Questions ==

= What is the shortcodes used? =

Use the *[mpr_display]* shortcode to display all subsite posts on a post/page. 

= Where do I use the shortcodes? = 

Just place the *[mpr_display*] shortcode on a post/page.

= Will it work in a text widget? = 

Yes. Although you might want to limit the number of words and posts displayed, so you don't have a giant widget area. (See below and the Settings/Info screen for parameters info.)

= How are the posts displayed? = 

Each post title and date/time are shown, plus the post content. No CSS is used, so it will use your theme's post/page style. Look at the screenshot for an example.

= Will this work with any theme? =

Yes. We don't use any CSS (other than some bolding). Your theme gets to do all of the CSS stuff.

= Are there any settings? = 

Nope. The 'Info/Usage' (Settings) screen just contains information on the plugin, and the available parameters (word count, post count, last x days, showing all posts, etc.).

= What are there optional parameters? =

This is a list of available optional parameters. Note the default values if the parameter is not used. 

	* items=x				show last x items (default = all items)
	* days=x				show last x days (default = all days)
	* words=x				show first x words (extracts) (default = all post content)
	* showall=yes			show all posts (drafts, published) (default = only published)
	* showsiteinfo=no		do not show subsite info (only post) (default = yes)
	* disableheading=yes	do not show selection heading (default = no)
	* showempty=no			do not show subsites with no results (default = yes). Note: will also suppress subsite info for a subsite without results.
	
The available parameters are also shown on the Settings screen.

= What is an example of using optional parameters? = 

Here's an example:

    [mpr_display  items=4   days=45 showall=yes  ] 
	
This will show only the last 4 items (newest are always first) of entries from the last 45 days. If there are more than 4 items in the last 45 days, only 4 are shown. It will also show all items: draft, published, etc. You may want to limit the public use of the 'showall' parameter, so your non-published items will not be shown.

= Can I limit the number of posts displayed, or show the last 6 days? = 

Yes. Just use a shortcode similar to *[mpr_display days=6 items=10]*. These options will be shown above the posts: 'Showing last 6 days, last 10 posts. See the plugin's Info/Usage page in the Admin Settings menu for all the available parameters.

= Are there known issues? = 

The current issue is that if you use the mpr_display shortcode within the page/post content, the list will be shown before the entire content of the page/post. We plan on fixing this in a future version. So right now, this shortcode is best for on pages/posts without other content.

= What if I have problems or suggestions? =

Just contact us via the plugin's <a href='https://wordpress.org/support/plugin/multisite-post-reader/'>Support page</a>. Or via www.CellarWeb.com . 

= Do you have other plugins? = 

Yes! 

* **Multisite Media Display** : shows all media from all subsites. SuperAdmins can click on a picture to edit it. Great for ensuring all media conforms to your site's standards.

* **FormSpammerTrap for Comments** : enhances comment forms so that bots can't spam your comments. Uses a more clever technique than just hidden fields or captchas or other things that don't always work. Also lets you change the text/headings of the comment form. (We also have a free standalone version; take a look at www.FormSpammerTrap.com (that's the page that comment bots will see, but also contains all the info about the 'trap').

* **URL Smasher** : automatically shortens URLs on all URLs in pages/posts.

* **AmazoLinkenator** : adds your Amazon Affiliate ID to any Amazon product link in pages/posts/comments. It's your site, so use your Amazon Affiliate ID. 

All plugins are free and full-functioned. No premium features. Just search for them on the Add Plugins page.

== Screenshots ==

1. An example display of posts from a multisite installation.  Shows the first site's posts, along with the selection criteria on top. The edit icon is only visible to super-admins. 

== Changelog ==

= 1.11(20 Feb 2017) = 

* added additional parameters per request; here's all of the parameters:
	* *items=x*				show last x items (default = all items)
	* *days=x*				show last x days (default = all days)
	* *words=x*				show first x words (extracts) (default = all post content)
	* *showall=yes*			show all posts (drafts, published) (default = only published)
	* *showsiteinfo=no*		do not show subsite info (only post) (default = yes)
	* *disableheading=yes*	do not show selection heading (default = no)
	* *showempty=no*			do not show subsites with no results (default = yes). Note: will also suppress subsite info for a subsite without results.

* some code efficiencies (like converting all parameter values to lowercase for simpler test)

= 1.10 (14 Feb 2017)  (not released; see version 1.11) = 

* added parameter (showempty=no; default is  yes) to disable showing of subsites that have no entries according to other parameters used (user suggestion)
* added parameter 'disableheading' (default is yes) to disable showing the selection parameters
* added parameter 'showsiteinfo' (default is yes) to disable showing of site info (site name and path) above each sub-sites grouping of posts

= 1.09 (10 Feb 2017) = 

* ensured that shortcode parameters array have values if not speficied; removes error.log message if error reporting is on at site 

= 1.08 (8 Feb 2017) =

* fixed bug with page_init function call - not needed

= 1.07 (25 Jan 2017) =

* corrected the settings/info screen to remove statement about shortcode parameters needing to be in lower case. Doesn't matter, since standard WP functions always convert parameter names and values to lower case.
* added sanitation of the shortcode parameter values. (Parameter names are sanitized by WP functions.)
* fixed links to review and support pages on the settings/info page.
* on the settings/info page, clarified that non-network admins will see the Edit icon/link.
* removed unused functions, some minor code cleanup

= 1.06 (24 Jan 2017) = 

* moved the "Showing..." message to the top, rather than repeating it for each sub-site
* the post status message ("Status = ..") was italicized to make it easier to see
* fixed bug where the 'word' parameter wasn't truncating the post if used
* removed a function that wasn't needed.
* minor clarification of information on the info/usage screen
* some minor code efficiencies

= 1.05 (24 Jan 2017) = 

* added [showall=yes] parameter to show all posts, not just published posts. The status of each post will be shown (publish, future, etc). Default is to just show Published posts.
* corrections to plugin's Info/Usage screen.
* minor changes to the readme file.

= 1.04 (19 Jan 2017) = 

* added an empty H2 tag just before the settings/info screen header for any WP Admin status messages, which otherwise might overwrite the settings/info text.
* fixed the 'edit' link (which only super-admins see) to open the editor in a new tab/window (prior versions didn't open in new window/tab)
* added the 'edit' dash-icon (looks like a stubby pencil) to the edit link (visible for super-admins only), replacing a text link
* verified OK for WP 4.71
* updated the screenshot to show the edit icon
* minor fix to readme formatting

= 1.03 (12 Jan 2017, 13 Jan 2017) = 

* fixed repository problem (I should carefully read the part where it tells me where to put the distribution files...)
* tested for WP 4.71

= 1.02 (9 Jan 2017) = 

* the 1.01 update wasn't showing on WP Plugins site. Updated and re-submitted this version number to hopefully fix that.

= 1.01 (6 Jan 2017) =

* fixed strange install bug by upping the version (no code changes)

= 1.00 (4 Jan 2017) = 

* Initial Release 

== Upgrade Notice ==

See Changelog for new features/bug fixes.


