<?php
declare(strict_types=1);

namespace ItalyStrap\Finder;


class Finder extends AbstractFinder
{
	/**
	 * @param array $files
	 * @return string Return the first full path to a view found ( full/path/to/a/view.{$extension} )
	 * @example:
	 * $files = [
	 *    'inDir/file-part.php',
	 *    'inDir/file.php',
	 *    'file-part.php',
	 *    'file.php',
	 * ]
	 *
	 */protected function filter( array $files ): string {
		// TODO: Implement filter() method.
	}
}