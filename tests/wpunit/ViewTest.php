<?php 
class ViewTest extends \Codeception\Test\Unit
{
    /**
     * @var \WpunitTester
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

	private function getFinder() {
		$finder = new \ItalyStrap\View\ViewFinder();
		$this->assertInstanceOf( '\ItalyStrap\View\ViewFinderInterface', $finder );
		$this->assertInstanceOf( '\ItalyStrap\View\ViewFinder', $finder );
		return $finder;
	}

	private function getView() {
		$view = new \ItalyStrap\View\View( $this->getFinder()->in( $this->paths ) );
		$this->assertInstanceOf( '\ItalyStrap\View\ViewInterface', $view );
		$this->assertInstanceOf( '\ItalyStrap\View\View', $view );
		return $view;
	}

    // tests
    public function testSomeFeature()
    {
    	$data = [ 'title' => 'Title of the content' ];

		$viewObj = $this->getView();
		// Get the content.php from child
		$view = $viewObj->render( 'content' );
		$this->assertStringContainsString( 'Default title', $view );
//		codecept_debug( $view );

		$view = $viewObj->render( 'content', $data );
		$this->assertStringContainsString( $data['title'], $view );
//		codecept_debug( $view );
    }
}