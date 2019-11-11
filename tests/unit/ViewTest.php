<?php
declare(strict_types=1);

class ViewTest extends \Codeception\Test\Unit
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

		$view = new ItalyStrap\View\View( $finder );
		$this->assertInstanceOf( ItalyStrap\View\ViewInterface::class, $view );
		$this->assertInstanceOf( ItalyStrap\View\View::class, $view );
	}

	/**
	 * @test
	 */
	public function it_should_be_Instantiable()
	{
		$view = $this->getInstance();

	}
}