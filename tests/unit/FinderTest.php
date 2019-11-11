<?php 
class FinderTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

	private function getInstance() {
		$finder = new \ItalyStrap\Finder\Finder();
		$this->assertInstanceOf( ItalyStrap\Finder\FinderInterface::class, $finder );
		$this->assertInstanceOf( ItalyStrap\Finder\AbstractFinder::class, $finder );
		$this->assertInstanceOf( ItalyStrap\Finder\Finder::class, $finder );
		return $finder;
	}

	/**
	 * @test
	 */
	public function it_should_be_Instantiable()
	{
		$finder = $this->getInstance();
	}
}