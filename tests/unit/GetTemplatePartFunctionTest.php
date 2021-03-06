<?php
declare(strict_types=1);

namespace ItalyStrap\Tests;

use Codeception\Test\Unit;
use UnitTester;
use function codecept_data_dir;
use function define;
use function defined;
use function ob_get_clean;
use function ob_start;

class GetTemplatePartFunctionTest extends Unit {

	/**
	 * @var UnitTester
	 */
	protected $tester;

	// phpcs:ignore -- Method from Codeception
	protected function _before() {

		// phpcs:ignore -- Method from Codeception
		\tad\FunctionMockerLe\define( 'apply_filters', function ( $filtername, $value ) {
			return $value;
		} );
		// phpcs:ignore -- Method from Codeception
		\tad\FunctionMockerLe\define( 'do_action', function ( $filtername, $value ) {
			return $value;
		} );

		$constant = [
			'STYLESHEETPATH'	=> codecept_data_dir( 'fixtures/child' ),
			'TEMPLATEPATH'		=> codecept_data_dir( 'fixtures/parent' ),
			'ABSPATH'			=> '',
			'WPINC'				=> codecept_data_dir( 'fixtures/plugin' ),
		];

		foreach ( $constant as $name => $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}
	}

	// phpcs:ignore -- Method from Codeception
	protected function _after() {
	}

	/**
	 * @test
	 */
	public function itShouldRenderContentFromContentFile() {
		ob_start();
		\ItalyStrap\View\get_template_part('content' );
		$content = ob_get_clean();

		$this->assertIsString( $content, '' );
		$this->assertNotEmpty( $content, '' );
		$this->assertStringContainsString( '<p>Some Text</p>', $content, '' );
	}

	/**
	 * @test
	 */
	public function itShouldRenderContentFromContentFileWithDifferentTypeOfSlugProvided() {
		ob_start();
		\ItalyStrap\View\get_template_part( 'content-single' );
		$content = ob_get_clean();

		$this->assertIsString( $content, '' );
		$this->assertNotEmpty( $content, '' );
		$this->assertStringContainsString( '<h1>Some Title</h1>', $content, '' );
	}

	/**
	 * @test
	 */
	public function itShouldRenderContentFromContentFileWithDifferentTypeOfSlugProvided1() {
		ob_start();
		\ItalyStrap\View\get_template_part( 'content', 'single' );
		$content = ob_get_clean();

		$this->assertIsString( $content, '' );
		$this->assertNotEmpty( $content, '' );
		$this->assertStringContainsString( '<h1>Some Title</h1>', $content, '' );
	}

	/**
	 * @test
	 */
	public function itShouldRenderContentFromContentFileWithDifferentTypeOfSlugProvided2() {
		ob_start();
		\ItalyStrap\View\get_template_part( ['content', 'single'] );
		$content = ob_get_clean();

		$this->assertIsString( $content, '' );
		$this->assertNotEmpty( $content, '' );
		$this->assertStringContainsString( '<h1>Some Title</h1>', $content, '' );
	}

	/**
	 * @test
	 */
	public function itShouldPassDataWithValue() {
		ob_start();
		\ItalyStrap\View\get_template_part( ['content', 'single'], null, [ 'key' => 'Value' ] );
		$content = ob_get_clean();

		$this->assertIsString( $content, '' );
		$this->assertNotEmpty( $content, '' );
		$this->assertStringContainsString( 'Value', $content, '' );
	}
}
