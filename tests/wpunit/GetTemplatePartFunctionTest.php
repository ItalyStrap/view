<?php 
class GetTemplatePartFunctionTest extends \Codeception\TestCase\WPTestCase
{
	/**
	 * @var \WpunitTester
	 */
	protected $tester;

	public function setUp(): void
	{
		// Before...
		parent::setUp();

		// Your set up methods here.
	}

	public function tearDown(): void
	{
		// Your tear down methods here.

		// Then...
		parent::tearDown();
	}

	// Tests
	public function test_it_works()
	{
		$post = static::factory()->post->create_and_get();

		$this->assertInstanceOf(\WP_Post::class, $post);
	}

    private function controller( $slug, $name = '' ) {
    	\ob_start();
    	\get_template_part( $slug, $name );
    	return \ob_get_clean();
	}

    // tests
    public function testGetTemplatePartFunction()
    {
    	$slug = 'index';

    	\ob_start();
		\ItalyStrap\Helpers\get_template_part( $slug );
		$content = \ob_get_clean();

//		$this->assertEquals( \trim( $this->controller( $slug ) ), \trim( $content ) );

//		codecept_debug( $content );
//		codecept_debug( $this->controller( $slug ) );
		codecept_debug( $content );
    }
}