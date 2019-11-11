<?php
declare(strict_types=1);

namespace ItalyStrap\Finder;

use ItalyStrap\Finder\Exceptions\FileNotFoundException;

abstract class AbstractFinder implements FinderInterface, \Countable
{
	use FinderTrait;

	/**
	 * @inheritDoc
	 */
	public function find( $names, $extension = 'php' ): string {

		if ( 0 === \count( $this->dirs ) ) {
			throw new \LogicException('You must call ::in() method before calling ::find() method.');
		}

		if ( ! $this->has( $names ) ) {
			throw new FileNotFoundException(
				\sprintf( 'The file %s does not exists', $names[0] )
			);
		}

		return $this->files[ $this->generateKey( $names[0] ) ];
	}
}