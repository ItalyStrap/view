<?php
declare(strict_types=1);

namespace ItalyStrap\View;

use ItalyStrap\View\Exceptions\ViewNotFoundException;

/**
 * @param $slug
 * @param $name
 * @param $data
 */
function get_template_part( $slug, $name = '', $data = [] ) {

	$type = \apply_filters( 'italystrap_view_get_template_part_finder_type_name', ViewFinder::class );

	$dirs = \apply_filters( 'italystrap_view_get_template_part_directories',  [
		STYLESHEETPATH,
		TEMPLATEPATH,
		ABSPATH . WPINC . '/theme-compat/',
	] );

	$finder = new $type;
	$finder->in( $dirs );

	$view = new View( $finder );

	try {

		/**
		 * Fires before a template part is loaded.
		 *
		 * @param string   $slug      The slug name for the generic template.
		 * @param string   $name      The name of the specialized template.
		 * @param string[] $templates Array of template files to search for, in order.
		 */
		do_action( 'get_template_part', $slug, $name, [] );

		$slug = (array) $slug;
		$slug[] = \strval( $name );

		echo $view->render( $slug, $data );

	} catch ( ViewNotFoundException $e ) {
		echo $e->getMessage();
	} catch ( \Exception $e ) {
		/**
		 * @todo Add some sort of debugging
		 */
		echo $e->getMessage();
	}
}