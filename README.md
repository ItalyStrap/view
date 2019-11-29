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
```php
\ItalyStrap\View\get_template_part( 'slug', 'name', $data );

// Or

use ItalyStrap\View;

get_template_part( 'slug', 'name', $data );
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