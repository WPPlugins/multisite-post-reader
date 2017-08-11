<?php
/*
Plugin Name: Multisite Post Reader
Plugin URI: http://cellarweb.com/wordpress-plugins/
Description: Shows posts from all subsites on a multisite via a shortcode used on pages/posts. SuperAdmins get an edit link. Optional parameters can limit number of posts and post length. Can be used for public pages.
Stable tag: 1.11
Version: 1.11
Author: Rick Hellewell / CellarWeb.com
Tested up to: 4.72
Text Domain: 
Author URI: http://CellarWeb.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

/*
Copyright (c) 2016-2017 by Rick Hellewell and CellarWeb.com
All Rights Reserved

email: rhellewell@gmail.com  

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/
// ----------------------------------------------------------------
// ----------------------------------------------------------------
global $mpr_version;
$mpr_version = "1.11 (20 Feb 2017)";
global $atts;		// used for the shortcode parameters

// Add settings link on plugin page
function mpr_settings_link($links) {
	$settings_link = '<a href="options-general.php?page=mpr_settings" title="Multisite Post Reader">Multisite Post Reader Info/Usage</a>' ;
	array_unshift($links, $settings_link) ;
	return $links ;
}
$plugin = plugin_basename(__FILE__) ;
add_filter("plugin_action_links_$plugin", 'mpr_settings_link') ;

//	build the class for all of this
class mpr_Settings_Page {
	
// start your engines!
	public function __construct() {
		add_action( 'admin_menu', array($this, 'mpr_add_plugin_page')) ;
	}
	
// add options page
	public function mpr_add_plugin_page() {
// This page will be under "Settings"
		add_options_page( 'Multisite Post Reader Info/Usage', 'Multisite Post Reader Info/Usage', 'manage_options', 'mpr_settings', array($this, 'mpr_create_admin_page')) ;
	}
	
// options page callback
	public function mpr_create_admin_page() {
	// Set class property
		$this->options = get_option('mpr_options') ;
	echo '<div class="wrap">';
	 mpr_info_top() ;
			mpr_info_bottom() ; 	// display bottom info stuff
		echo '</div>';
	}
	
// print the Section text
	public function mpr_print_section_info() {
		print '<h3><strong>Information about Multisite Post Reader from CellarWeb.com</strong></h3>' ;
	}
}
// end of the class stuff
if ( is_admin()) {
	$my_settings_page = new mpr_Settings_Page() ;
	// ----------------------------------------------------------------------------
	// supporting functions
	// ----------------------------------------------------------------------------
	//	display the top info part of the page
	// ----------------------------------------------------------------------------
	function mpr_info_top() {
		global $mpr_version;
		?>

<div class="wrap" >
<h2></h2> <!-- placeholder for any WP admin status messages -->
<hr />
<div style="background-color:#9FE8FF;padding-left:15px;padding-bottom:10px;margin-bottom:15px;"> <br />
	<h1 align="center" style="font-size:300%"><strong>Multisite Post Reader</strong></h1>
	<h3 align="center">Display/Edit All Multisite's Posts via Shortcode</h3>
	<p>Version <?php echo $mpr_version; ?></p>
</div>
<hr />
<div style="padding-left:15px;>"
<p><strong>Multisite Post Reader</strong> allows you to use a [<strong>mpr_display]</strong> shortcode on a page/post to display all posts from all sites in a multisite system.  This allows you (as the network SuperAdmin or non-network Admin) to monitor all posts on your multi-site system. Although meant for multisite systems by creating a page/post on the 'master' site, it will also work on standalone sites. It can be used on public pages. No CSS styling is added, so the posts will display using your theme's styling. Shortcode could also be used in a widget, but you would want to use parameters to limit count and length of displayed posts.</p>
<p>If you are the SuperAdmin of the multisite (or the Admin of a non-network site), an 'edit' link will be shown on each post, which will open a new window/tab. </p>
<p>Each post has a clickable title, and also shows the publish date of the post. A "Read more" link is provided for all posts. Super-admins will see an Edit icon, which opens a new window/tab to edit the post.</p>
<h4>There are shortcode options/parameters for (adjust the numbers for your needs):</h4>
<ul style="list-style-type: disc; list-style-position: inside;padding-left:12px;">
<li><strong>days=4</strong> show only the last 4 days (default all dates, option used will be shown above each sites' picture group).</li>
<li><strong>items=10</strong> show only the last 10 items (default all items, option used will be shown above each sites' posts group).</li>
<li><strong>words=50</strong> will show only the first 50 words of the post (default is the entire post).</li>
<li><strong>showall=yes</strong> show all posts, including draft, scheduled, private (default is no; only published posts, option used will be shown above each sites' posts group). Eash post will show it's current status after the post publish date. This allows you to see all types of posts, including scheduled posts.</li>
<li><strong>showsiteinfo=no</strong> do not show subsite info (id, path) (default is to show the site info)</li>
<li><strong>disableheading=yes</strong> do not show the selection criteris heading (default is to show selection criteris)</li>
<li><strong>showempty=no</strong> do not show subsites with no results (default=yes, will show 'none found' if no results for that subsite). Note that if a subsite does not have results, the subsite info (ID, path) will not be shown.</li>
<!--<li><strong>showdate=yes</strong> show upload date under picture (default no) </li>-->
</ul>

<p>The parameters can be combined, as in <strong>[mpr_display days=4 items=10]</strong>. The optional parameters will be shown above each site's group of posts. </p>
<p><strong>Known Issue:</strong> The shortcode is meant to be used by itself on a page/post. If you use this shortcode on a page/post with other content, the content will be displayed after the list, rather than in-line. This will be fixed in a future version.
</div>
<hr />
<p><strong>Tell us how the Multisite Post Reader plugin works for you - leave a <a href="https://wordpress.org/support/plugin/multisite-post-reader/reviews/" title="Multisite Post Reader Reviews" target="_blank" >review or rating</a> on our plugin page.&nbsp;&nbsp;&nbsp;<a href="https://wordpress.org/support/plugin/multisite-post-reader" title="Help or Questions" target="_blank">Get Help or Ask Questions here</a>.</strong></p>
<hr />
<div style="background-color:#9FE8FF;padding:3px 8px 3px 8px;">
	<p><strong>How about a plugin that shows all media on all multisites? We've got it - <a href="https://wordpress.org/plugins/multisite-media-display/" title="Multisite Media Display plugin" target="_blank">Multisite Media Display.</a></strong></p></div>
	<hr />
<div style="background-color:#9FE8FF;padding:3px 8px 3px 8px;"><p><strong>Interested in a plugin that will automatically add your Amazon Affiliate code to any Amazon links?&nbsp;&nbsp;&nbsp;Check out our nifty <a href="https://wordpress.org/plugins/amazolinkenator/" title="AmazoLinkenator - automatic Amazon affiliate links" target="_blank">AmazoLinkenator</a>!&nbsp;&nbsp;It will probably increase your Amazon Affiliate revenue!</strong></p></div>
</div>
</div>
<?php
	}
	
	// ----------------------------------------------------------------------------
	// display the copyright info part of the admin  page
	// ----------------------------------------------------------------------------
	function mpr_info_bottom() {
	// print copyright with current year, never needs updating
		$xstartyear = "2016" ;
		$xname = "Rick Hellewell" ;
		$xcompanylink1 = ' <a href="http://CellarWeb.com" title="CellarWeb" >CellarWeb.com</a>' ;
		echo '<hr><div style="background-color:#9FE8FF;padding-left:15px;padding:10px 0 10px 0;margin:15px 0 15px 0;">
<p align="center"><strong>Copyright &copy; ' . $xstartyear . '  - ' . date("Y") . ' by ' . $xname . ' and ' . $xcompanylink1 ;
		echo ' , All Rights Reserved. Released under GPL2 license. <a href="http://cellarweb.com/contact-us/" target="_blank" title="Contact Us">Contact us page</a>.</strong></p></div><hr>' ;
		return ;
	}
	// end  copyright ---------------------------------------------------------
	
	// ----------------------------------------------------------------------------
	// ``end of admin area
	//here's the closing bracket for the is_admin thing
}
	// ----------------------------------------------------------------------------

	// register/deregister/uninstall hooks
	
	register_activation_hook( __FILE__, 'mpr_register' );
	register_deactivation_hook( __FILE__, 'mpr_deregister' );
	register_uninstall_hook(__FILE__, 'mpr_uninstall');	
	
	// register/deregister/uninstall options (even though there aren't options)
	function mpr_register() {
		return;
	}
	function mpr_deregister() {
		return;
	}
	
	function mpr_uninstall() {
	return;
	}
	//  ----------------------------------------------------------------------------
	// set up shortcodes
	
	function mpr_shortcodes_init()
		{
			add_shortcode('mpr_display', 'mpr_setup_sites');
		}
	
	add_action('init', 'mpr_shortcodes_init');


	// ----------------------------------------------------------------------------
	// here's where we do the work!
	// ----------------------------------------------------------------------------

	function mpr_setup_sites($atts = array()) {
		// sanitize any parameters using the sanitize_text_field callback
		if (! empty($atts)) {
		$atts = array_map('sanitize_text_field', $atts);
		$atts = array_map('strtolower',$atts);
		}
		mpr_get_sites_array($atts); 		// get the sites array, and loop through them in that function
		return;
	}
	
// --------------------------------------------------------------------------------

// ===============================================================================
//	functions to display all posts 
// ===============================================================================
/*
	 Styles and code 'functionated' for displaying all posts files 
		adapted from http://alijafarian.com/responsive-image-grids-using-css/
		*/	
