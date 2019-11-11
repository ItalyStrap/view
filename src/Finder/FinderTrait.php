<?php
declare(strict_types=1);

namespace ItalyStrap\Finder;

trait FinderTrait
{
	/**
	 * @param array $files
	 * @example:
	 * $files = [
	 * 	'inDir/file-part.php',
	 * 	'inDir/file.php',
	 * 	'file-part.php',
	 * 	'file.php',
	 * ]
	 *
	 * @return string Return the first full path to a view found ( full/path/to/a/view.{$extension} )
	 */
	abstract protected function filter( array $files ): string ;

	/**
	 * @var array
	 */
	protected $dirs = [];

	/**
	 * @var string
	 */
	protected $extension = 'php';

	/**
	 * @var array
	 */
	protected $files = [];

	/**
	 * @inheritDoc
	 */
	public function count(): int {
		return \count( $this->files );
	}

	/**
	 * @inheritDoc
	 */
	public function in( $dirs ) {
		$this->dirs = (array) $dirs;
		return $this;
	}

	/**
	 * Check if the file exists and is readable
	 *
	 * @param array $files File(s) to search for, in order.
	 * @return bool        Return true if a file exists
	 */
	protected function has( array $files ): bool {

		$key = $this->generateKey( $files[0] );

		if ( empty( $this->files[ $key ] ) ) {
			$this->files[ $key ] = $this->filter( $files );
		}

		return \is_readable( $this->files[ $key ] );
	}

	/**
	 * This method generate a unique key for storing a file found in a given directory
	 * With this generated key you can create new criteria for new directory to search on
	 *
	 * @param $fileName
	 * @return string
	 */
	protected function generateKey( string $fileName ): string {
		return $fileName . '-' . \md5( \json_encode( $this->dirs ) ) ;
	}
}