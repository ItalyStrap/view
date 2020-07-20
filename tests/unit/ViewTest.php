<?php
declare(strict_types=1);

namespace ItalyStrap\Tests;

use Codeception\Test\Unit;
use Exception;
use ItalyStrap\Config\ConfigFactory;
use ItalyStrap\Finder\FinderInterface;
use ItalyStrap\View\View;
use ItalyStrap\View\ViewInterface;
use Prophecy\Prophecy\ObjectProphecy;
use SplFileInfo;
use stdClass;
use Symfony\Component\Finder\Finder;
use UnitTester;

class ViewTest extends Unit {

	/**
	 * @var UnitTester
	 */
	protected $tester;

	protected $paths = [];

	/**
	 * @var ObjectProphecy
	 */
	private $finder;

	/**
	 * @return FinderInterface
	 *
	 */
	public function getFinder(): FinderInterface {
		return $this->finder->reveal();
	}

	// phpcs:ignore -- Method from Codeception
	protected function _before() {
		$this->paths = [
			'childPath'		=> codecept_data_dir( 'fixtures/child' ),
			'parentPath'	=> codecept_data_dir( 'fixtures/parent' ),
			'pluginPath'	=> codecept_data_dir( 'fixtures/plugin' ),
		];

		$this->finder = $this->prophesize( FinderInterface::class );
	}

	// phpcs:ignore -- Method from Codeception
	protected function _after() {
	}

	private function getInstance(): View {
		$sut = new View( $this->getFinder() );
		$this->assertInstanceOf( ViewInterface::class, $sut );
		$this->assertInstanceOf( View::class, $sut );
		return $sut;
	}

	/**
	 * @test
	 */
	public function instanceOk() {
		$view = $this->getInstance();
	}

	/**
	 * @test
	 * @throws Exception
	 */
	public function itShouldHaveDafaultTitle() {
		$this->finder->firstFile( ['content'], 'php' )->willReturn(
			new SplFileInfo( codecept_data_dir( 'fixtures/child' ) . '/content.php' )
		);

		$sut = $this->getInstance();
		// Get the content.php from child
		$view = $sut->render( 'content' );
		$this->assertStringContainsString( 'Default title', $view );
	}

	/**
	 * @test
	 * @throws Exception
	 */
	public function itShouldHaveProvidedTitle() {

		$this->finder->firstFile( ['content'], 'php' )->willReturn(
			new SplFileInfo( codecept_data_dir( 'fixtures/child' ) . '/content.php' )
		);

		$data = [ 'title' => 'Title of the content' ];

		$viewObj = $this->getInstance();
		// Get the content.php from child
		$view = $viewObj->render( 'content', $data );
		$this->assertStringContainsString( $data['title'], $view );
	}

	/**
	 * @test
	 * @throws Exception
	 */
	public function itShouldHaveProvidedTitleFromConfigFactory() {

		$this->finder->firstFile( ['content'], 'php' )->willReturn(
			new SplFileInfo( codecept_data_dir( 'fixtures/child' ) . '/content.php' )
		);

		$data = ConfigFactory::make([ 'title' => 'Title of the content' ]);

		$viewObj = $this->getInstance();
		// Get the content.php from child
		$view = $viewObj->render( 'content', $data );
		$this->assertStringContainsString( $data['title'], $view );
	}

	/**
	 * @test
	 * @throws Exception
	 */
	public function itShouldHaveProvidedTitle2() {

		$this->finder->firstFile( ['without-default'], 'php' )->willReturn(
			new SplFileInfo( codecept_data_dir( 'fixtures/child' ) . '/without-default.php' )
		);

		$data = [ 'title' => 'Title of the content' ];

		$sut = $this->getInstance();
		// Get the content.php from child
		$view = $sut->render( 'without-default', $data );
		$this->assertStringContainsString( $data['title'], $view );
	}

	/**
	 * @test
	 * @throws Exception
	 */
	public function itShouldParseEveryDataTypeProvided() {
		$this->finder->firstFile( ['content'], 'php' )->willReturn(
			new SplFileInfo( codecept_data_dir( 'fixtures/child' ) . '/content.php' )
		);

		$data = [ 'title' => 'Title of the content' ];

		$viewObj = $this->getInstance();
		// Get the content.php from child
		$view = $viewObj->render( 'content', [] );
		$this->assertIsString( $view );

		$view = $viewObj->render( 'content', '' );
		$this->assertIsString( $view );

		$data = new stdClass();
		$data->title = 'Title from stdClass';
		$view = $viewObj->render( 'content', $data );
		$this->assertStringContainsString( $data->title, $view );

		$data = $this->make( Finder::class );
		$data->in( $this->paths );
		$view = $viewObj->render( 'content', $data );
		$this->assertIsString( $view );
	}
}
