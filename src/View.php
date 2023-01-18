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
use ItalyStrap\Finder\FinderInterface;

/**
 * Template Class
 */
class View implements ViewInterface {

	/**
	 * @var FinderInterface
	 */
	private $finder;

	public function __construct( FinderInterface $finder ) {
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
		return $this->renderFile( $this->finder->firstFile( (array) $slugs, 'php' ), $data );
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
	 * @param \SplFileInfo $readableFile Full path for this template file.
	 * @param mixed|array|ConfigInterface $data
	 *
	 * @return string
	 * @throws \Exception
	 */
	private function renderFile( \SplFileInfo $readableFile, $data = [] ) : string {

		$storage = null;

		if ( $data instanceof ConfigInterface ) {
			$storage = $data;
		} else {
			$storage = Config::make( $data );
		}

		/**
		 * Thanks to Giuseppe Mazzapica https://github.com/gmazzap
		 */
		$renderer = \Closure::bind(
			function ( $readableFile ) {
				\ob_start();
				include $readableFile;
				return \ob_get_clean();
			},
			$storage
		);

		return (string) $renderer( $readableFile );
	}
}
