# ItalyStrap View API

[![Build Status](https://travis-ci.org/ItalyStrap/view.svg?branch=master)](https://travis-ci.org/ItalyStrap/view)
[![Latest Stable Version](https://img.shields.io/packagist/v/italystrap/view.svg)](https://packagist.org/packages/italystrap/view)
[![Total Downloads](https://img.shields.io/packagist/dt/italystrap/view.svg)](https://packagist.org/packages/italystrap/view)
[![Latest Unstable Version](https://img.shields.io/packagist/vpre/italystrap/view.svg)](https://packagist.org/packages/italystrap/view)
[![License](https://img.shields.io/packagist/l/italystrap/view.svg)](https://packagist.org/packages/italystrap/view)
![PHP from Packagist](https://img.shields.io/packagist/php-v/italystrap/view)

PHP Sanitizer and Validation OOP way

## Table Of Contents

* [Installation](#installation)
* [Basic Usage](#basic-usage)
* [Advanced Usage](#advanced-usage)
* [Contributing](#contributing)
* [License](#license)

## Installation

The best way to use this package is through Composer:

```CMD
composer require italystrap/view
```

## Basic Usage

```php
$finder = new \ItalyStrap\View\ViewFinder();

$finder->in( 'full/path/to/the/views/' );
//or
$finder->in( ['full/path/to/the/views/','full/path/to/the/views/'] );


$view = new \ItalyStrap\View\View( $finder );

$view->render( 'slug', $data ); // Data could be the type of: string|int|array|object
// Or
$view->render( ['slug'], $data );
// Or
$view->render( ['slug', 'name'], $data );
// Or
$view->render( ['slug', 'name', 'subName'], $data );
```

### For WordPress User

By default it will search in child -> parent -> theme-compat directories like the original `\get_template_part()` does

```php
// It will search in the root of your theme slug-name.php -> slug.php
\ItalyStrap\View\get_template_part( 'slug', 'name', $data );

// Or

use ItalyStrap\View;

// theme_path/slug-name.php
// theme_path/slug.php
get_template_part( 'slug', 'name', $data );

// theme_path/slug-slug1-name.php
// theme_path/slug-name.php
// theme_path/slug.php
get_template_part( ['slug', 'slug1'], 'name', $data );
```

If you need to add more or different direcories for searchinf files you can filter theme with the `'italystrap_view_get_template_part_directories'` hook. 

```php

\add_filter( 'italystrap_view_get_template_part_directories', function( array $dirs ) {
    // Add here your logic for dirs
    // For example you can add subdirs or remove dirs
    // You can add directories for languages
    // You can add directories from plugins and so on.
    // The sky is the limit.

    return $dirs;
});
```

Some example of results:

plugin_path/some_dir_path/slug-name.php
plugin_path/some_dir_path/slug.php
theme_path/other_dir_path/slug-slug-name.php
theme_path/other_dir_path/slug-name.php
theme_path/other_dir_path/slug.php

theme_with_locale_path/locale/slug-name.php

And so on.

### Inside the file template

Inside the file or template part you require if you added some $data value you can use it like so:

```php
$data = [
    'title' => 'Ciao Mondo',
];

// some-template-part.php
use ItalyStrap\View;
get_template_part( ['some','template'], 'part', $data );
//or
//...
//$view->render( ['some','template','part'], $data );


// inside some-template-part.php
echo $this->title;

//or

echo $this->get( 'title', 'Some default title' );
```


## Advanced Usage

See in [Tests Foldes](tests)

## Contributing

All feedback / bug reports / pull requests are welcome.

## License

Copyright (c) 2019 Enea Overclokk, ItalyStrap

This code is licensed under the [MIT](LICENSE).

## Credits

 For the Closure in the View and for some ideas with the Symphony Finder
 - [Giuseppe Mazzapica](https://github.com/gmazzap)