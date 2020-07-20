<?php
declare(strict_types=1);

namespace ItalyStrap\Tests;

use Codeception\TestCase\WPTestCase;
use WpunitTester;
use function ob_get_clean;
use function ob_start;

class GetTemplatePartFunctionTest extends WPTestCase
{
	/**
	 * @var WpunitTester
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

    // tests
    public function testGetTemplatePartFunction()
    {
		global $posts, $post, $wp_did_header, $wp_query, $wp_rewrite, $wpdb, $wp_version, $wp, $id, $comment, $user_ID;
    	$slug = 'index';

    	ob_start();
		\ItalyStrap\View\get_template_part( $slug, '', $posts );
		$content = ob_get_clean();

		$this->assertIsString( $content );
    }
}