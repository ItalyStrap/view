<?php
declare(strict_types=1);

namespace ItalyStrap\Helpers;

use ItalyStrap\View\Exceptions\InvalidDataException;

/**
 * @param $slug
 * @param $name
 * @param $data
 */
function get_template_part( $slug, $name = '', $data = [] ) {

	$type = \apply_filters( 'get_template_part_type_finder_name', \ItalyStrap\View\ViewFinder::class );

	$finder = new $type;
	$finder->in(
		[
			STYLESHEETPATH,
			TEMPLATEPATH,
			ABSPATH . WPINC . '/theme-compat/',
		]
	);

	$view = new \ItalyStrap\View\View( $finder );

	try {

		/**
		 * Fires before a template part is loaded.
		 *
		 * @since 5.2.0
		 *
		 * @param string   $slug      The slug name for the generic template.
		 * @param string   $name      The name of the specialized template.
		 * @param string[] $templates Array of template files to search for, in order.
		 */
		do_action( 'get_template_part', $slug, $name, [] );

		echo $view->render( [ $slug, $name ], $data );

	} catch ( InvalidDataException $e ) {
		echo $e->getMessage();
	} catch ( \Exception $e ) {
		echo $e->getMessage();
	}
}