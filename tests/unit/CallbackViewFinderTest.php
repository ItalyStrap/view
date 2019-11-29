<?php
declare(strict_types=1);

namespace ItalyStrap\Tests\Unit;

use ItalyStrap\View\CallbackViewFinder;

include_once 'BaseViewFinderTestUnit.php';
class CallbackViewFinderTest extends BaseViewFinderTestUnit
{

	protected function setType() {
		return CallbackViewFinder::class;
	}

	protected function setArgs() {
		return function (  $files, $dirs  ) {
			foreach ( $files as $file ) {
				foreach ( $dirs as $dir ) {
					$dir = \rtrim( $dir, '/'.\DIRECTORY_SEPARATOR );
					if ( \is_readable( $dir . \DIRECTORY_SEPARATOR . $file ) ) {
						return $dir . \DIRECTORY_SEPARATOR . $file;
					}
				}
			}

			return '';
		};
	}

	/**
	 * @test
	 */
	public function it_should_be_Instantiable()
	{
		$finder = $this->getInstance();
		$this->assertInstanceOf( \ItalyStrap\View\CallbackViewFinder::class, $finder );
	}
}