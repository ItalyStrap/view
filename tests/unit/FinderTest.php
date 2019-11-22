<?php 
class FinderTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $paths = [];
    
    protected function _before()
    {
		$this->paths = [
			'childPath'		=> \codecept_data_dir( 'child' ),
			'parentPath'	=> \codecept_data_dir( 'parent' ),
			'pluginPath'	=> \codecept_data_dir( 'plugin' ),
		];
    }

    protected function _after()
    {
    }

	private function getInstance() {
		$finder = new \ItalyStrap\Finder\ConfigFinder();
		$this->assertInstanceOf( ItalyStrap\Finder\FinderInterface::class, $finder );
		$this->assertInstanceOf( ItalyStrap\Finder\AbstractFinder::class, $finder );
		$this->assertInstanceOf( ItalyStrap\Finder\ConfigFinder::class, $finder );
		return $finder;
	}

	/**
	 * @test
	 */
	public function it_should_thrown_exception()
	{
		$finder = $this->getInstance();
		$this->expectException( LogicException::class );
		$finder->find( 'file_name' );
	}

	/**
	 * @test
	 */
	public function it_should_find_files()
	{
		$finder = $this->getInstance();
		$finder->in( $this->paths );
		$files = $finder->find( ['config', 'content'] );

		codecept_debug( $files );
	}
}