// --------------------------------------------------------------------------------
// need to adjust for wp_get_sites deprecated in 4.6 for get_sites
function mpr_get_sites_array($atts, $xedit=0) {
	// needed since wp_get_sites deprecated as of 4.6+, but can't use replacement get_sites in < 4.6
	global $wp_version;
	$xshowsiteinfo = true; 	// default to show site info 
	$disableheading = false; 	// default to show selection criteria 
	$showempty = true; 	// default to show empty sites 
	$xsiteheader = "";
	$show_tags = array();
	echo "<div>";
	// set up $atts parameters, create empty ones to allow for no errors if error_reporting is on at site
	if (isset($atts[showsiteinfo])) { // to show site info in each group
		if ($atts[showsiteinfo] == "no") {
			$xshowsiteinfo  = false;} 
		} 
	if (isset($atts[disableheading])) {$disableheading = true;}  // don't show heading
	if (! $disableheading) {	// building and displaying heading text
		if ($atts[showempty] == "no") {$showempty = false; $show_tags[] = "Subsites without entries not shown"; }
			 else {$atts['showempty'] = true;}
		if (isset($atts['items'])) {$items = $atts['items']; $show_tags[] = "$items posts"; }
			 else {$atts['items'] = "";}
		if (isset($atts[days])) {$days = $atts[days];  $show_tags[] = "last $days days"; }
			 else {$atts['days'] = "";}
		if (isset($atts[words])) {$words = $atts[words];  $show_tags[] = "$words words"; }
			 else {$atts['words'] = "";}
		if (isset($atts[showall])) {$showall = $atts[showall];  $show_tags[] = " All posts"; }
			 else {$atts['showall'] = "";}
		
		if($show_tags) {
			echo "<hr>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Showing: " . implode(", ", $show_tags). "</strong><hr>";
		}
	}
	// WordPress 4.6
	if ( $wp_version >= 4.6 ) {		// instead of looking for deprecated functions that might still exist
		$subsites_object = get_sites();
		$subsites = mpr_objectToArray($subsites_object);
		foreach( $subsites as $subsite ) {
			  $subsite_id = $subsite ["blog_id"];
			  $subsite_name = get_blog_details($subsite_id)->blogname;
			  $subsite_path = $subsite[path];
			  $subsite_domain = $subsite[domain];
			switch_to_blog( $subsite_id );
			if ($xshowsiteinfo  ) {
				$xsiteheader = "<hr>Site:<strong> $subsite_id - $subsite_name</strong> ;   Path: <strong>$subsite_path</strong><hr>";
			} else {}
			$xsiteurl = $subsite_domain . $subsite_path;
			mpr_site_show_posts($xedit, $xsiteurl, $atts, $xsiteheader, $showempty);	// '1' parameter to allow edit; second parameter for the site id



			restore_current_blog();
		}
	}
if ( $wp_version <= 4.5 ) {		// WordPress < 4.6
		$sites = wp_get_sites();
		// and this is how we loop through blogs with <4.6
		foreach ( $sites as $site ) {
			switch_to_blog( $site['blog_id'] );
			//mpr_blog_loop($site);
			if ($xshowsiteinfo  ) {
				$xsiteheader =  "<hr>Site:<strong> $site[blog_id]</strong> ;   Path: <strong>$site[path]</strong><hr>";
			}
			$xsiteurl = $site[domain] . $site[path];
			mpr_site_show_posts($xedit, $xsiteurl, $atts, $xsiteheader, $showempty);	// '1' parameter to allow edit; second parameter for the site id
			restore_current_blog();
		}
	}
	echo "</div>";	
return ;		
}
// --------------------------------------------------------------------------------
//	 list all posts on all multisite sites
// 		inspired by https://wisdmlabs.com/blog/how-to-list-posts-from-all-blogs-on-wordpress-multisite/
// --------------------------------------------------------------------------------
// display posts on all sites 

