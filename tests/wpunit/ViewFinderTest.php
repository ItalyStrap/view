<?php 
class ViewFinderTest extends \Codeception\TestCase\WPTestCase
{
	/**
	 * @var \WpunitTester
	 */
	protected $tester;

	private $paths = [];

	public function setUp(): void
	{
		// Before...
		parent::setUp();

		$this->paths = [
			'childPath'		=> \codecept_data_dir( 'child' ),
			'parentPath'	=> \codecept_data_dir( 'parent' ),
			'pluginPath'	=> \codecept_data_dir( 'plugin' ),
		];
	}

	public function tearDown(): void
	{
		// Your tear down methods here.

		// Then...
		parent::tearDown();
	}

	private function getSymfonyFinderAdapter() {
		$symfony = new \Symfony\Component\Finder\Finder();
		$finderAdapter = new \ItalyStrap\View\SymfonyViewFinderAdapter( $symfony );
		$this->assertInstanceOf( '\ItalyStrap\View\ViewFinderInterface', $finderAdapter );
		$this->assertInstanceOf( '\ItalyStrap\View\SymfonyViewFinderAdapter', $finderAdapter );
		return $finderAdapter;
	}

	/**
	 * @test
	 */
	public function itShouldSymfonyFinderAdapterFindFile() {
		$finderAdapter = $this->getSymfonyFinderAdapter();

		// Search in single directory
		$finderAdapter->in( $this->paths[ 'parentPath' ] );

		$this->assertFileExists( $finderAdapter->find( ['content', 'none', 'test'] ) );
		$this->assertFileIsReadable( $finderAdapter->find( ['content', 'none', 'test'] ) );
		$expected = \str_replace( '/', '\\', $this->paths[ 'parentPath' ] . '\content-none.php'  );
		$this->assertEquals( $expected, $finderAdapter->find( ['content', 'none', 'test'] ) );

		// New search in another directory with the same $finderAdapter object
		$finderAdapter->in( $this->paths[ 'pluginPath' ] );
		$this->assertFileExists( $finderAdapter->find( ['test'] ) );
		$this->assertFileIsReadable( $finderAdapter->find( ['test'] ) );
		$expected = \str_replace( '/', '\\', $this->paths[ 'pluginPath' ] . '\test.php'  );
		$this->assertEquals( $expected, $finderAdapter->find( ['test'] ) );
	}

	/**
	 * @test
	 */
	public function itShouldSymfonyFinderAdapterThrownExceptionIfNoFilesAreFounded() {
		$finderAdapter = $this->getSymfonyFinderAdapter();
		$finderAdapter->in( $this->paths );

		$this->expectException( \ItalyStrap\View\Exceptions\ViewNotFoundException::class );
		$finderAdapter->find( ['inexistentFile'] );

	}

	/**
	 * @test
	 */
	public function itShouldSymfonyFinderAdapterSearchInManyDirectories() {
		$finderAdapter = $this->getSymfonyFinderAdapter();

		/**
		 * Criteria
		 * Search in child > parent > plugin path because they are
		 * in this order in $this->paths field
		 * File to search content-none.php {['content', 'none']}
		 * child false
		 * parent true
		 * plugin false
		 */
		$finderAdapter->in( $this->paths );
		$realPath = $finderAdapter->find( ['content', 'none'] );

		$this->assertStringNotContainsString( '_data\child', $realPath );
		$this->assertStringContainsString( '_data\parent', $realPath );
		$this->assertStringNotContainsString( '_data\plugin', $realPath );

	}

	private function getFinder() {
		$finder = new \ItalyStrap\View\ViewFinder();
		$this->assertInstanceOf( '\ItalyStrap\View\ViewFinderInterface', $finder );
		$this->assertInstanceOf( '\ItalyStrap\View\ViewFinder', $finder );
		return $finder;
	}

	/**
	 * @test
	 */
	public function itShouldFinderFindFile() {
		$finder = $this->getFinder();

		// Search in single directory
		$finder->in( $this->paths[ 'parentPath' ] );

		$this->assertFileExists( $finder->find( ['content', 'none', 'test'] ) );
		$this->assertFileIsReadable( $finder->find( ['content', 'none', 'test'] ) );
		$expected = \str_replace( '/', '\\', $this->paths[ 'parentPath' ] . '\content-none.php'  );
		$actual = \str_replace( '/', '\\', $finder->find( ['content', 'none', 'test'] )  );
		$this->assertEquals( $expected, $actual );

		// New search in another directory with the same $finder object
		$finder->in( $this->paths[ 'pluginPath' ] );
		$this->assertFileExists( $finder->find( ['test'] ) );
		$this->assertFileIsReadable( $finder->find( ['test'] ) );
		$expected = \str_replace( '/', '\\', $this->paths[ 'pluginPath' ] . '\test.php'  );
		$actual = \str_replace( '/', '\\', $finder->find( ['test'] )  );
		$this->assertEquals( $expected, $actual );
	}

	private function getCallbackFinder() {
		$finder = new \ItalyStrap\View\CallbackViewFinder( function ( array $files, array $dirs ) {
			// Create some logic to return a full path of a file with your criteria

			/**
			 * Only for the purpose of ththid test I return a valid file
			 */
			return $this->paths[ 'parentPath' ] . '\content-none.php';
		} );
		$this->assertInstanceOf( '\ItalyStrap\View\ViewFinderInterface', $finder );
		$this->assertInstanceOf( '\ItalyStrap\View\CallbackViewFinder', $finder );
		return $finder;
	}


	/**
	 * @test
	 */
	public function itShouldCallbackFinderFindFile() {
		$finder = $this->getCallbackFinder();

		// Search in single directory
		$finder->in( $this->paths[ 'parentPath' ] );

		$this->assertFileExists( $finder->find( ['content', 'none', 'test'] ) );
		$this->assertFileIsReadable( $finder->find( ['content', 'none', 'test'] ) );
		$expected = \str_replace( '/', '\\', $this->paths[ 'parentPath' ] . '\content-none.php'  );
		$actual = \str_replace( '/', '\\', $finder->find( ['content', 'none', 'test'] )  );
		$this->assertEquals( $expected, $actual );

		// New search in another directory with the same $finder object
//		$finder->in( $this->paths[ 'pluginPath' ] );
//		$this->assertFileExists( $finder->find( ['test'] ) );
//		$this->assertFileIsReadable( $finder->find( ['test'] ) );
//		$expected = \str_replace( '/', '\\', $this->paths[ 'pluginPath' ] . '\test.php'  );
//		$actual = \str_replace( '/', '\\', $finder->find( ['test'] )  );
//		$this->assertEquals( $expected, $actual );
	}

}