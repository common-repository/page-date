<?php

/*
Plugin Name: Page Date
Plugin URI: http://vapourtrails.ca/wp-plugins
Version: 1.0
Description: Modifies a page's post date whenever the page is updated
Author: Jerome Lavigne
Author URI: http://vapourtrails.ca
*/

/*  Copyright 2005  Jerome Lavigne  (email : jerome@vapourtrails.ca)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

/* ChangeLog:

25-Feb-2005:  Version 1.0 publicly released

*/

function pagedate_change($id)
{
	global $wpdb, $post_status;

	// check if this is a page
	if ($post_status == "static" && isset($id))
	{
		// modify date
		$now = current_time('mysql');
		$now_gmt = current_time('mysql', 1);
		
		$query = "UPDATE {$wpdb->posts} SET post_date = '$now', post_date_gmt = '$now_gmt' WHERE ID = '$id'";
		$wpdb->query($query);
	}
}

/** Add actions **/
add_filter('edit_post', 	'pagedate_change');
add_filter('publish_post', 	'pagedate_change');
add_filter('save_post', 	'pagedate_change');

?>