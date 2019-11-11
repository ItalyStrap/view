<?php
declare(strict_types=1);

class ViewFinderTest extends \Codeception\Test\Unit
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
		$finder = new \ItalyStrap\View\ViewFinder();
		$this->assertInstanceOf( ItalyStrap\View\ViewFinderInterface::class, $finder );
		$this->assertInstanceOf( ItalyStrap\View\AbstractViewFinder::class, $finder );
		$this->assertInstanceOf( ItalyStrap\View\ViewFinder::class, $finder );
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