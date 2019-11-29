<?php
declare(strict_types=1);

class ViewTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

	protected $paths = [];
    
    protected function _before()
    {
		$this->paths = [
			'childPath'		=> \codecept_data_dir( 'fixtures/child' ),
			'parentPath'	=> \codecept_data_dir( 'fixtures/parent' ),
			'pluginPath'	=> \codecept_data_dir( 'fixtures/plugin' ),
		];
    }

    protected function _after()
    {
    }

	private function getInstance(): \ItalyStrap\View\View {
		$finder = new \ItalyStrap\View\ViewFinder();

		$view = new ItalyStrap\View\View( $finder->in( $this->paths ) );
		$this->assertInstanceOf( ItalyStrap\View\ViewInterface::class, $view );
		$this->assertInstanceOf( ItalyStrap\View\View::class, $view );

		return $view;
	}

	/**
	 * @test
	 */
	public function it_should_be_Instantiable()
	{
		$view = $this->getInstance();
	}

	/**
	 * @test
	 * @throws Exception
	 */
	public function itShouldHaveDafaultTitle()
	{

		$viewObj = $this->getInstance();
		// Get the content.php from child
		$view = $viewObj->render( 'content' );
		$this->assertStringContainsString( 'Default title', $view );

	}

	/**
	 * @test
	 * @throws Exception
	 */
	public function itShouldHaveProvidedTitle()
	{
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
	public function itShouldHaveProvidedTitle2()
	{
		$data = [ 'title' => 'Title of the content' ];

		$viewObj = $this->getInstance();
		// Get the content.php from child
		$view = $viewObj->render( 'without-default', $data );
		$this->assertStringContainsString( $data['title'], $view );

	}

	/**
	 * @test
	 * @throws Exception
	 */
	public function itShouldParseEveryDataTypeProvided()
	{
		$data = [ 'title' => 'Title of the content' ];

		$viewObj = $this->getInstance();
		// Get the content.php from child
		$view = $viewObj->render( 'content', [] );
		$this->assertIsString( $view );

		$view = $viewObj->render( 'content', '' );
		$this->assertIsString( $view );

		$data = new \stdClass();
		$data->title = 'Title from stdClass';
		$view = $viewObj->render( 'content', $data );
		$this->assertStringContainsString( $data->title, $view );

		$data = $this->make( \Symfony\Component\Finder\Finder::class );
		$data->in( $this->paths );
		$view = $viewObj->render( 'content', $data );
		$this->assertIsString( $view );
	}
}