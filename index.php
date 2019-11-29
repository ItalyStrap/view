<?php
/*
Plugin Name: View
Description: View API for loading template parts and views in WordPress
Plugin URI: https://italystrap.com
Author: Enea Overclokk
Author URI: https://italystrap.com
Version: 1.0.0
License: GPL2
Text Domain: Text Domain
Domain Path: Domain Path
*/

/*

    Copyright (C) 2019  Enea Overclokk  info@overclokk.net

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

require( __DIR__ . '/vendor/autoload.php' );

/**
 * debug_example
 */
function view_example() {

	$dirs = [
		STYLESHEETPATH . '/template-parts/content/',
		TEMPLATEPATH . '/template-parts/content/',
//			STYLESHEETPATH,
//			TEMPLATEPATH,
		ABSPATH . WPINC . '/theme-compat/',
//		$this->paths['childPath'],
	];

//	d(\get_stylesheet_directory());
//	d(\get_template_directory());
//
//	d( STYLESHEETPATH );
//	d( TEMPLATEPATH );
//	d( ABSPATH . WPINC );

$templates = [
	'template-parts/content/content-none.php',
	'template-parts/content/content.php',
];

//d( \locate_template( $templates ) );

}

add_action( 'wp_footer', 'view_example' );
