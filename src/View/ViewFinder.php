<?php
/**
 *
 */
declare(strict_types=1);

namespace ItalyStrap\View;

class ViewFinder extends AbstractViewFinder {

	/**
	 * @inheritDoc
	 */
	protected function filter( array $files ): string {

		foreach ( $files as $file ) {
			foreach ( $this->dirs as $dir ) {
				$dir = \rtrim( $dir, '/'.\DIRECTORY_SEPARATOR );
				if ( \is_readable( $dir . \DIRECTORY_SEPARATOR . $file ) ) {
					return $dir . \DIRECTORY_SEPARATOR . $file;
				}
			}
		}

		return '';
	}
}