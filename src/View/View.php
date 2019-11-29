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

use \ItalyStrap\Config\ConfigFactory as Config;
use ItalyStrap\Config\ConfigInterface;

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
	 * @param  array|ConfigInterface $data
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
	 * @param array|ConfigInterface $data
	 * @throws \Exception
	 */
	public function output( $slugs, $data = [] ) {
		echo $this->render( $slugs, $data );
	}

	/**
	 * Take a template file, bind the data provided and return the string rendered.
	 *
	 * @param string $readableFile Full path for this template file.
	 * @param mixed|array|ConfigInterface $data
	 *
	 * @return string
	 * @throws \Exception
	 */
	private function renderFile( string $readableFile, $data = [] ) : string {

		$storage = null;

		if ( $data instanceof ConfigInterface ) {
			$storage = $data;
		} else {
			$storage = Config::make( $data );
		}

		/**
		 * Thanks to Giuseppe Mazzapica https://github.com/gmazzap
		 */
		$renderer = \Closure::bind( function( $readableFile ) {
			\ob_start();
			include $readableFile;
			return \ob_get_clean();
		},
			$storage
		);

		return $renderer( $readableFile );
	}
}
