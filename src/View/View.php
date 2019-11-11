<?php
/**
 * View API: View Class
 *
 * @package ItalyStrap\View
 *
 * @since 4.0.0
 */
declare(strict_types=1);

namespace ItalyStrap\View;

use \ItalyStrap\Config\Config_Interface;
use \ItalyStrap\Config\Config_Factory as Config;
use ItalyStrap\View\Exceptions\InvalidDataException;

/**
 * Template Class
 */
class View implements ViewInterface {

	/**
	 * @var ViewFinderInterface
	 */
	private $finder;

	public function __construct( ViewFinderInterface $finder ) {
		$this->finder = $finder;
	}

	/**
	 * Render a template part into a template
	 *
	 * @param  string|array $slugs The slug name for the generic template.
	 * @param  array|Config_Interface $data
	 *
	 * @return string              Return the file part rendered
	 * @throws \Exception
	 */
	public function render( $slugs, $data = [] ) : string {
		return $this->renderFile( $this->finder->find( (array) $slugs, 'php' ), $data );
	}

	/**
	 * Print the redered template.
	 *
	 * @param $slugs
	 * @param array|Config_Interface $data
	 * @throws \Exception
	 */
	public function output( $slugs, $data = [] ) {
		echo $this->render( $slugs, $data );
	}

	/**
	 * Take a template file, bind the data provided and return the string rendered.
	 *
	 * @param string $redableFile Full path for this template file.
	 * @param array|Config_Interface $data
	 *
	 * @return string
	 * @throws \Exception
	 */
	private function renderFile( string $redableFile, $data = [] ) : string {

		$storage = null;

		if ( is_array( $data ) ) {
			$storage = Config::make( $data );
		} elseif ( $data instanceof Config_Interface ) {
			$storage = $data;
		} else {
			throw new InvalidDataException( 'The {$data} must be an array or an instance of \ItalyStrap\Config\Config_Interface', 0 );
		}

		/**
		 * Thanks to Giuseppe Mazzapica https://github.com/gmazzap
		 */
		$renderer = \Closure::bind( function( $redableFile ) {
			\ob_start();
			include $redableFile;
			return \ob_get_clean();
		},
			$storage
		);

		return $renderer( $redableFile );
	}
}
