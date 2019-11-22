<?php 
class GetTemplatePartFunctionTest extends \Codeception\Test\Unit
{
    /**
     * @var \WpunitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
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