/* Optional parameters
	items=x				show last x items (default = all items)
	days=x				show last x days (default = all days)
	words=x				show first x words (extracts) (default = all post content)
	showall=yes			show all posts (drafts, published) (default = only published)
	showempty=no		do not show subsites with no results (default = yes). Note: will also suppress subsite info for a subsite without results.
	showsiteinfo=no		do not show subsite info (only post) (default = yes)
	disableheading=yes	do not show selection heading (default = no)
	
*/

function mpr_site_show_posts($xedit=0, $xsiteurl="", $atts = "", $xsiteheader="", $showempty=true) {
	global $post;
	$show_tags = array();
	if (isset($atts[showempty] )) {$showempty = false; $show_tags[] = "Subsites without entries not shown"; } else {$showempty = true;}
	if (isset($atts[items])) {$items = $atts['items']; $show_tags[] = "$items posts"; }
	if (isset($atts[days])) {$days = $atts[days];  $show_tags[] = "last $days days"; }
	if (isset($atts[words])) {$words = $atts[words];  $show_tags[] = "$words words"; }
	if (isset($atts[showall])) {$showall = $atts[showall];  $show_tags[] = " All posts"; }
	if ($days) {$daystring = "$days days ago";}		// optional parameter
	$list = array();
	$xpost_status = array();
	if ($atts[showall]) {
		$xpost_status[] = 'any'; 
	}
	else
	{$xpost_status = '';}
		$args = array(
			'post_type' => 'post',
			'post_status' => $xpost_status,
			'date_query' => (isset($daystring) ? array(array('after' => $daystring,  // or '-2 days'
			'inclusive' => true,)) : null),
			'posts_per_page' =>(isset($items) ?  $items : null),
		);
	$query = new WP_Query($args);

	// uncomment this if you want to see the SQL statement
	//	 echo "SQL = " . $query->request;
	// end uncomment area
		
if (! $query->have_posts() ) {
	if ($showempty) {
			echo "(none found)";
	return;
	}
}
if ( $query->have_posts() ) {
	if ($xsiteheader) {
		echo $xsiteheader;
	}
    while ( $query->have_posts() ) { 
    $query->the_post();
	$x = get_post();
	?>
	<strong>
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_title(); ?></a>
	<?php
	echo "</strong>&nbsp;&nbsp;&nbsp;(";echo $x->post_date . ")";
	if (is_super_admin()) {
		$xlink = get_edit_post_link($x->id) ;
		echo  '&nbsp;&nbsp;<a href="' . $xlink . '" target="_blank" title="Edit Post" class="dashicons dashicons-edit"></a>&nbsp;&nbsp;';
		;}
	if ($atts[showall]) {
		echo "<em>(status = " . $x->post_status . ")</em>";
	}
	echo "<br>";
	if ($words) {
		$text = make_clickable(get_the_content());
		echo mpr_truncate_text( $text, $words, $more_text = "  (Read more ...)" );
		echo "<hr>";
		} 
	else
	{the_content("  (Read more ...)");
	echo"<hr>";
		}
    }
    wp_reset_postdata();
}
	
return;
}

