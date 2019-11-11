<?php
declare(strict_types=1);

namespace ItalyStrap\View;

class CallbackFinder extends AbstractViewFinder
{
	/**
	 * @var callable
	 */
	private $finder;

	/**
	 * CallbackFinder constructor.
	 * @param callable $callable
	 */
	public function __construct( callable $callable ) {
		$this->finder = $callable;
	}

	/**
	 * @inheritDoc
	 */
	protected function filter( array $files ): string {
		$callback = $this->finder;
		return $callback( $files, $this->dirs );
	}
}