// --------------------------------------------------------------------------------
/**
(from http://stackoverflow.com/questions/40833184/how-do-i-truncate-post-loop-content-in-wordpress )
 * Truncate the incoming string of text to a set number of words.
 * It preserves the HTML markup.
 *
 * @since 1.0.0
 *
 * NOTE: This function is adapted from WordPress Core's `wp_trim_words()`
 * function.  It does the same functionality, except it does not strip out
 * the HTML tag elements.
 *
 * @param string $text
 * @param int $words_limit
 * @param string $more_text
 *
 * @return string
 */
function mpr_truncate_text( $text, $words_limit = 55, $more_text = '&hellip;' ) {

    $separator = ' ';

    /*
     * translators: If your word count is based on single characters (e.g. East Asian characters),
     * enter 'characters_excluding_spaces' or 'characters_including_spaces'. Otherwise, enter 'words'.
     * Do not translate into your own language.
     */
    if ( strpos( _x( 'words', 'Word count type. Do not translate!' ), 'characters' ) === 0 && preg_match( '/^utf\-?8$/i', get_option( 'blog_charset' ) ) ) {
        $text = trim( preg_replace( "/[\n\r\t ]+/", ' ', $text ), ' ' );
        preg_match_all( '/./u', $text, $words_array );
        $words_array = array_slice( $words_array[0], 0, $words_limit + 1 );
        $separator = '';
    } else {
        $words_array = preg_split( "/[\n\r\t ]+/", $text, $words_limit + 1, PREG_SPLIT_NO_EMPTY );
    }

    if ( ! count( $words_array ) > $words_limit ) {
        return implode( $separator, $words_array );
    }

    array_pop( $words_array );
    $text = implode( $separator, $words_array );
	$more_text = '<a class="more-link" href="' . get_permalink() . '">' . $more_text . '</a>';
    return $text . $more_text;
}

// --------------------------------------------------------------------------------
function mpr_objectToArray ($object) {		// convert object to array, required for get_sites() loop
		if(!is_object($object) && !is_array($object)) return $object;

return array_map('mpr_objectToArray', (array) $object);
}

// ===============================================================================
//	end functions to display all posts
// ===============================================================================

// ----------------------------------------------------------------------------
// debugging function to show array values nicely formatted
function mpr_show_array( $xarray = array()) {
	echo "<pre>"; print_r($xarray);echo "</pre>";
	return;
}

// ----------------------------------------------------------------------------
// all done!
// ----------------------------------------------------------------------------


